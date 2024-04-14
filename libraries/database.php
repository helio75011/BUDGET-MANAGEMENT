<?php

function db_connect()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=budget;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $pdo;
    } catch (PDOException $e) {
        echo 'erreur';
        die();
    }
}
