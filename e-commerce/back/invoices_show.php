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
    $sql = "SELECT invoice.*, user.lastname, user.firstname FROM invoice, user WHERE invoice.id = :id AND invoice.user_id = user.id";
    $invoice = $bdd->fetch($sql, array(
        ':id' => $id
    ));

    $sql = "SELECT * FROM invoice_product, product WHERE invoice_product.invoice_id = :id";
    $invoice_lines = $bdd->fetchAll($sql, array(
        ':id' => $id
    ));
    // var_dump($invoice_lines);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Fiche facture: <?php echo $invoice['num'] ;?></h1>

        <p>Client: <a class="text-green" href="users_show.php?id=<?php echo $invoice['user_id']; ?>"><?php echo $invoice['firstname'] ;?> <?php echo $invoice['lastname'] ;?></a></p>
        <p>Total HT: <?php echo $invoice['totalHT'] ;?>€</p>
        <p>Total TVA: <?php echo $invoice['totalTVA'] ;?>€</p>
        <p>Total TTC: <?php echo $invoice['totalTTC'] ;?>€</p>
        <p>Date de création: <?php echo $invoice['created_at'] ;?></p>
        <br />
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Product</td>
                    <td>Quanty</td>
                    <td>prix unitaire (€)</td>
                    <td>Total HT (€)</td>
                </tr>
            </thead>
            <?php foreach($invoice_lines as $line) { ?>
                <tr>
                    <td>
                        <?php echo $line['id']; ?>
                    </td>
                    <td>
                        <a class="text-green" href="products_show.php?id=<?php echo $line['id']; ?>">
                            <?php echo $line['name']; ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $line['quantity']; ?>
                    </td>
                    <td>
                        <?php echo $line['price']; ?>
                    </td>
                    <td>
                        <?php echo $line['quantity']*$line['price'] ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br />
        <p><a class="text-green" href="invoices.php">Retour</a></p>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 