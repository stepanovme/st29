<?php
require_once('../db.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE login='$login' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Успешная авторизация
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['userId'];
        header('Location: index.php'); // Перенаправление на index.php
        exit;
    } else {
        // Неверный логин или пароль
        // echo "Неверный логин или пароль";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/auth.css">
    <title>Авторизация</title>
</head>
<body>
    <div class="content">
        <div class="auth">
            <form method="POST">
                <p class="logo">СТРОИТЕЛЬНЫЕ ТЕХНОЛОГИИ</p>
                <h1>Авторизация</h1>
                <label for="">Логин</label>
                <input type="text" name="login" id="login">
                <label for="">Пароль</label>
                <input type="password" name="password" id="password">
                <button type="submit">ВОЙТИ</button>
            </form>
        </div>
        <div class="backround-content">

        </div>
    </div>
</body>
</html>