<?php

session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
$href = "assets/css/addUser.css";

$error = false;
// Le formulaire a été soumis
if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['birth_date'])) {
        $error = true;
    }

    if (!$error) {
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $birth_date = htmlentities($_POST['birth_date']);
        if (adduser($pdo, $first_name, $last_name, $birth_date)) {
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
            <p>utilisateur créé avec succès</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif;?>
        <div class="row justify-content-center">
            <div class="col-md-5 bg-none p-3">
                <form class="form-horizontal text-light" action="" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="first_name">Prenom de l'utilisateur</label>
                        <input name="first_name" class="form-control" id="first_name" type="text">
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="last_name">Nom de l'utilisateur</label>
                        <input name="last_name" class="form-control" id="last_name" type="text">
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="birth_date">Date de naissance utilisateur</label>
                        <input name="birth_date" class="form-control" id="birth_date" type="date">
                        <p class="mb-0 text-danger"><?=$error ? 'Le champ est requis' : ''?></p>
                    </div>
                    <input class="button" type="submit" value="Enregister">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/inc/footer.php';?>
</body>

</html>