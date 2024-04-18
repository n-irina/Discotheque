<?php 

include "header.php";

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*récupère les données du GET */
$id = $_GET['id'];

/*requêtes */
$request = 'SELECT song.Title, song.Date, song.Duration FROM song JOIN album_has_song ON song.Id = album_has_song.Song_Id JOIN album ON album_has_song.Album_id = album.Id WHERE album.Id = :id';
$statement = $pdo->prepare($request);
$statement->bindParam(':id', $id, PDO::PARAM_INT);

$request2 = 'SELECT singer.Nickname FROM singer JOIN singer_has_album ON singer_has_album.Singer_Id = singer.Id JOIN album ON singer_has_album.Album_id = album.Id WHERE album.Id = :id';
$statement2 = $pdo->prepare($request2);
$statement2->bindParam(':id', $id, PDO::PARAM_INT);

$request3 = 'SELECT album.Title FROM album WHERE album.Id = :id';
$statement3 = $pdo->prepare($request3);
$statement3->bindParam(':id', $id, PDO::PARAM_INT);

/*exécute */
$statement->execute();
$statement2->execute();
$statement3->execute();
$songs = $statement->fetchAll(PDO::FETCH_ASSOC);
$singer = $statement2->fetch(PDO::FETCH_ASSOC);
$title = $statement3->fetch(PDO::FETCH_ASSOC);

/*affiche */

echo '<br><br><p><em>'.$singer['Nickname'].'</em> is the singer of the Album "<strong>'.$title['Title'].'</strong>" and here are the songs of this album:<p>';

echo '<div class="container bg-light border border-light-subtle">';
echo '<div class="row my-custom-row">';
echo '<div class="col-4 border border-light-subtle align-self-center p-3"><p><strong>Title</strong></p></div>';
echo '<div class="col-4 border border-light-subtle align-self-center p-3"><p><strong>Year of release</strong></p></div>';
echo '<div class="col-4 border border-light-subtle align-self-center p-3"><p><strong>Duration</strong></p></div>';
echo '</div>';
foreach ($songs as $song) {
    
    echo '<div class="row my-custom-row">';
    foreach ($song as $key => $value) {
        if ($key == 'Name') {
            break;
        }

        if ($key!='Id'){
        echo '<div class="col-4 border border-light-subtle align-self-center p-3"><p>' . $value . '</p></div>';
        }
    }
    echo '</div>';
    
}
echo '</div>';

?>