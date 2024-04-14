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
$href = "assets/css/addIncomes.css";
$error = false;
$incomes = income_list($pdo);
$lists = users_list($pdo);






// Le formulaire a été soumis
if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['inc_receipt_date'])) {
        $error = true;
    }

    if (!$error) {
        $inc_amount = htmlentities($_POST['inc_amount']);
        $user_id = htmlentities($_POST['user_id']);
        $inc_receipt_date = htmlentities($_POST['inc_receipt_date']);
        $inc_cat_id = htmlentities($_POST['inc_cat_id']);
        if (addIncome($pdo, $inc_amount, $user_id, $inc_receipt_date, $inc_cat_id)) {
            $success = true;
        }
    }
}

require_once 'inc/header.php';
?>

<main class="text-center">
    <div class="container pt-5">
        <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p> Déclaration de revenue créé avec succès !</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif;?>
        <div class="row justify-content-center ">
            <div class="col-md-5 bg-none p-3">

                <form class="form-horizontal text-light" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="textinput">Votre revenu (en euros)</label>
                        <input id="inc_amount" name="inc_amount" type="text" placeholder="Ex: 2500"
                            class="form-control input-md">
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="selectbasic">Utilisateur</label>
                        <select id="user_id" name="user_id" class="form-control">
                            <?php foreach ($lists as $list): ?>

                            <option value="<?=$list['user_id']?>"><?=$list['last_name']?></option>
                            <?php endforeach?>
                        </select>
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="textinput">Date</label>
                        <input id="inc_receipt_date" name="inc_receipt_date" type="date" placeholder="Ex:11-01-2001"
                            class="form-control input-md">
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="selectbasic">Type de revenus</label>

                        <select id="inc_cat_id" name="inc_cat_id" class="form-control">
                            <?php foreach ($incomes as $income): ?>

                            <option value="<?=$income['inc_cat_id']?>"><?=$income['inc_cat_name']?></option>
                            <?php endforeach?>
                        </select>
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                   <input class="button" type="submit" value="Enregister">
                </form>
            </div>
        </div>
    </div>
</main>

<?php

    require_once "inc/footer.php"

?>