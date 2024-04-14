<?php
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';

if (isset($_GET['inc_id'])) {
    $inc_id = $_GET['inc_id'];
    $pdo = db_connect();

    // Préparation de la requête de suppression pour les revenus
    $stmt = $pdo->prepare("DELETE FROM incomes WHERE inc_id = ?");
    $stmt->execute([$inc_id]);

    // Redirection
    header('Location: userInfo.php?user_id=' . $_GET['user_id']);
    exit();
}
?>
