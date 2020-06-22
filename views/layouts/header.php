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
    <!-- <div class="text-center bg-dark pt-1">
        <?php
        foreach ($contacts as $cont) {
            if ($cont['type'] == 'tel' || $cont['type'] == 'mailto') {
        ?>

                <span>&#8195;</span>
                <a href="<?= $cont['type'] . ':' . ' ' . $cont['contact'] ?>">
                    <span class=" text-white-50">
                        <?= $cont['specchar'] . '&#8195;' . $cont['info'] ?>
                    </span>
                </a>

                <span>&#8195;</span>
        <?php }
        } ?>

    </div> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="/"><img src="/img/logo4.png" class="logo-img" alt="logo-AMD"></a>
        <button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-light mr-3" href="/"><span class="<?= $main ? 'active' : '' ?>">Реестр тендеров</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-light mr-3"" href="/views/about/"> <span class="<?= $rules ? 'active' : '' ?>">Правила участия</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light mr-3"" href="/views/contact/"> <span class="<?= $contact ? 'active' : '' ?>">Контакты</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light mr-3"" href="http://amdel.ru" target="_blank"> <span class="<?= $contact ? 'active' : '' ?>">Сайт группы компаний</span></a>
                </li>

                <?php
                if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 1)) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-light mr-3"" href="/views/layouts/admin.php"> <span class="<?= $contact ? 'active' : '' ?>">admin</span></a>
                    </li>
                <?php } ?>

            </ul>
            <?php
            if (isset($_SESSION['user']) && !isset($_SESSION['user']['error']) && !isset($_SESSION['user']['error'])) { ?>
                <div>
                    <span class='text-secondary'>ИНН: <?= $_SESSION['user']['inn'] ?> &#8195;</span>

                    <a href="/?exit" class="mr-5 text-success h5 btn btn-outline-info  mt-1 pl-5 pr-5 ">Выход</a>
                </div>
            <?php } else { ?>
                <div>
                    <span class='text-danger'><?= isset($_SESSION['user']['error']) ? $_SESSION['user']['error'] : '' ?> &#8195;</span>
                    <a href="/views/authorization/authorization.php" class="mr-5 text-success h5 btn btn-outline-info  mt-1 pl-5 pr-5 ">Вход</a>
                </div>
            <?php } ?>
        </div>
    </nav>

    <main class="container-fluid main-container pb-3">