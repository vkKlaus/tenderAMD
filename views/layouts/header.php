<?php
require $_SERVER['DOCUMENT_ROOT'] . '/module/pdo_db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/module/pdo_query.php';
require $_SERVER['DOCUMENT_ROOT'] . '/module/helpers.php';

$requestUri = $_SERVER['REQUEST_URI'];

$title = '';
$error = '';
$login = '';
$email = '';
$phone = '';

session_start();

$pdo = connect();


if (isset($_GET['exit'])) {
    unset($_SESSION['user']);
}

$host = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'];

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
    <div class="text-center bg-dark text-white-50">
    <a href="tel: +74959999999">&#9742; +7 495 999-99-99</a>
    <span>&#8195;&#8195;</span>
    <a href="mailto: tenderAMD@amdel.ru"> &#9993; tenderAMD@amdel.ru</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="/"><img src="/img/logo4.png" class="logo-img" alt="logo-AMD"></a>
        <button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light mr-3" href="/"><span class="<?= $main ? 'active' : '' ?>">Тендерная площадка</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light mr-3"" href="/views/about/"> <span class="<?= $rules ? 'active' : '' ?>">Правила участия</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light mr-3"" href="/views/contact/"> <span class="<?= $contact ? 'active' : '' ?>">Контакты</span></a>
                </li>

            </ul>
            <?php
            if (isset($_SESSION['user'])) { ?>
                <div>
                    <span class='text-secondary'><?= $_SESSION['user']['inn'] ?></span>

                    <a href="/?exit" class="mr-5 text-success h5 btn btn-outline-info  mt-1 pl-5 pr-5 ">Выход</a>
                </div>
            <?php } else { ?>
                <div>
                    <a href="/views/authorization/authorization.php" class="mr-5 text-success h5 btn btn-outline-info  mt-1 pl-5 pr-5 ">Вход</a>
                </div>
            <?php } ?>
        </div>
    </nav>

    <main class="container-fluid main-container">