<?php
session_start();

$_SESSION['login_time'] = time();

require 'functions.php';

// Расчёт времени до окончания акции

$loginTime = $_SESSION['login_time'];
$remainingTime = 86400 - (time() - $loginTime);
if ($remainingTime > 0) {
    $hours = floor($remainingTime / 3600);
    $minutes = floor(($remainingTime % 3600) / 60);
    $seconds = $remainingTime % 60;
} else {
    $hours = 0;
    $minutes = 0;
    $seconds = 0;
}

// Проверка, установлен ли день рождения

if (isset($_SESSION['birthday'])) {
    $birthday = $_SESSION['birthday'];
    $dayUntilBirthday = calcBirthday($birthday);
    $message = getMessage($birthday, $dayUntilBirthday);
} else {
    $dayUntilBirthday = null;
    $message = "";
}

// Обработка отправки формы

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birthday = $_POST['birthday'];
    $_SESSION['birthday'] = $birthday;
    $dayUntilBirthday = calcBirthday($birthday);
    $message = getMessage($birthday, $dayUntilBirthday);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Главная страница</title>
    </head>
    <body>
        <h1> Добро пожаловать, <?php echo $_SESSION['user']; ?>!</h1>
        <p>Вы находитесь на главной странице.</p>
        <p>Только сегодня и только для Вас, мы дарим скидку 10% на весь ассортимент в течении 24 часов</p>
        <p>До конца акции осталось: <?php echo "$hours часов, $minutes минут, $seconds секунд"; ?></p>
        <h2> Услуги нашего SPA-салона:</h2>
        <ul>
            <li>Массаж</li>
            <li>Маникюр и педикюр</li>
            <li>Уход за волосами</li>
            <li>Обертывание</li>
            <li>Пилинг</li>
        </ul>
        <?php if ($dayUntilBirthday !== null) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>
        <form method="POST" action = "">
            <label for="birthday">Введите дату Вашего рождения:</label>
            <input type="date" id="birthday" name="birthday" required><br><br>
            <input type="submit" value="Ввести">
        </form>
        <h2>Фото нашего салона</h2>
        <img src="spa1.jpg" alt="Фото салона 1" width="400" height="300">
        <img src="spa2.jpg" alt="Фото салона 2" width="400" height="300">
        <img src="spa3.jpg" alt="Фото салона 3" width="400" height="300">

        <form method="POST" action="logout.php">
            <input type="submit" name="logout" value="Выйти">
        </form>
    </body>
</html>

