<?php

session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

$href = "assets/css/userList.css";
require_once __DIR__ . '/libraries/database.php';
require 'functions.php';
$pdo = db_connect();
require_once "inc/header.php";
$usersInfos = users_list($pdo);

?>

<div class="container">
    <h1 class= text-center>Liste des utilisateurs</h1>

    <table class="table table-striped table-hover table-dark table-bordered">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de naissance</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersInfos as $userInfo) : ?>
            <tr>
                <td><a href="userInfo.php?user_id=<?= $userInfo['user_id'] ?>"><?= $userInfo['first_name'] ?></a></td>
                <td><a href="userInfo.php?user_id=<?= $userInfo['user_id'] ?>"><?= $userInfo['last_name'] ?></a></td>
                <td><a href="userInfo.php?user_id=<?= $userInfo['user_id'] ?>"><?= $userInfo['birth_date'] ?></a></td>
                <td><a href="userUpdate.php?user_id=<?= $userInfo['user_id'] ?>"><i class="far fa-edit"></i></a></td>
                <td><a href="userDelete.php?user_id=<?= $userInfo['user_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"><i class="far fa-trash-alt"></i></a></td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>

<?php

    require_once "inc/footer.php"

?>

</html>