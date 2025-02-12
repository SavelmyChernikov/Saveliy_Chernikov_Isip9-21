<?php
session_start();
session_destroy();
header("Location: admin.php"); // Перенаправляем на страницу логина
exit();
?>