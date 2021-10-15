<?php require_once('session.php'); ?>
<?php require_once('./templates/header.php'); ?>

<?php
    if (isset($_POST['send'])) {
        require_once('Bdd.php');
        $bdd = new Bdd();

        $InsertSQL = 'INSERT INTO users (email, password) VALUES (:email, :password);';
        $bdd->execute($InsertSQL, array(
            ':email'    => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ));

        header('Location: login.php');
    }
?>

<div class="container">
    <div class="row">
        <form method="post" action="">
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email</label>
                <input type="email" placeholder="Renseignez votre email" name="email" class="form-control" id="InputEmail" />
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Mot de passe</label>
                <input type="password" placeholder="Renseignez votre mot de passe" name="password" class="form-control" id="InputPassword" />
            </div>
            <button name="send" type="submit" class="btn btn-primary">Créer votre compte</button>
        </form>
    </div>
</div>

<?php require_once('./templates/footer.php'); ?>