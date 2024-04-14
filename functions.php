<?php

function adduser($pdo, $first_name, $last_name, $birth_date)
{
    $sql = "INSERT INTO users(first_name,last_name,birth_date) VALUES (:first_name,:last_name,:birth_date)";

    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $req->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }
}

function users_list($pdo)
{
    $sql = 'SELECT `first_name`, `last_name`, `birth_date`, `user_id` FROM `users`';

    $req = $pdo->query($sql);

    return $req->fetchAll();
}

function income_list($pdo)
{
    $sql = 'SELECT `inc_cat_name`, `inc_cat_id` FROM `incomes_categories`';

    $req = $pdo->query($sql);

    return $req->fetchAll();
}

function addIncome($pdo, $inc_amount, $user_id, $inc_receipt_date, $inc_cat_id)
{
    $sql = "INSERT INTO incomes(inc_amount,user_id,inc_receipt_date,inc_cat_id) VALUES (:inc_amount,:user_id,:inc_receipt_date,:inc_cat_id)";

    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':inc_amount', $inc_amount, PDO::PARAM_STR);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $inc_receipt_date, PDO::PARAM_STR);
    $req->bindValue(':inc_cat_id', $inc_cat_id, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }

}

function addExpense($pdo, $exp_amount, $user_id, $exp_date, $exp_label)
{
    $sql = "INSERT INTO expenses(exp_amount,user_id,exp_date,exp_label) VALUES (:exp_amount,:user_id,:exp_date,:exp_label)";

    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);
    $req->bindValue(':exp_label', $exp_label, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }

}

// Function permettant d'acceder aux détails utilisateurs mais j'utilise la fonction user_details sur tout le td, il se situe plus en dessous
function users_det($pdo, $user_id)
{

    $sql = "SELECT DISTINCT
    users.user_id,
    exp_id,
    inc_id,
    exp_amount,
    inc_amount
 FROM
    users
 INNER JOIN expenses ON users.user_id = expenses.user_id
 INNER JOIN incomes ON users.user_id = incomes.user_id WHERE users.user_id = ?";

    $req = $pdo->prepare($sql);

    $req->execute(array($user_id));

    $userdet = $req->fetchAll(PDO::FETCH_ASSOC);
    return $userdet;
}

// fin details

function updateUser($pdo, $user_id, $first_name, $last_name, $birth_date)
{
    $sql = "UPDATE `users` SET `first_name` = :first_name, `last_name` = :last_name, `birth_date` = :birth_date WHERE `user_id` = :user_id";
    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    // lier la variable sql avec une valeur php
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $req->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);
    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }
}



function user_details($pdo, $user_id)
{
    $sql = "SELECT `first_name`, `last_name`, `birth_date` FROM `users` WHERE `user_id` = :user_id";
    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function income_details($pdo, $inc_id)
{
    $sql = "SELECT `inc_amount`, `inc_receipt_date`, `inc_cat_id` FROM `incomes` WHERE `inc_id` = :inc_id";
    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $inc_id, PDO::PARAM_INT);
    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function expense_details($pdo, $exp_id)
{
    $sql = "SELECT `exp_amount`,`exp_date`,`exp_amount`,`exp_label`, `exp_id` FROM `expenses` WHERE `exp_id` = :exp_id";
    $req = $pdo->prepare($sql);
    $req->bindValue(':exp_id', $exp_id, PDO::PARAM_INT);
    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function updateIncome($pdo, $inc_id, $inc_amount, $inc_receipt_date, $inc_cat_id)
{
    $sql = "UPDATE `incomes` SET `inc_amount` = :inc_amount, `inc_receipt_date` = :inc_receipt_date, `inc_cat_id` = :inc_cat_id WHERE `inc_id` = :inc_id";
    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $inc_id, PDO::PARAM_INT);
    $req->bindValue(':inc_amount', $inc_amount, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $inc_receipt_date, PDO::PARAM_STR);
    $req->bindValue(':inc_cat_id', $inc_cat_id, PDO::PARAM_INT);
    try {
        $req->execute();
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }
}


function updateExpense($pdo, $exp_id, $exp_amount, $exp_date)
{
    $sql = "UPDATE `incomes` SET `exp_amount` = :ex_amount, `exp_date` = :exp_date, `exp_id` = :exp_id WHERE `exp_id` = :exp_id";
    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $exp_id, PDO::PARAM_INT);
    $req->bindValue(':inc_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $exp_date, PDO::PARAM_STR);
    
    try {
        $req->execute();
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }
}

// recuperatin des utilisateurs qui n'ont pas de revenus 

function user_list_nodata($pdo)
{
    $sql = "SELECT `user_id`, `first_name`, `last_name`, `birth_date` FROM `users`";
    $req = $pdo->query($sql);
    $users = $req->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
