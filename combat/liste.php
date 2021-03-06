<?php require_once('session.php'); ?>
<?php
require_once('Bdd.php');
$bdd = new Bdd();

var_dump($_SESSION);

if (!isset($_SESSION['perso']) && isset($_GET['persoId'])) {
    $_SESSION['perso'] = $bdd->fetch('SELECT * FROM persos WHERE id = :persoId', array(
        ':persoId' => $_GET['persoId']
    ));
}

$fighters = $bdd->fetchAll('SELECT * FROM fighters');

require_once('./templates/header.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <div class="text-center"><b><?php echo $_SESSION['perso']['name'];?></b></div>
                    cc: <?php echo $_SESSION['perso']['cc'];?><br />
                    cd: <?php echo $_SESSION['perso']['cd'];?><br />
                    pdv: <?php echo $_SESSION['perso']['pdv'];?><br />
                    win: <?php echo $_SESSION['perso']['win'];?>
                </div>
            </div>
        </div>
        <div class="col">
            <table class="table table-dark table-hover table-striped" width="100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Cc</th>
                        <th>Cd</th>
                        <th>Pdv</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fighters as $row) { ?>
                        <tr>
                            <td width="80%"><?php echo $row['name']; ?></td>
                            <td width="5%"><?php echo $row['cc']; ?></td>
                            <td width="5%"><?php echo $row['cd']; ?></td>
                            <td width="5%"><?php echo $row['pdv']; ?></td>
                            <td>
                                <a href="combat.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Combattre</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once('./templates/footer.php'); ?>