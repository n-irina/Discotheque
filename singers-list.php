<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*requête */
$statement = $pdo->query("select * from singer");

/*récupère */
$singers = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Here are our known singers</h1>

<div class="container bg-light border border-light-subtle">
    <div class="row my-custom-row">
        <div class="col-8 border border-light-subtle align-self-center p-3"><strong>Is there a singer you like that is missing? Help us completing our list!</strong></div>
        <div class="col-4 border border-light-subtle align-self-center p-2"><a class="btn btn-success" href='add-singer.php'>Add a singer</a></div>
    </div>
    <div class="row my-custom-row">
        <?php
        foreach ($singers as $singer) { ?>
            <div class="col-8 border border-light-subtle align-self-center p-3"><?= $singer['Nickname'] ?></div>
            <div class="col-2 border border-light-subtle align-self-center p-2"><a class="btn btn-secondary" href='detail-singer.php?id=<?= $singer['Id'] ?>'>Learn more</a></div>
            <div class="col-1 border border-light-subtle align-self-center p-2"><a class="btn btn-primary" href='modify-singer.php?id=<?= $singer['Id'] ?>'>Modify</a></div>
            <div class="col-1 border border-light-subtle align-self-center p-2"><a class="btn btn-danger" href='delete-singer.php?id=<?= $singer['Id'] ?>'>Delete</a></div>
        <?php
        }
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>