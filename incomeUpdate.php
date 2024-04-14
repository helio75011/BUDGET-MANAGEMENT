<?php
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$inc_id = (int) $_GET['inc_id'];
// Pour récupérer l'id dans l'url
$user_id = (int) $_GET['user_id'];
// initialiser les valeurs inputs
$user_infos = user_details($pdo, $user_id);
$incomes = income_details($pdo, $inc_id);
$users = user_list_nodata($pdo);
$income_lists = income_list($pdo);
$href = "assets/css/incomeUpdate.css";
$errors = [];
if (!empty($_POST)) {
    if (empty($_POST['inc_amount'])) {
        $errors['inc_amount'] = 'Le champ est requis';
    }
    if (empty($_POST['user_id'])) {
        $errors['user_id'] = 'Le champ est requis';
    } else if (!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)) {
        $errors['user_id'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($_POST['inc_receipt_date'])) {
        $errors['inc_receipt_date'] = 'Le champ est requis';
    }
    if (empty($_POST['inc_cat_id'])) {
        $errors['inc_cat_id'] = ' ';
    }
    if (empty($errors)) {
        $inc_id = htmlentities($_GET['inc_id']);
        $inc_amount = htmlentities($_POST['inc_amount']);
        $inc_receipt_date = htmlentities($_POST['inc_receipt_date']);
        $inc_cat_id = htmlentities($_POST['inc_cat_id']);
        if (updateIncome($pdo, $inc_id, $inc_amount, $inc_receipt_date, $inc_cat_id)) {
            header('location: userList.php');
            exit();
        }
    }
}
require_once 'inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php if (isset($success)): ?>
        <?php endif?>
        <div class="col-md-4">
            <h2 id="update-title" class="text-center">Modification des revenus de
                <?=$user_infos['first_name'] . ' ' . $user_infos['last_name']?></h2>
            <form id="form-update" class="text-center" action="" method="post">
                <div class="mb-3">
                    <label class="mb-3" for="inc_amount">Revenu</label>
                    <input name="inc_amount" class="form-control" id="inc_amount" type="number"
                        value="<?=$incomes['inc_amount']?>">
                    <p class="mb-0 text-danger"><?=$errors['inc_amount'] ?? ''?></p>
                </div>
                <div class="mb-3 mx-auto" style="">
                    <label for="inputDate" class="col-sm-8 col-form-label">Date</label>
                    <input type="date" value="<?=date('Y-m-d', strtotime($incomes['inc_receipt_date']))?>"
                        name="inc_receipt_date" class="form-control">
                    <p class="mb-0 text-danger"><?=$errors['inc_receipt_date'] ?? ''?></p>
                </div>
                <div class="mb-3 mx-auto" style="">
                    <label for="inputCat" class="col-sm-8 col-form-label">Catégorie</label>
                    <select name="inc_cat_id" class="form-select" id="inc">
                        <?php foreach ($income_lists as $income_list): ?>
                        <option <?=$incomes['inc_cat_id'] == $income_list['inc_cat_id'] ? 'selected' : ''?>
                            value="<?=$income_list['inc_cat_id']?>"><?=$income_list['inc_cat_name']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="<?=htmlentities($user_id)?>">
                <input class="button" type="submit" value="Enregister">
            </form>
        </div>
    </div>
</div>