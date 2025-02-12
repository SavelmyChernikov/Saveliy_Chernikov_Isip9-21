<?php
// Параметры подключения к базе данных
$host = 'localhost';
$dbname = 'contact_form_db';
$user = 'postgres';
$password = '123';

// Подключение к базе данных
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>