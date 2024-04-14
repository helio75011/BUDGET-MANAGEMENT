<?php

session_start();

require_once 'libraries/database.php'; // Assurez-vous que ce fichier existe et qu'il contient la fonction de connexion à la base de données

if (!isset($href)) {
    $href = "assets/css/login.css";
}

// Initialiser une variable pour les messages d'erreur
$message = '';

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = 'Email et mot de passe sont requis.';
    } else {
        $pdo = db_connect(); // Assurez-vous que cette fonction retourne l'objet PDO
        $stmt = $pdo->prepare("SELECT * FROM count_users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // L'utilisateur est connecté avec succès
            // Créer une session ou rediriger l'utilisateur vers une autre page
            $_SESSION['user_logged_in'] = true;
            $message = 'Connexion réussie.';
            header('Location: index.php');
        } else {
            $message = 'Identifiants incorrects.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php
    
    require_once "inc/header_login.php";

    ?>
    <div class="container">
        <h2>Connexion</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="button">Se connecter</button>
        </form>
    </div>
    <?php
    
    require_once "inc/footer.php";

    ?>
</body>
</html>




















<?php

// Démarrage de la session pour conserver l'état de connexion de l'utilisateur
session_start();

// Inclusion du script de la base de données pour utiliser sa fonction de connexion
// Assurez-vous que ce fichier existe et qu'il contient la fonction de connexion à la base de données.
require_once 'libraries/database.php';

// Définition de la feuille de style par défaut pour la page de connexion si non spécifiée.
if (!isset($href)) {
    $href = "assets/css/login.css";
}

// Initialisation d'une variable pour stocker les messages d'erreur ou de succès
$message = '';

// Vérification si la page est accédée avec une méthode POST, indiquant une tentative de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données envoyées par l'utilisateur via le formulaire de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification si les champs email et mot de passe ne sont pas vides
    if (empty($email) || empty($password)) {
        // Si l'un des champs est vide, affichage d'un message d'erreur
        $message = 'Email et mot de passe sont requis.';
    } else {
        // Connexion à la base de données à l'aide de la fonction définie dans 'database.php'
        $pdo = db_connect(); // Cette fonction doit retourner un objet PDO pour la connexion à la base de données

        // Préparation de la requête SQL pour vérifier si l'email existe dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM count_users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si un utilisateur correspondant a été trouvé et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            // Si les identifiants sont corrects, l'utilisateur est considéré comme connecté
            $_SESSION['user_logged_in'] = true; // Création d'une variable de session pour indiquer la connexion
            $message = 'Connexion réussie.';
            header('Location: index.php'); // Redirection vers la page d'accueil
            exit; // Arrêt du script pour éviter le chargement de la page de connexion après la redirection
        } else {
            // Si les identifiants sont incorrects, affichage d'un message d'erreur
            $message = 'Identifiants incorrects.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <!-- Lien vers la feuille de style CSS pour styliser la page de connexion -->
    <link rel="stylesheet" href="<?php echo $href; ?>">
</head>
<body>
    <?php
    // Inclusion du fichier d'en-tête spécifique à la page de connexion
    require_once "inc/header_login.php";
    ?>

    <div class="container">
        <h2>Connexion</h2>
        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <!-- Formulaire de connexion pour l'email et le mot de passe -->
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="button">Se connecter</button>
        </form>
    </div>
    
    <?php
    // Inclusion du fichier de pied de page commun
    require_once "inc/footer.php";
    ?>
</body>
</html>
