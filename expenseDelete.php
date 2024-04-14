<?php
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';

if (isset($_GET['exp_id'])) {
    $exp_id = $_GET['exp_id'];
    $pdo = db_connect();

    // Préparation de la requête de suppression pour les dépenses
    $stmt = $pdo->prepare("DELETE FROM expenses WHERE exp_id = ?");
    $stmt->execute([$exp_id]);

    // Redirection
    header('Location: userInfo.php?user_id=' . $_GET['user_id']);
    exit();
}
?>
