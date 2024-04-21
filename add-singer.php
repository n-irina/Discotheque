<?php

include 'header.php';

 /*connexion à la bdd */
 $pdo = new \PDO('mysql:local=localhost;dbname=discotheque', 'root', '');
 
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
  <select class="form-select" name ="fromselect" aria-label="Default select example">
        <option selected>Are your singer a composer?</option>
        <option value= '1'>YES</option>
        <option value= '2'>NO</option>
        <option value= '3'>I don't know</option>
    </select>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" value="valider">Add the singer info</button>
  </div>
</form>


 <span class="text-danger text-align-right">*Ce(s) champ(s) sont obligatoire(s)</span>

<?php

if ($_POST) {
  /* On réupère les data du formulaire */
  $Nickname = $_POST['Nickname'];
  $Name = $_POST['Name'];
  $Firstname = $_POST['Firstname'];
  $Date = $_POST['Date'];
  $ComposerOrNot = $_POST['fromselect'];

  /* Si le singer est composer */
  if ($ComposerOrNot == 1) {
      /* On crée le nouveau composer à partir du nom récupéré par le post */
      $request3 = 'INSERT INTO composer (Name) VALUES (:name)';
      $statement3 = $pdo->prepare($request3);
      $statement3->bindParam(':name', $Nickname, \PDO::PARAM_STR);
      $statement3->execute();

      
      $composerid = $pdo->lastInsertId(); 

      /*On crée le nouveau singer avec l'id dans la clé étrangère*/
      $request = "INSERT INTO discotheque.singer (Nickname, Firstname, Lastname, Date_of_birth, Composer_Id) VALUES (:nickname, :firstname, :lastname, :date, :composerid)";
      $statement = $pdo->prepare($request);
      $statement->bindParam(':nickname', $Nickname, \PDO::PARAM_STR);
      $statement->bindParam(':firstname', $Firstname, \PDO::PARAM_STR);
      $statement->bindParam(':lastname', $Name, \PDO::PARAM_STR);
      $statement->bindParam(':date', $Date, \PDO::PARAM_STR);
      $statement->bindParam(':composerid', $composerid, \PDO::PARAM_INT);
      $statement->execute();
  } else {
      /*Si le singer n'est pas un composer*/
      $request = "INSERT INTO discotheque.singer (Nickname, Firstname, Lastname, Date_of_birth) VALUES (:nickname, :firstname, :lastname, :date)";
      $statement = $pdo->prepare($request);
      $statement->bindParam(':nickname', $Nickname, \PDO::PARAM_STR);
      $statement->bindParam(':firstname', $Firstname, \PDO::PARAM_STR);
      $statement->bindParam(':lastname', $Name, \PDO::PARAM_STR);
      $statement->bindParam(':date', $Date, \PDO::PARAM_STR);
      $statement->execute();
  }

  /*Redirection */
  header("location:singers-list.php");
  exit();
}

?>