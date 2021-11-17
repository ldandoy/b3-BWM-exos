<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();

    # Traitement du formulaire
    if (isset($_POST['send'])) {
        $sql = 'INSERT INTO user  (lastname, firstname, email, password) VALUES (:lastname, :firstname, :email, :password)';
        $bdd->execute($sql, array(
            ':lastname'         => $_POST['lastname'],
            ':firstname'        => $_POST['firstname'],
            ':email'            => $_POST['email'],
            ':password'         => password_hash($_POST['password'], PASSWORD_BCRYPT),
        ));
        header('Location: users.php');
    }
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Créer un user</h1>

        <form action="" method="post">
            <input type="hidden" value="<?php echo $user['id'] ;?>" name="id" id="id" />

            <div>
                <label class="form-label" for="lastname">Nom</label>
                <input class="form-input" type="text" required name="lastname" id="lastname" placeholder="Entrez le nom" />
            </div>
            <div>
                <label class="form-label" for="firstname">Prénom</label>
                <input class="form-input" type="text" required  name="firstname" id="firstname" placeholder="Entrez le prénom" />
            </div>
            <div>
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" required name="email" id="email" placeholder="Entrez l'email" />
            </div>
            <div>
                <label class="form-label" for="password">Mot de passe</label>
                <input class="form-input" type="password" required name="password" id="password" placeholder="Entrez le mot de passe si vous voulez le modifier" />
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Créer" />
                <a class="text-green" href="users.php">Retour</a>
            </div>
        </form>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 