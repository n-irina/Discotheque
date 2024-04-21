<?php

include 'header.php';
?>
<br><br><br>
<form class="row g-5 justify-content-center align-items-end" method="post" action="add-album.php">
  <div class="col-auto">
    <label for="Title" class="visually">Title<span class="text-danger">*</span></label>
    <input type="text" name="Title" class="form-control" id="Title" placeholder="In my on words" required>
  </div>
  <div class="col-auto">
    <label for="Title" class="visually">Year of release</label>
    <input type="year" name="Date" class="form-control" id="Date" placeholder="1991" required>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" value="valider">Add the album info</button>
  </div>
</form>



<span class="text-danger text-align-right">*Ce(s) champ(s) sont obligatoire(s)</span>

<?php
/*condition de formulaire rempli */
if ($_POST != []) {
  
  
  /*connexion à la bdd */
  $pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

  /*récupère les données du form */
  $title = $_POST['Title'];
  $date = $_POST['Date_of_release'];

  /*requête*/
  $request = "INSERT INTO discotheque.album (Title, Date_of_release) VALUES (:title, :date)";
  $statement = $pdo->prepare($request);
  $statement->bindParam(':title', $title, \PDO::PARAM_STR);
  $statement->bindParam(':date', $date, \PDO::PARAM_INT);
  /*exécute */
  $statement->execute();

  /*redirection*/
  header("location:albums-list.php");
  }
  include 'footer.php';

?>