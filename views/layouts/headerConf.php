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
$name = '';

$pdo = connect();


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




ini_set('session.gc_maxlifetime', 10800);
session_start();
