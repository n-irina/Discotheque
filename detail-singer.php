<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*récupère les données du GET */
$id = $_GET['id'];

/*requête*/
$request = 'SELECT * FROM singer WHERE id = :id';
$statement = $pdo->prepare($request);
$statement->bindParam(':id', $id, PDO::PARAM_INT);


/*exécute */
$statement->execute();

$singer = $statement->fetch(PDO::FETCH_ASSOC);


echo '<br><br><p class="text-center">The singer you\'re looking for is called <strong>'.$singer['Lastname'].' '.$singer['Firstname'].'</strong> better known as <i>'.$singer['Nickname'].'</i> born on '.$singer['Date_of_birth'].'.</p>';

if($singer['Composer_Id']){
    echo '<br><p class="text-center">This singer is also a composer';
}
include 'footer.php';
?>