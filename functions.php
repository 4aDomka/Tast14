<?php
$users = array(
    array(
        'login' => 'user1',
        'password' =>'password1'
    ),
    array(
        'login' => 'user2',
        'password' =>'password2'
    ),
    array(
        'login' => 'user3',
        'password' =>'password3'
    ),
    array(
        'login' => 'user4',
        'password' =>'password4'
    ),
    array(
        'login' => 'user5',
        'password' =>'password5'
    ),
    array(
        'login' => 'user6',
        'password' =>'password6'
    )
    );

    function getUserList(){
        global $users;
        $userList = array();
        foreach ($users as $user){
            $hashPass = password_hash($user['password'], PASSWORD_DEFAULT);
            $userList[] = array(
                'login' => $user['login'],
                'passwordHash' => $hashPass
            );
        }
        return $userList;
    }

    function existsUser($login){
        global $users;
        foreach($users as $user){
            if ($user['login'] === $login){
                return true;
            }
        }
        return false;
    }

    function addUser($login, $password){
        global $users;
        $user[] = array(
            'login' => $login,
            'password' => $password
        );
    }

    function checkPassword($login, $password){
        $userList = getUserList();
        foreach ($userList as $user){
            if ($user['login'] === $login){
                return password_verify($password, $user['passwordHash']);
            }
        }
        return false;
    }

    function getCurrentUser(){
        session_start();
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        return null;
    }

    function calcBirthday($birthday){
        $today = new DateTime();
        $birthday = new DateTime($birthday);
        $birthday ->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));
        if ($today > $birthday){
            $birthday->modify('+1 year');
        }
        $interval = $today-> diff($birthday);
        return $interval->days;
    }

    function getMessage($birthday, $dayUntilBirthday){
        $today = new DateTime();
        $birthday = new DateTime($birthday);
        $birthday ->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));

        if($today->format('md') === $birthday->format('md')){
            return "С днём рождения!!! Ваша скидка 5 % на всё!!!";
        }else{
            return "До Вашего дня рождения осталось " . $dayUntilBirthday . "дней!";
        }
    }

    ?>

