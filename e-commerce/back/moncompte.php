<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    $user = $session->get('user');
?>

<div class="">
    <nav>
        <ul>
            <li>Les produits</li>
            <li>Les catégories</li>
            <li>Les factures</li>
            <li>Les messages</li>
            <li>Les utilisateurs</li>
        </ul>
    </nav>
    <main>
        <h1>Votre compte <?php echo $user["firstname"] . " " . $user["lastname"]; ?></h1>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 