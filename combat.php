<?php

require_once('Bdd.php');
$bdd = new Bdd();

$user = "root";
$pass = "root";

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
} catch (PDOException $e) {
    echo 'Erreur !: ' . $e->getMessage() . '<br/>';
    die();
}

$sql = 'SELECT * FROM fighters WHERE id = :id';
$sth = $dbh->prepare($sql);
$sth->execute(array(
    ':id' => $_GET['id']
));
$fighter = $sth->fetch(PDO::FETCH_ASSOC);

// var_dump($fighter);

$sql2 = 'SELECT * FROM perso';
$sth = $dbh->prepare($sql2);
$sth->execute();
$perso = $sth->fetch(PDO::FETCH_ASSOC);

echo "<h1>Déroulement du combat</h1>";

do {
    $salt_fighter = rand(0, 20);
    $salt_perso = rand(0, 20);
    // echo $salt_fighter . " " . $salt_perso."<br />";

    $att_perso = $salt_perso + $perso['cc'];
    $def_perso = $salt_perso + $perso['cd'];

    $att_fighter = $salt_fighter + $fighter['cc'];
    $def_fighter = $salt_fighter + $fighter['cd'];
    
    // attaque du perso
    if ($att_perso >= $def_fighter) {
        $fighter['pdv'] -= ($att_perso - $def_fighter);
        echo "Votre perso touche<br />";
    }
    
    // attaque du fighter
    if ($att_fighter >= $def_perso) {
        echo "Il vous touche<br />";
        $perso['pdv'] -= ($att_fighter - $def_perso);
    }

    echo "Vous avez: " . $perso['pdv'] . " pdv.<br />";
    echo "Votre ennemi a : " . $fighter['pdv'] . " pdv.<br />";
    // echo "<a href='connect.php'>Quitter le combat ?</a>";
    echo "<hr />";
    
} while ($fighter['pdv'] >= 0 && $perso['pdv'] >= 0);

if ($perso['pdv'] >= 0) {
    echo "Vous avez gagné !<br />";
    echo "Quel caractéristique voulez vous augementer ?<br />";
    echo "<a href='connect.php?action=augcc'>CC</a> <a href='connect.php?action=augcd'>CD</a> <a href='connect.php?action=augpdv'>PDV</a><br />";
} else {
    echo "Vous avez perdu !";
}

?>