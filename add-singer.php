<?php

include 'header.php';
?>
<br><br><br>
<form class="row g-5 justify-content-center align-items-end" method="post" action="add-singer.php">
  <div class="col-auto">
    <label for="Nickname" class="visually">Nickname<span class="text-danger">*</span></label>
    <input type="text" name="Nickname" class="form-control" id="Nickname" placeholder="Nairy" required>
  </div>
  <div class="col-auto">
    <label for="Name" class="visually">Name</label>
    <input type="text" name="Name" class="form-control" id="Name" placeholder="Nahoaniko">
  </div>
  <div class="col-auto">
    <label for="Firstname" class="visually">Firstname</label>
    <input type="text" name="Firstname" class="form-control" id="Firstname" placeholder="Irina">
  </div>
  <div class="col-auto">
    <label for="Nickname" class="visually">Date of birth</label>
    <input type="date" name="Date" class="form-control" id="Date" placeholder="1991-10-08">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" value="valider">Add the singer info</button>
  </div>
</form>

<?php
/*condition de formulaire rempli */
if ($_POST != []) {
  ?><span class="text-danger text-align-right">*Ce(s) champ(s) sont obligatoires</span><?php
  /*connexion à la bdd */
  $pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');

  /*récupère les données du form */
  $Nickname = $_POST['Nickname'];
  $Name = $_POST['Name'];
  $Firstname = $_POST['Firstname'];
  $Date = $_POST['Date'];

  /*requête*/
  $request = "INSERT INTO discotheque.singer (Nickname, Firstname, Lastname, Date_of_birth) VALUES (:nickname, :firstname, :lastname, :date)";
  $statement = $pdo->prepare($request);
  $statement->bindParam(':nickname', $Nickname, \PDO::PARAM_STR);
  $statement->bindParam(':firstname', $Firstname, \PDO::PARAM_STR);
  $statement->bindParam(':lastname', $Name, \PDO::PARAM_STR);
  $statement->bindParam(':date', $Date, \PDO::PARAM_STR);

  /*exécute */
  $statement->execute();

  /*redirection*/
  header("location:singers-list.php");
  }
  include 'footer.php';

?>