<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*récupère les données du GET */
$id = $_GET['id'];

/*requête*/
$request = 'SELECT song.Id, song.Title, song.Date, song.Duration, composer.Name FROM discotheque.song JOIN composer_has_song ON song.ID = composer_has_song.Song_Id JOIN composer ON composer_has_song.Composer_Id = composer.Id WHERE composer.Id = :id ORDER BY Date desc';
$statement = $pdo->prepare($request);
$statement->bindParam(':id', $id, PDO::PARAM_INT);

/*exécute */
$statement->execute();
$songs = $statement->fetchAll(PDO::FETCH_ASSOC);

/*affiche */

echo '<br><br><strong>'.$songs[0]['Name'].'</strong> is also a composer and here are all the songs he wrote:';
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

<?php
include 'footer.php';
?>