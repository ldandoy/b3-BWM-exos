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
        $sql = 'INSERT INTO product_category  (name) VALUES (:name)';
        $bdd->execute($sql, array(
            ':name'         => $_POST['name'],
        ));
        header('Location: categories_products.php');
    }
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Créer une categorie de produit</h1>

        <form action="" method="post">
            <div>
                <label class="form-label" for="name">Nom</label>
                <input class="form-input" type="text" required name="name" id="name" placeholder="Entrez le nom du produit" />
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Créer" />
                <a class="text-green" href="categories_products.php">Retour</a>
            </div>
        </form>

    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 