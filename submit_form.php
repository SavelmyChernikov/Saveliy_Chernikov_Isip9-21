<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]); // Изменяем имя переменной и получаем значение телефона
    $message = trim($_POST["message"]);

    error_log("submit_form.php: POST data = " . print_r($_POST, true));
    error_log("Name: " . $name);
    error_log("Phone: " . $phone); // Изменяем имя в error_log
    error_log("Message: " . $message);

    if (empty($name)) {
        $error_message = "Пожалуйста, введите ваше имя.";
        error_log("Ошибка: Поле 'Имя' не заполнено.");
        // Код для отображения сообщения об ошибке пользователю
    } else {
        try {
            error_log("Начало вставки данных в базу данных");
            $sql = "INSERT INTO contacts (name, phone, message) VALUES (:name, :phone, :message)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            error_log("Вставка данных в базу данных завершена");

            // Сообщение об успехе и перенаправление
            echo "<p style='color: green;'>Сообщение успешно отправлено!</p>";
            echo "<script>
                   setTimeout(function() {
                       window.location.href = 'index.html';
                   }, 3000); // 3 секунды
                  </script>";

            exit(); // Прерываем выполнение скрипта после перенаправления
        } catch (PDOException $e) {
            $error_message = "Произошла ошибка при отправке сообщения. Попробуйте позже.";
            error_log("Ошибка при вставке данных: " . $e->getMessage());
            echo "<p style='color: red;'>$error_message</p>"; // Выводим сообщение об ошибке
        }
    }
}
?>