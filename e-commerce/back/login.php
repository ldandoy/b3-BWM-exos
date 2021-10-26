<?php
    require_once('./classes/Bdd.php');
    require_once('./classes/Session.php');

    $session = new Session();

    $error = null;

    if (isset($_POST['send'])) {
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        
        if ($email !== "" && $password !== "") {
            $bdd = new Bdd();

            $sql = "SELECT * FROM user WHERE email = :email;";
            $user = $bdd->fetch($sql, array(
                ':email' => $email
            ));

            if ($user && password_verify($password, $user['password'])) {
                $session->set('user', $user);
                header('Location: moncompte.php');
            } else {
                $error = 'Mauvais login ou mot de passe.';
            }
        }
    }
?>

<?php require_once('templates/_header.php'); ?>

<form class="form" action="" method="post">
    
    <h1 id="title" class="text-center">Login</h1>

    <?php

    if ($error) {
        echo $error;
    }
    ?>

    <div>
        <label class="form-label" for="email">Email</label>
        <input class="form-input" type="email" required name="email" id="email" placeholder="Entrez votre email" />
    </div>
    <div>
        <label class="form-label" for="pwd">Password</label>
        <input class="form-input" type="password" required name="password" id="pwd" placeholder="Entrez votre mot de passe" />
    </div>
    <div class="mb-20">
        <input type="submit" name="send" value="Connexion" />
    </div>
    <div class="text-center">
        <a href="register.php">Pas encore de compte ?</a>
    </div>
</form>

<?php require_once('templates/_footer.php'); ?> 