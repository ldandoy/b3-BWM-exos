<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();
    $sql = "SELECT * FROM user";
    $users = $bdd->fetchAll($sql);
    // var_dump($products);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Liste des users</h1>

        <a class="text-green" href="users_new.php">Ajouter un user</a>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td width='70%'>Nom</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user) { ?>
                <tr>
                    <td>
                        <?php echo $user['id']; ?>
                    </td>
                    <td>
                        <?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?>
                    </td>
                    <td>
                        <a class="text-green" href="users_show.php?id=<?php echo $user['id']; ?>">Voir</a>
                        <a class="text-green" href="users_edit.php?id=<?php echo $user['id']; ?>">Editer</a>
                        <a class="text-green" onclick="return confirm('Are you sure?')" href="users_delete.php?id=<?php echo $user['id']; ?>">Supp</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 