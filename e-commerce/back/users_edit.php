<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    # Récupération de l'id à partir de l'url
    $id = $_GET['id'];

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();

    # Traitement du formulaire
    if (isset($_POST['send'])) {
        // Gestion des données
        $sql = 'UPDATE user SET lastname = :lastname, firstname = :firstname, email = :email WHERE id = :id';
        $bdd->execute($sql, array(
            ':id'           => $_POST['id'],
            ':lastname'     => $_POST['lastname'],
            ':firstname'    => $_POST['firstname'],
            ':email'        => $_POST['email']
        ));

        if ($_POST['password'] != "") {
            $sql = 'UPDATE user SET password = :password WHERE id = :id';
            $bdd->execute($sql, array(
                ':id'           => $_POST['id'],
                ':password'     => password_hash($_POST['password'], PASSWORD_BCRYPT),
            ));
        }
        header('Location: users.php');
    }

    # Faire la requète
    $sql = "SELECT * FROM user WHERE id = :id";
    $user = $bdd->fetch($sql, array(
        ':id' => $id
    ));
    // var_dump($product);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Editer un user</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user['id'] ;?>" name="id" id="id" />

            <div>
                <label class="form-label" for="lastname">Nom</label>
                <input class="form-input" type="text" value="<?php echo $user['lastname']; ?>" required name="lastname" id="lastname" placeholder="Entrez le nom" />
            </div>
            <div>
                <label class="form-label" for="firstname">Prénom</label>
                <input class="form-input" type="text" required value="<?php echo $user['firstname']; ?>" name="firstname" id="firstname" placeholder="Entrez le prénom" />
            </div>
            <div>
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" value="<?php echo $user['email']; ?>" required name="email" id="email" placeholder="Entrez l'email" />
            </div>
            <div>
                <label class="form-label" for="password">Mot de passe</label>
                <input class="form-input" type="password" required name="password" id="password" placeholder="Entrez le mot de passe si vous voulez le modifier" />
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Mettre à jour" />
                <a class="text-green" href="users.php">Retour</a>
            </div>
        </form>

    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 