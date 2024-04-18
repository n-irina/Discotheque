<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*récupère les données du GET */
$id = $_GET['id'];

/*requêtes*/
$request = 'SELECT * FROM song WHERE Id = :id';
$statement = $pdo->prepare($request);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$song = $statement->fetch(PDO::FETCH_ASSOC);


$request2 = 'SELECT singer.Id, singer.Nickname, composer.Id, composer.Name FROM singer JOIN singer_has_song ON singer.Id = singer_has_song.Singer_Id JOIN song ON song.Id = singer_has_song.Song_Id JOIN composer_has_song ON composer_has_song.Song_Id = song.Id JOIN composer ON composer_has_song.Composer_Id = composer.Id WHERE song.Id = :id';
$statement2 = $pdo->prepare($request2);
$statement2->bindParam(':id', $id, PDO::PARAM_INT);
$statement2->execute();
$singerandcomposer = $statement2->fetch(PDO::FETCH_ASSOC);

/*exécute */

?>
<div class="container bg-light border border-light-subtle">
    <div class="row">
        <div class="col-3 border border-light-subtle align-self-center p-3"><strong>Title</strong></div>
        <div class="col-3 border border-light-subtle align-self-center p-3"><strong>Singer</strong></div>
        <div class="col-2 border border-light-subtle align-self-center p-3"><strong>Composer</strong></div>
        <div class="col-2 border border-light-subtle align-self-center p-3"><strong>Year of release</strong></div>
        <div class="col-2 border border-light-subtle align-self-center p-3"><strong>Duration</strong></div>
        
    </div>
    <div class="row my-custom-row">
        <div class="col-3 border border-light-subtle align-self-center p-3"><?= $song['Title'] ?></div>
        <div class="col-3 border border-light-subtle align-self-center p-3"><?= $singerandcomposer['Nickname'] ?></div>
        <div class="col-2 border border-light-subtle align-self-center p-3"><?= $singerandcomposer['Name'] ?></div>
        <div class="col-2 border border-light-subtle align-self-center p-3"><?= $song['Date'] ?></div>
        <div class="col-2 border border-light-subtle align-self-center p-3"><?= $song['Duration'] ?>:00</div>
    </div>
</div>
<?php
include 'footer.php';
?>