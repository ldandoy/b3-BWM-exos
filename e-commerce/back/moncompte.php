<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }
    
    $user = $session->get('user');
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1>Votre compte <?php echo $user["firstname"] . " " . $user["lastname"]; ?></h1>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 