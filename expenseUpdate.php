<?php
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$exp_id = (int) $_GET['exp_id'];
// Pour récupérer l'id dans l'url
$user_id = (int) $_GET['user_id'];
// initialiser les valeurs inputs
$user_infos = user_details($pdo, $user_id);
$expenses = expense_details($pdo, $exp_id);
$users = user_list_nodata($pdo);
$href = "assets/css/expenseUpdate.css";



require_once 'inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php if (isset($success)): ?>
        <?php endif?>
        <div class="col-md-4">
            <h2 id="update-title" class="text-center">Modification des dépenses de <?=$user_infos['first_name'] . ' ' . $user_infos['last_name']?></h2>
            <form id="form-update" class="text-center" action="" method="post">
                <div class="mb-3">
                    <label class="mb-3" for="exp_amount">Dépenses</label>
                    <input name="exp_amount" class="form-control" id="exp_amount" type="number" value="<?=$expenses['exp_amount']?>">
                    <p class="mb-0 text-danger"><?=$errors['exp_amount'] ?? ''?></p>
                </div>
                <div class="mb-3 mx-auto" style="">
                    <label for="inputDate" class="col-sm-8 col-form-label">Date</label>
                    <input type="date" value="<?=date('Y-m-d', strtotime($expenses['exp_date']))?>" name="exp_date" class="form-control">
                    <p class="mb-0 text-danger"><?=$errors['exp_date'] ?? ''?></p>
                </div>

                <input type="hidden" name="user_id" value="<?=htmlentities($user_id)?>">
                <input class="button " type="submit" value="Enregister">
            </form>
        </div>
    </div>
</div>

</body>
</html>