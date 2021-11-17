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
    $sql = "SELECT * FROM user WHERE id = :id";
    $user = $bdd->fetch($sql, array(
        ':id' => $id
    ));

    $sql = "SELECT * FROM invoice, user WHERE user_id = :id AND invoice.user_id = user.id";
    $invoices = $bdd->fetchAll($sql, array(
        ':id' => $id
    ));
    // var_dump($user);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Fiche user</h1>

        <div>
            <a class="text-green" href="users_edit.php?id=<?php echo $user['id']; ?>">Editer</a>
            <a class="text-green" onclick="return confirm('Are you sure?')" href="users_delete.php?id=<?php echo $user['id']; ?>">Supp</a>
        </div>

        <h2>Infos personnelles:</h2>
        <b>Nom</b>: <?php echo $user['firstname'] ;?><br />
        <b>Prénom</b>: <?php echo $user['lastname'] ;?><br />
        <b>Email</b>: <?php echo $user['email'] ;?><br />
        <br />
        <h2>Les factures du client:</h2>
        <br />
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Num</td>
                    <td>Client</td>
                    <td>HT</td>
                    <td>TVA</td>
                    <td>TTC</td>
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
                        <a class="text-green" href="invoices_show.php?id=<?php echo $invoice['id']; ?>">
                            <?php echo $invoice['num']; ?>
                        </a>
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
                        <!-- a href="invoices_edit.php?id=<?php echo $invoice['id']; ?>">Editer</a -->
                        <a class="text-green" onclick="return confirm('Are you sure?')" href="invoices_delete.php?id=<?php echo $invoice['id']; ?>">Supp</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br />
        <p><a class="text-green" href="users.php">Retour</a></p>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 