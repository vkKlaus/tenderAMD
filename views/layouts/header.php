<?php

if (isset($_GET['exit'])) {
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
}



$contacts = getTable($pdo, 'contacts');
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
    <nav class="navbar navbar-expand-lg navbar-light bg-header justify-content-between">
        <div class="d-flex flex-column ">
            <div>
                <a class="navbar-brand" href="/"><img src="/img/logo.svg" class="logo-img pl-5" alt="logo-AMD"></a>
                <button class="navbar-toggler bg-danger " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light mr-3" href="/"><span class="<?= $main ? 'active' : '' ?>">Реестр тендеров</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light mr-3" href="/views/about/"> <span class="<?= $rules ? 'active' : '' ?>">Правила участия</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light mr-3" href="/views/contact/"> <span class="<?= $contact ? 'active' : '' ?>">Контакты</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light mr-3" href=" http://amdel.ru" target="_blank"> <span class="<?= $mainSite ? 'active' : '' ?>">Сайт группы компаний</span></a>
                        </li>

                        <?php
                        if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 1)) { ?>
                            <li class="nav-item">
                                <a class="nav-link text-light mr-3" href="/views/layouts/admin.php">admin</a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['user']) && !isset($_SESSION['user']['error']) && !isset($_SESSION['user']['error'])) { ?>
            <div>
                <span class='text-danger font-weight-bold'><?= $_SESSION['user']['title'] ?> &#8195;</span>

                <a href="/?exit" class="mr-5 h5 btn btn-outline-danger  mt-1 pl-5 pr-5 text-danger font-weight-bold rounded-0">Выход</a>
            </div>
        <?php } else { ?>
            <div>
                <span class='text-danger'><?= isset($_SESSION['user']['error']) ? $_SESSION['user']['error'] : '' ?> &#8195;</span>
                <a href="/views/authorization/authorization.php" class="mr-5 h5 btn btn-outline-danger  mt-1 pl-5 pr-5 text-danger font-weight-bold rounded-0">Вход</a>
            </div>
        <?php } ?>
        </div>
    </nav>

    <main class="container-fluid main-container">