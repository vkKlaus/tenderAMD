<?php
require $_SERVER['DOCUMENT_ROOT'] . '/module/pdo_db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/module/pdo_query.php';
require $_SERVER['DOCUMENT_ROOT'] . '/module/helpers.php';

$requestUri = $_SERVER['REQUEST_URI'];

$title='';
$error = '';
$login = '';
$email = '';
$phone = '';


session_start();

$pdo = connect();

$host = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'];

if (isset($_GET['exit'])) {
    unset($_SESSION['user']);
}

if (isset($_POST['enter'])) {

    $user = getUser($pdo, $_POST['login']);

    if ($user) {
        if (!password_verify($_POST['password'], $user['password'])) {
            $error .= 'ошибка авторизации <br>';
        } elseif (!$user['action']) {
            $error .= 'пользователь не работает с документами <br>';
        } else {
            $_SESSION['user'] = $user;
            header('Location: ' . $host);
        }
     
    } else {
        $error .= 'пользователь нет найден <br>';
    }
} elseif (isset($_POST['registration'])) {


    $inn = valid_inn($_POST['login'], 1);

    if (getUser($pdo, $_POST['login'])) {
        $error .= 'пользователь уже зарегистрирован <br>';
    } else {

        if ($inn == 0) {
            $inn = valid_inn($_POST['login'], 0);
        }

        if ($inn == 0) {
            $error .= 'не корректный ИНН <br>';
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= 'не корректный email <br>';
        }

        if (!valid_phone($_POST['phone'])) {
            $error .= 'не корректный телефон <br>';
        }

        if (!valid_password($_POST['password_1'])) {
            $error .= 'нарушены требования пароля  <br>';
        }

        if (($_POST['password_1'] <> $_POST['password_2'])) {
            $error .= 'разные пароли <br>';
        }

        if ($error) {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
        } else {

            $user = addUser($pdo, $_POST);

            if ($user){
                $title='данные отправлены для проверки. О результатах вам будет отправлено сообщение на зарегистрированный email';
            }
            else{
                $error .='ошибка записи пользователя в базу';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"АМДевелопмент" тендерная площадка</title>

    <link rel="shortcut icon" href="/img/favicon.ico">

    <link rel="stylesheet" href="/css/reset.css">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-start">
            <div>
                <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div>
                <a class="navbar-brand ml-5" href="/"><img src="/img/logo4.png" class="logo-img" alt="logo-AMD"></a>
            </div>

            <div>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link text-light mr-5" href="/"><span class="active">Тендерная площадка </span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light mr-5"" href="/views/about/">Правила участия </a> 
                        </li>
                    </ul> 
                    </div>
                </div> 
            </div> 

            <?php 
            if (isset($_SESSION['user'])) { ?> 
                <div>
                    <span class='text-secondary'><?= $_SESSION['user']['inn'] ?></span>

                    <a href="/?exit" class="mr-5 text-success h5 btn btn-outline-info  mt-1 pl-5 pr-5 ">Выход</a>
                </div>
            <?php } 
            else { ?>
                <div>
                    <a href="/views/authorization/authorization.php" class="mr-5 text-success h5 btn btn-outline-info  mt-1 pl-5 pr-5 ">Вход</a>
                </div>
            <?php } ?>

    </nav>

    <main class="container-fluid main-container">