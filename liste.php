<?php
require_once('Bdd.php');
$bdd = new Bdd();
 
$perso = $bdd->fetch('SELECT * FROM perso');

require_once('update.php');
require_once('./templates/header.php');
?>
<div class="container">

<div class="card">
    <div class="card-body">
        Nom: <?php echo $perso['name'];?><br />
        cc: <?php echo $perso['cc'];?><br />
        cd: <?php echo $perso['cd'];?><br />
        pdv: <?php echo $perso['pdv'];?><br />
        win: <?php echo $perso['win'];?>
    </div>
</div>

<?php
$sql = 'SELECT * FROM fighters';
$fighters = $bdd->fetchAll($sql);
?>
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
    <?php
        foreach ($fighters as $row) {
            // echo "<tr>";
            // echo "<td>".$row['name']."</td>";
            // echo "</tr>";
            ?>
            <tr>
                <td width="80%"><?php echo $row['name']; ?></td>
                <td width="5%"><?php echo $row['cc']; ?></td>
                <td width="5%"><?php echo $row['cd']; ?></td>
                <td width="5%"><?php echo $row['pdv']; ?></td>
                <td><a href="combat.php?id=<?php echo $row['id']; ?>">Combattre</a></td>
            </tr>
            <?php
        }
    ?>
    </tbody>
</table>
</div>
<?php
require_once('./templates/footer.php');
?>