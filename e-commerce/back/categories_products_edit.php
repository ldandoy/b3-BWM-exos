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
        $sql = 'UPDATE product_category SET name = :name WHERE id = :id';
        $bdd->execute($sql, array(
            ':id'           => $_POST['id'],
            ':name'         => $_POST['name'],
        ));
        header('Location: categories_products.php');
    }

    # Faire la requète
    $sql = "SELECT * FROM product_category WHERE id = :id";
    $categories_product = $bdd->fetch($sql, array(
        ':id' => $id
    ));
    // var_dump($product);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Editer une categorie de produit</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $categories_product['id'] ;?>" name="id" id="id" />

            <div>
                <label class="form-label" for="name">Nom</label>
                <input class="form-input" type="text" value="<?php echo $categories_product['name']; ?>" required name="name" id="name" placeholder="Entrez le nom du produit" />
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Mettre à jour" />
                <a class="text-green" href="categories_products.php">Retour</a>
            </div>
        </form>

    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 