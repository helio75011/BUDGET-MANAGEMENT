<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="<?php echo $href ?>" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
  <link href="assets/css/navbar.css" rel="stylesheet">
  <link href="assets/css/footer.css" rel="stylesheet">
  <!-- fontawesome cdn -->
  <title>Budget</title>
</head>

<body>

<header>
  <nav>
    <input id="nav-toggle" type="checkbox">
    <div class="logo"><a href="index.php" style="text-decoration: none; color: #fff;">Gestion <strong>de budget</strong></a></div>
    <ul class="links">

      <li><a href="userBudget.php">Budget utilisateur</a></li>
      <li><a href="incomedecl.php">Déclarations revenus</a></li>
      <li><a href="addExpenses.php">Déclarations dépenses</a></li>
      <li><a href="addUser.php">Ajouter utilisateur</a></li>
      <li><a href="userList.php">Liste des utilisateurs</a></li>
      <li><a href="logout.php">Déconnexion</a></li>
    </ul>
    <label for="nav-toggle" class="icon-burger">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </label>
  </nav>
</header>