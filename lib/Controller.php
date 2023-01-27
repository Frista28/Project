<?php

namespace Felix\StudyProject;

use SQLite3;

class Controller
{

    public function process(): void
    {

        //Подключаю header
        require_once ('../template/header.php');

        //Распарсиль ссылку и выделил значение для отображения страницы
        $url = parse_url($_SERVER['REQUEST_URI']);
        parse_str($url['query'], $out);

        //Проверка на метод HTTP
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $page = $_POST['page'];
            echo $_POST['page'];
        }else if($_SERVER['REQUEST_METHOD'] === "GET"){
            $page = $out['page'];
        }else{
            $page = 'form';
        }
        switch ($page) {
            case 'form':
                $result = $this->formAction();
                break;
            case 'list':
                $result = $this->listAction();
                break;
            case 'send':
                $result = $this->sendAction();
                break;
            default:
                header('Location: /form');
                $result = null;
        }

        if (!is_null($result)) {
            echo $result;
        }
        //Подключаю footer
        require_once '../template/footer.php';
    }

    protected function formAction(): string {
        ?>
        <form id="formpage" class = 'central-block' method='POST'>
            <p class='text2'>Имя <input type='text' name='name'></p>
            <p class='text2'>Почта <input type='text' name='email'></p>
            <p class='text2'>Ссылка <input type='text' name='website'></p>
            <input type="hidden" name = "page" value = "send">
            <input class=button_log type='submit' value='Добавить'>
        </form>
        <?php
        return "";
    }

    protected function listAction(): string
    {
        // селект из базы $database->query()
        $database = new  \SQLite3('../db/sqlite.db');
        $result = $database->query("Select * from project");
        $num = $database->querySingle("Select count('id') from project;");
        //echo $num;
        //$result->fetchArray(SQLITE3_NUM);
        echo "<div class = 'list_block'><div class='list_string_up'><p>Имя</p><p>Почта</p><p>Ссылка</p></div>";
        for ($j = 0 ; $j < $num ; ++$j){
            $row = $result->fetchArray(SQLITE3_ASSOC);
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $website = $row['website'];
            echo "<div class = 'list_string'><p>$name</p><p>$email</p><p>$website</p></div>";
        }
        echo "</div>";

        return '';
    }

    protected function sendAction(): string
    {

        $database = new  \SQLite3('../db/sqlite.db');
        $name = SQLite3::escapeString($_POST['name']);
        $email = SQLite3::escapeString($_POST['email']);
        $website = SQLite3::escapeString($_POST['website']);
        $database->query("Insert into project( name, email, website)
                                            VALUES ('$name', '$email', '$website')");
        header('Content-Type: application/json');

        // Отправка ответа в формате JSON
        echo json_encode(array('success' => true));

        return '';
    }

}
