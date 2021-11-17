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
        <h1 id="title">Fiche categorie produit</h1>

        <div>
            <a class="text-green" href="categories_products_edit.php?id=<?php echo $categories_product['id']; ?>">Editer</a>
            <a class="text-green" onclick="return confirm('Are you sure?')" href="categories_products_delete.php?id=<?php echo $categories_product['id']; ?>">Supp</a>
        </div>

        <h2><?php echo $categories_product['name'] ;?></h2>
        <br />
        <p><a class="text-green" href="categories_products.php">Retour</a></p>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 