<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*récupère les données du GET */
$id = $_GET['id'];

/*requête*/
$request = 'SELECT * FROM song WHERE Id = :id';
$statement = $pdo->prepare($request);
$statement->bindParam(':id', $id, PDO::PARAM_INT);


/*exécute */
$statement->execute();

$song = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class="container bg-light border border-light-subtle">
    <div class="row">
        <div class="col-4 border border-light-subtle align-self-center p-3"><strong>Title</strong></div>
        <div class="col-4 border border-light-subtle align-self-center p-3"><strong>Year of release</strong></div>
        <div class="col-4 border border-light-subtle align-self-center p-3"><strong>Duration</strong></div>
    </div>
    <div class="row my-custom-row">
        <div class="col-4 border border-light-subtle align-self-center p-3"><?= $song['Title'] ?></div>
        <div class="col-4 border border-light-subtle align-self-center p-3"><?= $song['Date'] ?></div>
        <div class="col-4 border border-light-subtle align-self-center p-3"><?= $song['Duration'] ?>:00</div>
    </div>
</div>
<?php
include 'footer.php';
?>