<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();
    $sql = "SELECT product.*, product_category.name as product_category_name, product_category.id as product_category_id FROM product, product_category WHERE product.product_category_id = product_category.id";
    $products = $bdd->fetchAll($sql);
    // var_dump($products);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Liste des produits</h1>

        <a class="text-green" href="products_new.php">Ajouter un produit</a>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Photo</td>
                    <td width='70%'>Nom</td>
                    <td>Prix (€)</td>
                    <td>Catégorie</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) { ?>
                <tr>
                    <td>
                        <?php echo $product['id']; ?>
                    </td>
                    <td>
                    <img width="50px" src="upload/<?php echo $product['picture']; ?>" alt="<?php echo $product['name']; ?>" />
                    </td>
                    <td>
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['price']; ?>
                    </td>
                    <td>
                        <a class="text-green" href="categories_products_show.php?id=<?php echo $product['product_category_id']; ?>">
                            <?php echo $product['product_category_name']; ?>
                        </a>
                    </td>
                    <td>
                        <a class="text-green" href="products_show.php?id=<?php echo $product['id']; ?>">Voir</a>
                        <a class="text-green" href="products_edit.php?id=<?php echo $product['id']; ?>">Editer</a>
                        <a class="text-green" onclick="return confirm('Are you sure?')" href="products_delete.php?id=<?php echo $product['id']; ?>">Supp</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 