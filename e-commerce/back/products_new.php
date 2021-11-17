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
        // Gestion du fichier
        $picture = "";
        
        if ($_FILES['picture']['name'] !== "") {
            move_uploaded_file($_FILES['picture']['tmp_name'], './upload/'.$_FILES['picture']['name']);
            $picture = $_FILES['picture']['name'];
        }

        $sql = 'INSERT INTO product  (name, price, description, picture, product_category_id) VALUES (:name, :price, :description, :picture, :category)';
        $bdd->execute($sql, array(
            ':name'         => $_POST['name'],
            ':price'        => $_POST['price'],
            ':description'  => $_POST['description'],
            ':category'     => $_POST['category'],
            ':picture'      => $picture
        ));
        header('Location: products.php');
    }

    $sql = "SELECT * FROM product_category";
    $categories_products = $bdd->fetchAll($sql);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Créer un produit</h1>

        <form action="" method="post"  enctype="multipart/form-data">
            <div>
                <label class="form-label" for="name">Nom</label>
                <input class="form-input" type="text" required name="name" id="name" placeholder="Entrez le nom du produit" />
            </div>
            <div>
                <label class="form-label" for="price">Prix (€)</label>
                <input class="form-input" type="text" required name="price" id="price" placeholder="Entrez le prix du produit" />
            </div>
            <div>
                <label class="form-label" for="description">Description</label>
                <input class="form-input" type="text" required name="description" id="description" placeholder="Entrez la description du produit" />
            </div>
            <div>
                <label class="form-label" for="description">Catégorie</label>
                <select class="form-input" required name="category" id="category">
                    <option>Choisissez une catégorie</option>
                    <?php foreach ($categories_products as $cat) { ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="picture">Photo</label>
                <input class="form-input" type="file"  name="picture" id="picture" placeholder="Ajouter une photo produit" />
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Créer" />
                <a class="text-green" href="products.php">Retour</a>
            </div>
        </form>

    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 