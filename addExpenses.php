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
$href = "assets/css/addExpenses.css";

$lists = users_list($pdo);
// Le formulaire a été soumis
if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    // vérifie que le nom est bien renseigné
    if (empty($_POST['exp_date'])) {
        $error = true;
    }

    if (!$error) {
        $exp_amount = htmlentities($_POST['exp_amount']);
        $user_id = htmlentities($_POST['user_id']);
        $exp_date = htmlentities($_POST['exp_date']);
        $exp_label = htmlentities($_POST['exp_label']);
        if (addExpense($pdo, $exp_amount, $user_id, $exp_date, $exp_label)) {
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
            <p> Déclaration de dépense crée avec succès</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif;?>
        <div class="row justify-content-center ">
            <div class="col-md-5 bg-none p-3">

                <form class="form-horizontal text-light" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="textinput">Votre dépense (en euros)</label>
                        <input id="exp_amount" name="exp_amount" type="text" placeholder="Ex: 2500"
                            class="form-control input-md">
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="textinput">Raison</label>
                        <input id="exp_label" name="exp_label" type="text" placeholder="Ex: Restaurant"
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
                        <input id="exp_date" name="exp_date" type="date" placeholder="Ex:11-01-2001"
                            class="form-control input-md">
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