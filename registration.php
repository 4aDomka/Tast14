<?php
session_start();

// Проверка авторизации

if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
require 'functions.php';

// Обработка отправки формы

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_POST['login'];
    $password = $_POST['password'];

    //Проверка существования пользователя
    if (existsUser($login)) {
        $error = "Пользователь уже существует";
    }else{
        // Хэширование пароля
        // $hashPass = password_hash($password, PASSWORD_DEFAULT);

        //Добавляем пользователя
        addUser($login,$password);
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Регистрация</title>
    </head>
    <body>
        <h1>Регистрация</h1>
        <?php if(isset($error)){ ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action=>
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" require><br><br>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" require><br><br>
            <input type="submit" name="submit" value="Регистрация">
        </form>
    </body>
</html>

