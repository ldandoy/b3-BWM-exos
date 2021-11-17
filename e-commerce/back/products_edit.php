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
        // Gestion du fichier
        $picture = "";
        
        if ($_FILES['picture']['name'] !== "") {
            move_uploaded_file($_FILES['picture']['tmp_name'], './upload/'.$_FILES['picture']['name']);
            $picture = $_FILES['picture']['name'];
        }
        
        // Gestion des données
        $sql = 'UPDATE product SET name = :name, price = :price, description = :description, picture = :picture, product_category_id = :category WHERE id = :id';
        $bdd->execute($sql, array(
            ':id'           => $_POST['id'],
            ':name'         => $_POST['name'],
            ':price'        => $_POST['price'],
            ':description'  => $_POST['description'],
            ':category'     => $_POST['category'],
            ':picture'      => $picture
        ));
        header('Location: products.php');
    }

    # Faire la requète
    $sql = "SELECT * FROM product WHERE id = :id";
    $product = $bdd->fetch($sql, array(
        ':id' => $id
    ));

    $sql = "SELECT * FROM product_category";
    $categories_products = $bdd->fetchAll($sql);
    // var_dump($product);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Editer un produit</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $product['id'] ;?>" name="id" id="id" />

            <div>
                <label class="form-label" for="name">Nom</label>
                <input class="form-input" type="text" value="<?php echo $product['name']; ?>" required name="name" id="name" placeholder="Entrez le nom du produit" />
            </div>
            <div>
                <label class="form-label" for="price">Prix (€)</label>
                <input class="form-input" type="text" required value="<?php echo $product['price']; ?>" name="price" id="price" placeholder="Entrez le prix du produit" />
            </div>
            <div>
                <label class="form-label" for="description">Description</label>
                <textarea rows="10" class="form-input" type="text" required name="description" id="description" placeholder="Entrez la description du produit"><?php echo $product['description'] ;?></textarea>
            </div>
            <div>
                <label class="form-label" for="description">Catégorie</label>
                <select class="form-input" required name="category" id="category">
                    <option>Choisissez une catégorie</option>
                    <?php foreach ($categories_products as $cat) { ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $product['product_category_id']) ? "selected" : "" ?>>
                            <?php echo $cat['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="picture">Photo</label>
                <img width="300px" src="upload/<?php echo $product['picture']; ?>" alt="<?php echo $product['name']; ?>" />
                <input class="form-input" value="<?php echo $product['picture']; ?>" type="file"  name="picture" id="picture" placeholder="Ajouter une photo produit" />
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Mettre à jour" />
                <a class="text-green" href="products.php">Retour</a>
            </div>
        </form>

    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 