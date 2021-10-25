<?php require_once('templates/_header.php'); ?>

<?php

require_once('./classes/Bdd.php');

if (isset($_POST['send'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];

    if ($email !== "" && $password !== "" && $firstname !== "" && $lastname !== "") {
        $sql = "INSERT INTO user (`email`, `password`, `firstname`, `lastname`) VALUES (:email, :password, :firstname, :lastname);";

        $bdd = new Bdd();
        $bdd->execute($sql, array(
            ':email'        => $email,
            ':password'     => password_hash($password, PASSWORD_BCRYPT),
            ':firstname'    => $firstname,
            ':lastname'     => $lastname
        ));
    }


}

?>

<h1>Créez votre compte</h1>

<form action="" method="post">
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" require name="firstname" id="firstname" placeholder="Entrez votre prénom" />
    </div>
    <div>
        <label for="lastname">Nom</label>
        <input type="text" require name="lastname" id="lastname" placeholder="Entrez votre nom" />
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" require name="email" id="email" placeholder="Entrez votre email" />
    </div>
    <div>
        <label for="pwd">Password</label>
        <input type="password" require name="password" id="pwd" placeholder="Entrez votre mot de passe" />
    </div>
    <div>
        <input type="submit" name="send" value="Créer le compte" />
    </div>
    <a href="login.php">Déjà un compte ?</a>
</form>

<?php require_once('templates/_footer.php'); ?> 