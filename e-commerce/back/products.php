<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();
    $sql = "SELECT * FROM product";
    $products = $bdd->fetchAll($sql);
    // var_dump($products);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Liste des produits</h1>

        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td width='70%'>Nom</td>
                    <td>Prix (€)</td>
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
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['price']; ?>
                    </td>
                    <td>
                        <a href="products_edit.php?id=<?php echo $product['id']; ?>">Editer</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 