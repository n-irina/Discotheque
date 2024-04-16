<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*requête */
$statement = $pdo->query("select * from album");

/*récupère */
$albums = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Here are our known albums</h1>

<div class="container bg-light border border-light-subtle">
    <div class="row my-custom-row">
        <?php
        foreach ($albums as $album) { ?>
            <div class="col-10 border border-light-subtle align-self-center p-3"><a href='detail-album.php?id=<?= $album['Id'] ?>'><?= $album['Title'] ?></a></div>
            <div class="col-1 border border-light-subtle align-self-center p-2"><a class="btn btn-primary" href='modify-album.php?id=<?= $album['Id'] ?>'>Modify</a></div>
            <div class="col-1 border border-light-subtle align-self-center p-2"><a class="btn btn-danger" href='delete-album.php?id=<?= $album['Id'] ?>'>Delete</a></div>
        <?php
        }
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>