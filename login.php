<?php
session_start();

//проверка авторизации
if(isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

//выход из системы

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
    exit();
}

require 'functions.php';

// Обработка отправки формы 
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     echo "Form submitted"; // Оператор отладки
// }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_POST['login'];
    $password = $_POST['password'];

    //аутентификация
    if (checkPassword($login, $password)){
        $_SESSION['user'] = $login;
        header("Location: index.php");
        exit();
    }else{
        $error = "Неверный логин и пароль";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Страница входа</title>
    </head>
    <body>
        <h1>Вход</h1>
        <?php if(isset($error)){ ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action=>
        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" require><br><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" require><br><br>
        <input type="submit" name="submit" value="Войти">
        </form>
        <p>Нет личного кабинета?<a href="registration.php">Зарегистрироваться</a></p>
    </body>
</html>

