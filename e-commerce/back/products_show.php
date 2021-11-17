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
    $sql = "SELECT product.*, product_category.name as product_category_name  FROM product, product_category WHERE product.id = :id AND product.product_category_id = product_category.id";
    $product = $bdd->fetch($sql, array(
        ':id' => $id
    ));
    // var_dump($product);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Fiche produit</h1>
        <div>
            <a class="text-green" href="products_edit.php?id=<?php echo $product['id']; ?>">Editer</a>
            <a class="text-green" onclick="return confirm('Are you sure?')" href="products_delete.php?id=<?php echo $product['id']; ?>">Supp</a>
            <a class="text-green" href="products.php">Retour</a>
        </div>

        <img width="300px" src="upload/<?php echo $product['picture']; ?>" alt="<?php echo $product['name']; ?>" />

        <h2><?php echo $product['name'] ;?></h2>
        <p><?php echo $product['price'] ;?>€</p>
        <p><?php echo $product['description'] ;?></p>
        <p><a class="text-green" target="_blank" href="categories_products_show.php?id=<?php echo $product['product_category_id']; ?>"><?php echo $product['product_category_name'] ;?></a></p>
        <br />
        <p><a class="text-green" href="products.php">Retour</a></p>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 