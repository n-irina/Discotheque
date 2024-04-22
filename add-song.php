<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

$request1 = 'SELECT Nickname, Id FROM singer';
$statement1 = $pdo->query($request1);
$singers =  $statement1->fetchAll(PDO::FETCH_ASSOC);
$request3 = 'SELECT Name, Id FROM composer';
$statement3 = $pdo->query($request3);
$composers =  $statement3->fetchAll(PDO::FETCH_ASSOC);
?>
<br><br><br>
<form class="row g-5 justify-content-center align-items-end" method="post" action="add-song.php">
    <div class="col-auto form-group">
        <label for="Title" class="visually">Title<span class="text-danger">*</span></label>
        <input type="text" name="Title" class="form-control" id="Title" placeholder="With you" required>
    </div>
    <div class="col-auto form-group">
        <label for="Date" class="visually">Date</label>
        <input type="year" name="Date" class="form-control" id="Date" placeholder="2007">
    </div>
    <div class="col-auto form-group">
        <label for="Duration" class="visually">Duration</label>
        <input type="number" name="Duration" class="form-control" id="Duration" placeholder="4:00">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary" value="valider">Add the song info</button>
    </div>
    <select class="form-select" name ="singerId" aria-label="Default select example">
        <option selected>Select the singer of your song</option>
        <?php
        foreach($singers as $singer){
            echo '<option value= '.$singer['Id'].'>'.$singer['Nickname'].'</option>';
        }
            echo '<option value= '.(count($singers)+1).'>You don\'t find your singer? Click here to add (s)he</option>';
        ?>
    </select>
    <select class="form-select" name ="composerId" aria-label="Default select example">
        <option selected>Select the composer of your song if different of the singer</option>
        <?php
        foreach($composers as $composer){
            echo '<option value= '.$composer['Id'].'>'.$composer['Name'].'</option>';
        }
            echo '<option value= '.(count($composers)+1).'>You don\'t find your Composer? Click here to add (s)he</option>';
        ?>
    </select>
   
</form>


<span class="text-danger text-align-right">*Ce(s) champ(s) sont obligatoire(s)</span>

<?php
/*condition de formulaire rempli */
if ($_POST != []) {


/*récupère les données du form */
$Title = $_POST['Title'];
$Date = $_POST['Date'];
$Duration = $_POST['Duration'];
$singerId = $_POST['singerId'];
$composerId = $_POST['composerId'];

if(($singerId==count($singers)+1)||($composerId==count($composers)+1)){
    /*requête*/
$request = 'INSERT INTO discotheque.song (Title, Date, Duration) VALUES (:title, :date, :duration)';
$statement = $pdo->prepare($request);
$statement->bindParam(':title', $Title, \PDO::PARAM_STR);
$statement->bindParam(':date', $Date, \PDO::PARAM_STR);
$statement->bindParam(':duration', $Duration, \PDO::PARAM_INT);

/*exécute */
$statement->execute();
 //redirection
    header("location:add-singer.php");
}


else{
/*requête*/
$request = 'INSERT INTO discotheque.song (Title, Date, Duration) VALUES (:title, :date, :duration)';
$statement = $pdo->prepare($request);
$statement->bindParam(':title', $Title, \PDO::PARAM_STR);
$statement->bindParam(':date', $Date, \PDO::PARAM_STR);
$statement->bindParam(':duration', $Duration, \PDO::PARAM_INT);

/*exécute */
$statement->execute();

$songid = $pdo->lastInsertId();
$request2 = 'INSERT INTO singer_has_song (Singer_Id, Song_Id) VALUES (:singerId, :songId)';
$statement2 = $pdo->prepare($request2);
$statement2->bindParam(':singerId', $singerId, \PDO::PARAM_INT);
$statement2->bindParam(':songId', $songid, \PDO::PARAM_INT);

$statement2->execute();

$request4 = 'INSERT INTO composer_has_song (Composer_Id, Song_Id) VALUES (:composerId, :songId)';
$statement4 = $pdo->prepare($request4);
$statement4->bindParam(':composerId', $composerId, \PDO::PARAM_INT);
$statement4->bindParam(':songId', $songid, \PDO::PARAM_INT);

$statement4->execute();

/*redirection*/
header("location:songs-list.php");
}

}

include 'footer.php';

?>