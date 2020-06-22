<?php

function connect()
{
    static $pdo = null;

    if ($pdo === null) {

     
        $host = 'h006355333.mysql';
        $db   = 'h006355333_tender';
        $user = 'h006355333_mysql';
        $pass = 'Z:nWzo5A';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new PDO($dsn, $user, $pass, $opt);
        
        
        $sql ="SET NAMES 'utf8'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        $sql ="SET CHARACTER SET 'utf8'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        $sql ="SET SESSION collation_connection = 'utf8_general_ci'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        
    }


    return $pdo;
}
