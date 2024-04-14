<?php

require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$inc_id = isset($_GET['inc_id']) ? (int) $_GET['inc_id'] : null;
$user_id = htmlentities($_GET['user_id']);
$stats = users_det($pdo, $user_id);
$href = "assets/css/userInfo.css";
$userInfo = users_list($pdo);
$income_lists = income_list($pdo);
$incomes = income_details($pdo, $inc_id);
require_once 'inc/header.php';
?>

<div class="container pt-5">
    <table class="table table-hover table-dark table-bordered">
        <thead>
            <tr>
                <th>Revenus</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stats as $stat): ?>
            <tr>
                <td><?=$stat['inc_amount']?></td>
               
                <td><a href="incomeUpdate.php?user_id=<?=$stat['user_id']?>&inc_id=<?=$stat['inc_id']?>"><i
                            class="far fa-edit"></i></a></td>
                            <td><a href="incomeDelete.php?inc_id=<?= $stat['inc_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce revenu ?');"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

</div>

<div class="container pt-5">

    <table class="table table-hover table-dark table-bordered">
        <thead>
            <tr>
                <th>Dépenses</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stats as $stat): ?>
            <tr>

                <td><?=$stat['exp_amount']?></td>
                <td><a href="expenseUpdate.php?user_id=<?=$stat['user_id']?>&exp_id=<?=$stat['exp_id']?>"><i
                            class="far fa-edit"></i></a></td>
                            <td><a href="expenseDelete.php?exp_id=<?= $stat['exp_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?');"><i class="far fa-trash-alt"></i></a></td>
                            
            </tr>
            <?php endforeach;?>

        </tbody>
    </table>


</div>

<?php

    require_once "inc/footer.php"

?>