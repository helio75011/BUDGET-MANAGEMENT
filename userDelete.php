<?php
require_once 'libraries/database.php';
require 'functions.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $pdo = db_connect();

    // Préparation de la requête de suppression
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Redirection vers la liste des utilisateurs
    header('Location: userList.php');
    exit();
}
?>
