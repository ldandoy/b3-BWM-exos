<?php
    if (isset($_GET['name']) && $_GET['name'] != "") {
        $nom = $_GET['name'];
        echo 'Bonjour ' . $nom;
    } else {
        header('Location:name.php');
    }
?>