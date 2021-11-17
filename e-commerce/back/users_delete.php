<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();

    $sql = "DELETE FROM user WHERE id = :id";

    $bdd->execute($sql, array(
        ':id' => $_GET['id'],
    ));

    header('Location: users.php');

?>