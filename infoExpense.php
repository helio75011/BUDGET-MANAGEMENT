<?php
// $href = "assets/css/";
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$user_id = htmlentities($_GET['user_id']);
$stats = users_det($pdo, $user_id);
require_once 'inc/header.php';
?>
<link rel="stylesheet" href="assets/css/style2.css">


<div class="container pt-5">

    <table class="table table-striped table-hover table-dark table-bordered">
        <thead>
            <tr>
                <th>Dépenses</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stats as $stat): ?>
            <tr>

                <td><?=$stat['exp_amount']?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>


</div>


<?php require_once __DIR__ . 'inc/footer.php';