<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();
    $sql = "SELECT * FROM product_category";
    $categories_products = $bdd->fetchAll($sql);
    // var_dump($products);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Liste des categories de produits</h1>

        <a class="text-green" href="categories_products_new.php">Ajouter une categorie de produit</a>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td width='70%'>Nom</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories_products as $categories_product) { ?>
                <tr>
                    <td>
                        <?php echo $categories_product['id']; ?>
                    </td>
                    <td>
                        <?php echo $categories_product['name']; ?>
                    </td>
                    <td>
                        <a class="text-green" href="categories_products_show.php?id=<?php echo $categories_product['id']; ?>">Voir</a>
                        <a class="text-green" href="categories_products_edit.php?id=<?php echo $categories_product['id']; ?>">Editer</a>
                        <a class="text-green" onclick="return confirm('Are you sure?')" href="categories_products_delete.php?id=<?php echo $categories_product['id']; ?>">Supp</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 