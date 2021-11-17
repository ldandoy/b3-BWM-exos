<?php require_once('templates/_header.php'); ?>

<?php
    require_once('./classes/Session.php');
    $session = new Session();
    if (!$session->get('user')) {
        header('Location: login.php');
    }

    require_once('./classes/Bdd.php');
    $bdd = new Bdd();
    $sql = "SELECT message.*, user.firstname as firstname, user.lastname as lastname FROM message LEFT JOIN user ON (message.user_id = user.id)";
    $messages = $bdd->fetchAll($sql);
    // var_dump($messages);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Liste des messages</h1>

        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Sujet</td>
                    <td>Email</td>
                    <td>Client</td>
                    <td>Date</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($messages as $message) { ?>
                <tr>
                    <td>
                        <?php echo $message['id']; ?>
                    </td>
                    <td>
                        <?php echo $message['subject']; ?>
                    </td>
                    <td>
                        <?php echo $message['email']; ?>
                    </td>
                    <td>
                        <?php echo $message['firstname']; ?> <?php echo $message['lastname']; ?>
                    </td>
                    <td>
                        <?php echo $message['created_at']; ?>
                    </td>
                    <td>
                        <a class="text-green" href="messages_show.php?id=<?php echo $message['id']; ?>">Voir</a>
                        <!--a href="users_edit.php?id=<?php echo $message['id']; ?>">Editer</a-->
                        <a class="text-green" onclick="return confirm('Are you sure?')" href="messages_delete.php?id=<?php echo $message['id']; ?>">Supp</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 