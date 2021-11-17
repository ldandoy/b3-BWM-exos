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
        
        $sql = 'INSERT INTO invoice (num, totalHT, totalTVA, totalTTC, user_id) VALUES (:num, :totalHT, :totalTVA, :totalTTC, :user_id)';
        $bdd->execute($sql, array(
            ':num'          => $_POST['num'],
            ':totalHT'      => $_POST['totalHT'],
            ':totalTVA'     => $_POST['totalTVA'],
            ':totalTTC'     => $_POST['totalTTC'],
            ':user_id'      => $_POST['client']
        ));
        header('Location: invoices.php');
    }

    $sql = "SELECT * FROM user";
    $users = $bdd->fetchAll($sql);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Créer une facture</h1>

        <form action="" method="post">
            <div>
                <label class="form-label" for="price">Numéro de Commande</label>
                <input class="form-input" type="text" required name="num" id="num" placeholder="Entrez le numéro de commande" />
            </div>
            <div>
                <label class="form-label" for="price">Total HT (€)</label>
                <input class="form-input" type="text" required name="totalHT" id="totalHT" placeholder="Entrez le total HT" />
            </div>
            <div>
                <label class="form-label" for="price">Total TVA (€)</label>
                <input class="form-input" type="text" required name="totalTVA" id="totalTVA" placeholder="Entrez le total TVA" />
            </div>
            <div>
                <label class="form-label" for="price">Total TTC (€)</label>
                <input class="form-input" type="text" required name="totalTTC" id="totalTTC" placeholder="Entrez le total TTC" />
            </div>
            <div>
                <label class="form-label" for="description">Client</label>
                <select class="form-input" required name="client" id="client">
                    <option>Choisissez un client</option>
                    <?php foreach ($users as $user) { ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-20">
                <input type="submit" name="send" value="Créer" />
                <a class="text-green" href="invoices.php">Retour</a>
            </div>
        </form>

    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 