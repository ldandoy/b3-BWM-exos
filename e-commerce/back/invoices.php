<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();
    $sql = "SELECT invoice.*, user.lastname, user.firstname FROM invoice, user WHERE invoice.user_id = user.id";
    $invoices = $bdd->fetchAll($sql);
    // var_dump($products);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Liste des factures</h1>

        <a class="text-green" href="invoices_new.php">Ajouter une facture</a>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Num</td>
                    <td>Client</td>
                    <td>HT (€)</td>
                    <td>TVA (€)</td>
                    <td>TTC (€)</td>
                    <td>Date</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($invoices as $invoice) { ?>
                <tr>
                    <td>
                        <?php echo $invoice['id']; ?>
                    </td>
                    <td>
                        <?php echo $invoice['num']; ?>
                    </td>
                    <td>
                        <?php echo $invoice['firstname']; ?> <?php echo $invoice['lastname']; ?>
                    </td>
                    <td>
                        <?php echo $invoice['totalHT']; ?>
                    </td>
                    <td>
                        <?php echo $invoice['totalTVA']; ?>
                    </td>
                    <td>
                        <?php echo $invoice['totalTTC']; ?>
                    </td>
                    <td>
                        <?php echo $invoice['created_at']; ?>
                    </td>
                    <td>
                        <a class="text-green" href="invoices_show.php?id=<?php echo $invoice['id']; ?>">Voir</a>
                        <!-- a class="text-green" href="invoices_edit.php?id=<?php echo $invoice['id']; ?>">Editer</a -->
                        <a class="text-green" onclick="return confirm('Are you sure?')" href="invoices_delete.php?id=<?php echo $invoice['id']; ?>">Supp</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 