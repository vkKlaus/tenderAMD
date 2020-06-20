<?php
require $_SERVER['DOCUMENT_ROOT'] . '/module/pdo_db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/module/pdo_query.php';
require $_SERVER['DOCUMENT_ROOT'] . '/module/helpers.php';


if (isset($_POST['downDoc'])) {

    if (preg_match("/^\/archDocs\/\d{0,3}\.zip$/",$_POST['downDoc']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['downDoc'])) {
        file_force_download($_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['downDoc']);
    }

}


$requestUri = $_SERVER['REQUEST_URI'];

$title = '';
$error = '';
$login = '';
$email = '';
$phone = '';
$name = '';

$pdo = connect();


ini_set('session.gc_maxlifetime', 10800);
session_start();

if (isset($_SERVER['HTTP_REFERER'])) {
    $host = $_SERVER['HTTP_REFERER'];
    $pos = strpos($host, 'views');

    if ($pos != false) {
        $host = substr($host, 0, $pos - 1);
    }
}
else{
    $host = '';
}

if (!isset($_SESSION['admin'])){
    $_SESSION['admin']=0;
}



