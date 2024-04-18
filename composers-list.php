<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*requête */
$statement = $pdo->query("select * from composer");

/*récupère */
$composers = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Here are our known composers</h1>

<div class="container bg-light border border-light-subtle">
    <div class="row my-custom-row">
        <div class="col-8 border border-light-subtle align-self-center p-3"><strong>Is there a composer you know that is missing? Help us completing our list!</strong></div>
        <div class="col-4 border border-light-subtle align-self-center p-2"><a class="btn btn-success" href='add-composer.php'>Add a composer</a></div>
    </div>
    <div class="row my-custom-row">
        <?php
        foreach ($composers as $composer) { ?>
            <div class="col-8 border border-light-subtle align-self-center p-3"><?= $composer['Name'] ?></div>
            <div class="col-2 border border-light-subtle align-self-center p-2"><a class="btn btn-secondary" href='detail-composer.php?id=<?= $composer['Id'] ?>'>Learn more</a></div>
            <div class="col-1 border border-light-subtle align-self-center p-2"><a class="btn btn-primary" href='modify-composer.php?id=<?= $composer['Id'] ?>'>Modify</a></div>
            <div class="col-1 border border-light-subtle align-self-center p-2"><a class="btn btn-danger" href='delete-composer.php?id=<?= $composer['Id'] ?>'>Delete</a></div>
        <?php
        }
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>