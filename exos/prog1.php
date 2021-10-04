<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            include 'maison.php';

            $maison = new Maison();
            echo $maison->getNbPersonnes() . '<br />';

            $maison2 = new Maison();
            $maison2->addpersonnes(4);

            $maison->addpersonnes(-8);

            echo $maison->getNbPersonnes() . '<br />';
            echo $maison2->getNbPersonnes();
        ?>
    </body>
</html>