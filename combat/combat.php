<?php require_once('./session.php'); ?>
<?php
    require_once('Bdd.php');
    $bdd = new Bdd();

    if (!isset($_SESSION['fighter']) && isset($_GET['id'])) {
        $_SESSION['fighter'] = $bdd->fetch('SELECT * FROM fighters WHERE id = :id', array(
            ':id' => $_GET['id']
        ));
    } else {
        if (!isset($_SESSION['fighter']) && !isset($_GET['id'])) header('Location:liste.php');
    }
?>
<?php require_once('./templates/header.php'); ?>
<div class="container">
    <div class="row">
<?php
    if ($_SESSION['fighter']['pdv'] >= 0 && $_SESSION['perso']['pdv'] >= 0) {
        $salt_fighter = rand(0, 20);
        $salt_perso = rand(0, 20);
    
        echo $salt_fighter . " " . $salt_perso."<br />";
    
        $att_perso = $salt_perso + $_SESSION['perso']['cc'];
        $def_perso = $salt_perso + $_SESSION['perso']['cd'];
    
        $att_fighter = $salt_fighter + $_SESSION['fighter']['cc'];
        $def_fighter = $salt_fighter + $_SESSION['fighter']['cd'];
?>
<?php
        // L'attaque de votre perso
        if ($att_perso >= $def_fighter) {
            $_SESSION['fighter']['pdv'] -= ($att_perso - $def_fighter);
            echo '<div>Votre perso touche et retire ' . ($att_perso - $def_fighter) . ' pv à votre adversaire.</div>';
        }
        
        // La réponse du fighter
        if ($att_fighter >= $def_perso) {
            $_SESSION['perso']['pdv'] -= ($att_fighter - $def_perso);
            echo '<div>Il touche votre preso. Il lui retire: ' . ($att_fighter - $def_perso) . ' pdv.</div>';
        }
    }
?>
        <div>
            Vous avez:  <?php echo $_SESSION['perso']['pdv']; ?> pdv.<br />
            Votre ennemi a : <?php echo $_SESSION['fighter']['pdv']; ?> pdv.<br />
        </div>

        <?php if ($_SESSION['perso']['pdv'] >= 0 && $_SESSION['fighter']['pdv'] <= 0) { ?>
            <div>
                Vous avez gangé !<br />
                Vous pouvez augementer l'une des caratéristiques de votre personnage:
            </div>
            <div>
                <a class="btn btn-success btn-sm" href="update.php?action=augcc">Augmenter la competence de combat</a>
                <a class="btn btn-success btn-sm" href="update.php?action=augcd">Augmenter la compétence de défense</a>
                <a class="btn btn-success btn-sm" href="update.php?action=augpdv">Augmenter votre total de point de vie</a>
            </div>
        <?php } else { ?>
            <div>
                <a class="btn btn-success btn-sm" href="combat.php">Continuer</a>
            </div>
        <?php } ?>
    </div>
</div>
<?php require_once('./templates/footer.php'); ?>