<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

/*récupère les données du form */

/*requête*/
$request = 'INSERT INTO singer (Nickname, Firstname, Name, Date_of_Brith) VALUES (:nickname, :firstname, :name, :date)';
$statement = $pdo->prepare($request);
$statement->bindParam(':nickname', $Nickname, PDO::PARAM_STR);
$statement->bindParam(':firstname', $Firstname, PDO::PARAM_STR);
$statement->bindParam(':name', $Name, PDO::PARAM_STR);
$statement->bindParam(':date', $Date, PDO::PARAM_STR);

/*exécute */

/*redirection*/

include 'footer.php';
?>