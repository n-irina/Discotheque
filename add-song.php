<?php

include 'header.php';

/*connexion à la bdd */
$pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

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
</form>


<span class="text-danger text-align-right">*Ce(s) champ(s) sont obligatoire(s)</span>

<?php
/*condition de formulaire rempli */
if ($_POST != []) {


/*récupère les données du form */
$Title = $_POST['Title'];
$Date = $_POST['Date'];
$Duration = $_POST['Duration'];


/*requête*/
$request = 'INSERT INTO discotheque.song (Title, Date, Duration) VALUES (:title, :date, :duration)';
$statement = $pdo->prepare($request);
$statement->bindParam(':title', $Title, \PDO::PARAM_STR);
$statement->bindParam(':date', $Date, \PDO::PARAM_STR);
$statement->bindParam(':duration', $Duration, \PDO::PARAM_INT);


/*exécute */
$statement->execute();

/*redirection*/
 header("location:songs-list.php");
}

include 'footer.php';

?>