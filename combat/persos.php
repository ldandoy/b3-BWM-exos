<?php require_once('session.php'); ?>
<?php
require_once('Bdd.php');
$bdd = new Bdd();
 
$persos = $bdd->fetchAll('SELECT * FROM persos WHERE user_id = :userId', array(
    ':userId' => $_SESSION['user']['id']
));

require_once('./templates/header.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <table class="table table-dark table-hover table-striped" width="100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Cc</th>
                        <th>Cd</th>
                        <th>Pdv</th>
                        <th>Win</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($persos as $row) { ?>
                        <tr>
                            <td width="80%"><?php echo $row['name']; ?></td>
                            <td width="5%"><?php echo $row['cc']; ?></td>
                            <td width="5%"><?php echo $row['cd']; ?></td>
                            <td width="5%"><?php echo $row['pdv']; ?></td>
                            <td width="5%"><?php echo $row['win']; ?></td>
                            <td>
                                <a href="liste.php?persoId=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Choisir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once('./templates/footer.php'); ?>