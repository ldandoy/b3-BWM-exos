<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();

    $sql = "DELETE FROM product_category WHERE id = :id";

    $bdd->execute($sql, array(
        ':id' => $_GET['id'],
    ));

    header('Location: categories_products.php');

?>