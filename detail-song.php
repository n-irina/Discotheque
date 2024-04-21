
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

$request2 = 'SELECT singer.Nickname FROM singer 
            JOIN singer_has_song ON singer.Id = singer_has_song.Singer_Id 
            JOIN song ON song.Id = singer_has_song.Song_Id WHERE song.Id = :id';
$statement2 = $pdo->prepare($request2);
$statement2->bindParam(':id', $id, PDO::PARAM_INT);
$statement2->execute();
$singers = $statement2->fetchAll(PDO::FETCH_COLUMN);

$request3 = 'SELECT composer.Name FROM composer
            JOIN composer_has_song ON composer_has_song.Composer_Id = composer.Id
            JOIN song ON composer_has_song.Song_Id = song.Id  WHERE song.Id = :id';
$statement3 = $pdo->prepare($request3);
$statement3->bindParam(':id', $id, PDO::PARAM_INT);
$statement3->execute();
$composers = $statement3->fetchAll(PDO::FETCH_COLUMN);

/*affiche */

echo '<div class="container bg-light border border-light-subtle">';
echo '<div class="row my-custom-row">';
echo '<div class="col-4 border border-light-subtle align-self-center p-2"><p><strong>Title</strong></p></div>';
echo '<div class="col-4 border border-light-subtle align-self-center p-2"><p><strong>Year of release</strong></p></div>';
echo '<div class="col-4 border border-light-subtle align-self-center p-2"><p><strong>Duration</strong></p></div>';
echo '</div>';
echo '<div class="row my-custom-row">';
foreach ($song as $key => $value) {
    if ($key != 'Id') {
        echo '<div class="col-4 border border-light-subtle align-self-center p-3"><p>' . $value . '</p></div>';
    }
}
echo '</div>';
echo '</div>';

echo '<br>The singer(s) of this song is/are: ';
$singerCount = count($singers);
if ($singerCount == 1) {
    echo '<strong>' . $singers[0] . '</strong>.';
} else {
    echo '<strong>' . implode('</strong>, <strong>', array_slice($singers, 0, -1)) . '</strong> and <strong>' . end($singers) . '</strong>.';
}

echo '<br> And the writer(s) is/are: ';
$composerCount = count($composers);
if ($composerCount == 1) {
    echo '<strong>' . $composers[0] . '</strong>.';
} else {
    echo '<strong>' . implode('</strong>, <strong>', array_slice($composers, 0, -1)) . '</strong> and <strong>' . end($composers) . '</strong>.';
}

include 'footer.php';
?>
