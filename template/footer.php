<?php

// todo Написать подвал сайта /body, /html и подключение js

?>
</div>
<footer>
    <script>
        $(document).ready(function() {
            $("#formpage").submit(function(event) {
                event.preventDefault(); // prevent the form from submitting

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $("#result").html("Форма отправлена успешно.");
                        } else {
                            $("#result").html("Ошибка при отправке формы.");
                        }
                    },
                    error: function(error) {
                        $("#result").html("Ошибка при отправке формы.");
                    }
                });
            });
        });
    </script>
    <div id="result"></div>
</footer>
</html>
