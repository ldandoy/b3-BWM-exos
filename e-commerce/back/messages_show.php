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
    $sql = "SELECT message.*, user.firstname as firstname, user.lastname as lastname FROM message LEFT JOIN user ON (message.user_id = user.id) WHERE message.id = :id";
    $message = $bdd->fetch($sql, array(
        ':id' => $id
    ));
    // var_dump($product);
?>

<div class="container">
    <nav>
        <?php require_once('templates/_navbar.php') ?>
    </nav>
    <main>
        <h1 id="title">Fiche message</h1>

        <div>
            <a class="text-green" onclick="return confirm('Are you sure?')" href="messages_delete.php?id=<?php echo $message['id']; ?>">Supp</a>
        </div>

        <p>Sujet: <?php echo $message['subject'] ;?></p>
        <p>Contenu: <?php echo $message['content'] ;?></p>
        <p>Client: <a href=""><?php echo $message['firstname'] ;?> <?php echo $message['lastname'] ;?></a></p>
        <p>Email: <?php echo $message['email'] ;?></p>
        <p>Date de création: <?php echo $message['created_at'] ;?></p>
        <br />
        <p><a class="text-green" href="messages.php">Retour</a></p>
    </main>
</div>

<?php require_once('templates/_footer.php'); ?> 