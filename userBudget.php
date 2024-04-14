<?php

session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$error = [];
$href = "assets/css/userBudget.css";
require_once 'inc/header.php';

?>

<div class="wrapper">
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <div class="title text-center mb-5">
        <h1>Votre budget</h1>
      </div>
      <div class="chart-wrapper">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="assets/js/script.js"></script>

</body>
