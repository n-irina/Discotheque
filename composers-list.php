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
        <?php
        foreach ($composers as $composer) { ?>
            <div class="col-10 border border-light-subtle align-self-center p-3"><a href='detail-composer.php?id=<?= $composer['Id'] ?>'><?= $composer['Name'] ?></a></div>
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