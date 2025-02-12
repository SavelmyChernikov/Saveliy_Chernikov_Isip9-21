<?php
session_start(); // Начало сессии

require_once 'config.php'; // Подключаемся к базе данных

// Функция для получения данных администратора из базы данных
function getAdminData($pdo, $username) {
    try {
        $sql = "SELECT id, username, password_hash FROM admins WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin;
    } catch (PDOException $e) {
        error_log("Ошибка при получении данных администратора: " . $e->getMessage());
        return false;
    }
}

// Проверка авторизации
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Если не авторизован, показываем форму логина
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $admin = getAdminData($pdo, $username);

        if ($admin && password_verify($_POST['password'], $admin['password_hash'])) {
            $_SESSION['admin'] = true;
        } else {
            $login_error = "Неверное имя пользователя или пароль.";
        }
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Login</title>
    </head>
    <body>
        <h2>Admin Login</h2>
        <?php if (isset($login_error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($login_error); ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit">Login</button>
        </form>
    </body>
    </html>
    <?php
    exit(); // Прекращаем выполнение скрипта, если не авторизован
}

// Если авторизован, продолжаем отображение данных
try {
    $sql = "SELECT * FROM contacts"; // Выбираем все записи из таблицы contacts
    $stmt = $pdo->query($sql);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Получаем все результаты в виде ассоциативного массива
} catch (PDOException $e) {
    die("Ошибка при получении данных: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Admin Panel</h2>

<p><a href="logout.php">Выйти</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Сообщение</th>
            <th>Дата создания</th>
            <!-- Добавьте другие столбцы, если необходимо -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo htmlspecialchars($contact['id']); ?></td>
                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                <td><?php echo htmlspecialchars($contact['message']); ?></td>
                <td><?php echo htmlspecialchars($contact['created_at']); ?></td>
                <!-- Отобразите другие столбцы -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>