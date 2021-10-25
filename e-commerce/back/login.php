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

<h1>Login</h1>

<?php

if ($error) {
    echo $error;
}
?>

<form action="" method="post">
    <div>
        <label for="email">Email</label>
        <input type="email" required name="email" id="email" placeholder="Entrez votre email" />
    </div>
    <div>
        <label for="pwd">Password</label>
        <input type="password" required name="password" id="pwd" placeholder="Entrez votre mot de passe" />
    </div>
    <div>
        <input type="submit" name="send" value="Connexion" />
    </div>

    <a href="register.php">Pas encore de compte ?</a>
</form>

<?php require_once('templates/_footer.php'); ?> 