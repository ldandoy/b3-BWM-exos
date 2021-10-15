<?php require_once('session.php'); ?>
<?php
require_once('Bdd.php');
$bdd = new Bdd();

if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'augcc':
            $_SESSION['perso']['cc'] ++;
            $_SESSION['perso']['win'] ++;
            $sqlUpdate = "UPDATE persos SET cc = :cc, win = :win WHERE id = :persoId";
            $bdd->execute($sqlUpdate, array(
                ':cc'       => $_SESSION['perso']['cc'],
                ':win'      => $_SESSION['perso']['win'],
                ':persoId'  => $_SESSION['perso']['id']
            ));
            break;
        case 'augcd':
            $_SESSION['perso']['cd'] ++;
            $_SESSION['perso']['win'] ++;
            $sqlUpdate = "UPDATE persos SET cd = :cd, win = :win WHERE id = :persoId";
            $bdd->execute($sqlUpdate, array(
                ':cd'       => $_SESSION['perso']['cd'],
                ':win'      => $_SESSION['perso']['win'],
                ':persoId'  => $_SESSION['perso']['id']
            ));
            break;
        case 'augpdv':
            $_SESSION['perso']['pdv'] ++;
            $_SESSION['perso']['win'] ++;
            $sqlUpdate = "UPDATE persos SET pdv = :pdv, win = :win WHERE id = :persoId";
            $bdd->execute($sqlUpdate, array(
                ':pdv'      => $_SESSION['perso']['pdv'],
                ':win'      => $_SESSION['perso']['win'],
                ':persoId'  => $_SESSION['perso']['id']
            ));
            break;
    }

    unset($_SESSION['fighter']);
    $_SESSION['perso'] = $bdd->fetch('SELECT * FROM persos WHERE id = :persoId', array(
        ':persoId' => $_SESSION['perso']['id']
    ));
    header('Location: liste.php');
}