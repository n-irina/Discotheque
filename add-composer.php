<?php

include 'header.php';
?>
<br><br><br>
<form class="row g-5 justify-content-center align-items-end" method="post" action="add-composer.php">
  <div class="col-auto">
    <label for="Name" class="visually">Name<span class="text-danger">*</span></label>
    <input type="text" name="Name" class="form-control" id="Name" placeholder="Nairy" required>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" value="valider">Add the composer info</button>
  </div>
</form>


<span class="text-danger text-align-right">*Ce(s) champ(s) sont obligatoire(s)</span>
<?php
/*condition de formulaire rempli */
if ($_POST != []) {
  
  
  /*connexion à la bdd */
  $pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

  /*récupère les données du form */
  $Name = $_POST['Name'];

  /*requête*/
  $request = "INSERT INTO discotheque.composer (Name) VALUES (:name)";
  $statement = $pdo->prepare($request);
  $statement->bindParam(':name', $Name, \PDO::PARAM_STR);

  /*exécute */
  $statement->execute();

  /*redirection*/
  header("location:composers-list.php");
  }
  include 'footer.php';

?>