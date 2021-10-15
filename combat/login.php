<?php require_once('session.php'); ?>
<?php
    $email = "";
    $password = "";

    if (isset($_POST['send'])) {
        require_once('Bdd.php');
        $bdd = new Bdd();

        $error =        [];
        $email =        $_POST['email'];
        $password =     $_POST['password'];

        if ($email != "" && $password != "") {
            $sql = 'SELECT * from users WHERE email = :email;';
            $user = $bdd->fetch($sql, array(
                ':email'    => $email
            ));

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                $error['password']  = 'Mauvais mot de passe';
                $error['email']     = 'Mauvais email';
            }

        } else {
            if ($email == "") {
                $error['email'] = 'Champs obligatoire';
            }
            
            if ($password == "") {
                $error['password'] = 'Champs obligatoire';
            }
        }
    }
?>
<?php require_once('./templates/header.php'); ?>
<div class="container">
    <form class="" action="" method="POST">
        <h1>Login</h1>
        <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control <?php if (isset($error['email'])) { ?>is-invalid <?php } ?>" id="exampleInputEmail" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Mot de passe</label>
            <input type="password" value="<?php echo $password; ?>" name="password" class="form-control <?php if (isset($error['password'])) { ?>is-invalid <?php } ?>" id="exampleInputPassword">
        </div>
        <button type="submit" name="send" class="btn btn-primary">Connexion</button>
    </form>
</div>
<?php require_once('./templates/footer.php'); ?>