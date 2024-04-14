<?php
require_once 'libraries/database.php'; // Assurez-vous que ce fichier existe et qu'il contient la fonction de connexion à la base de données

if (!isset($href)) {
    $href = "assets/css/register.css";
}

// Initialiser une variable pour les messages d'erreur ou de succès
$message = '';
$href = "assets/css/register.css";

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation sommaire des données
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $message = 'Tous les champs sont requis.';
    } else {
        // Cryptage du mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Enregistrement dans la base de données
        $pdo = db_connect(); // Assurez-vous que cette fonction retourne l'objet PDO
        $stmt = $pdo->prepare("INSERT INTO count_users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$first_name, $last_name, $email, $passwordHash]);

        if ($result) {
            $message = 'Inscription réussie.';
            header('Location: login.php');
        } else {
            $message = 'Une erreur est survenue.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php

    require_once "inc/header_register.php";

    ?>
    <div class="container">
        <h2>Inscription</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <input type="text" name="first_name" placeholder="Prénom" required>
            <input type="text" name="last_name" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="button">S'inscrire</button>
        </form>
    </div>
    <?php
    
    require_once "inc/footer.php";

    ?>
</body>
</html>






<?php
// Inclusion du fichier qui gère la connexion à la base de données.
// Ce fichier doit contenir la fonction db_connect qui établit la connexion à la base de données.
require_once 'libraries/database.php';

// Vérifie si la variable $href est déjà définie, sinon, définit le chemin vers la feuille de style pour la page d'inscription.
if (!isset($href)) {
    $href = "assets/css/register.css";
}

// Initialisation d'une variable pour stocker les messages d'erreur ou de succès qui seront affichés à l'utilisateur.
$message = '';

// Définition du chemin vers la feuille de style CSS pour la page d'inscription.
$href = "assets/css/register.css";

// Traitement du formulaire d'inscription lorsque la méthode de requête est POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données envoyées par l'utilisateur via le formulaire.
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification si tous les champs requis sont remplis.
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        // Si un ou plusieurs champs sont vides, on définit un message d'erreur.
        $message = 'Tous les champs sont requis.';
    } else {
        // Cryptage du mot de passe pour des raisons de sécurité avant de l'enregistrer dans la base de données.
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Connexion à la base de données en utilisant la fonction db_connect définie dans 'database.php'.
        $pdo = db_connect();
        
        // Préparation de la requête SQL pour insérer les nouvelles informations de l'utilisateur dans la base de données.
        $stmt = $pdo->prepare("INSERT INTO count_users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        
        // Exécution de la requête avec les données de l'utilisateur.
        $result = $stmt->execute([$first_name, $last_name, $email, $passwordHash]);

        // Vérification si l'insertion a réussi.
        if ($result) {
            // Si l'inscription est réussie, affichage d'un message de succès et redirection vers la page de connexion.
            $message = 'Inscription réussie.';
            header('Location: login.php');
            exit;
        } else {
            // En cas d'erreur lors de l'insertion, définition d'un message d'erreur.
            $message = 'Une erreur est survenue.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <!-- Lien vers la feuille de style CSS pour styliser la page d'inscription -->
    <link rel="stylesheet" href="<?php echo $href; ?>">
</head>
<body>
    <?php
    // Inclusion du fichier d'en-tête spécifique à la page d'inscription.
    require_once "inc/header_register.php";
    ?>
    
    <div class="container">
        <h2>Inscription</h2>
        <!-- Affichage du message d'erreur ou de succès -->
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <!-- Formulaire d'inscription demandant le prénom, le nom, l'email et le mot de passe -->
        <form action="register.php" method="post">
            <input type="text" name="first_name" placeholder="Prénom" required>
            <input type="text" name="last_name" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="button">S'inscrire</button>
        </form>
    </div>
    
    <?php
    // Inclusion du fichier de pied de page.
    require_once "inc/footer.php";
    ?>
</body>
</html>
