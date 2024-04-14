<?php
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$href = "assets/css/userUpdate.css";
// regex date
$regexDate = '/\d{4}-\d{2}-\d{2}/';
// Liste des Utilisateurs
$users = users_list($pdo);
// Pour récupérer l'id dans l'url
$user_id = (int) $_GET['user_id'];
// initialiser les valeurs inputs
$users_infos = user_details($pdo, $user_id);
$error = [];
if (!empty($_POST)) {
    // vérifie que le nom est bien renseigné
    if (empty($_POST['user_id'])) {
        $errors['user_id'] = 'Le champ est requis';
    } else if (!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)) {
        $errors['user_id'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'Le champ est requis';
    }
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'Le champ est requis';
    }
    if (empty($_POST['birth_date'])) {
        $errors['birth_date'] = 'Le champ est requis';
    } else if (!preg_match($regexDate, $_POST['birth_date'])) {
        $errors['birth_date'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($errors)) {
        $user_id = (int) htmlentities($_POST['user_id']);
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $birth_date = htmlentities($_POST['birth_date']);
        if (updateUser($pdo, $user_id, $first_name, $last_name, $birth_date)) {
        header('location: userList.php');
        exit();
        $success = true;
        }
    }
}






require_once 'inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php if (isset($success)): ?>
        <?php endif?>
        <div class="col-md-4 bg-light p-3">
            <h2 id="update-title" class="text-center">Modifier <?=$users_infos['first_name'] . ' ' . $users_infos['last_name']?></h2>                
            <form id="form-update" class="text-center" action="" method="post">
                <div class="mb-3">
                    <label class="mb-3" for="first_name">Prénom</label>
                    <input name="first_name" class="form-control" id="first_name" type="text"
                        value="<?=$users_infos['first_name']?>">
                    <p class="mb-0 text-danger"><?=$errors['first_name'] ?? ''?></p>
                </div>
                <div class="mb-3">
                    <label class="mb-3" for="last_name">Nom</label>
                    <input name="last_name" class="form-control" id="last_name" type="text"
                        value="<?=$users_infos['last_name']?>">
                    <p class="mb-0 text-danger"><?=$errors['last_name'] ?? ''?></p>
                </div>
                <div class="mb-3">
                    <label class="mb-3" for="birth_date">Date de naissance</label>
                    <input name="birth_date" class="form-control" id="birth_date" type="date"
                        value="<?=$users_infos['birth_date']?>">
                    <p class="mb-0 text-danger"><?=$errors['birth_date'] ?? ''?></p>
                </div>
                <input type="hidden" name="user_id" value="<?=htmlentities($user_id)?>">
                <input class="button" type="submit" value="Enregister">
            </form>
        </div>
    </div>
</div>

<?php

    require_once "inc/footer.php"

?>

</body>