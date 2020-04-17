<?php

$Get=htmlspecialchars($_GET["id"]);
if(isset($Get) && $_SESSION['profil_user']!="employe"){
header("Location: accueil.php");
}

include_once 'include.php';

$requestGet=false;


if (isset($Get)){
  //echo $Get;
$requestGet=true;

$Sender = GetUserById($Get);
$AccomptSending=$Sender["numero_compte"];
echo  "<h2> You are using this  Accompt Number   to do the  transfert  ".$AccomptSending ."</h2>";

}


if (isset($_POST['form'])){
    if($requestGet==false){
     $AccomptSending=$_SESSION['numero_compte'];
     //echo $AccomptSending;
   }
   //echo $AccomptSending;
  $destination=htmlspecialchars($_POST['accompt'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
  $montant=htmlspecialchars($_POST['montant'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);

  if($montant>$_SESSION['solde_compte']){
    $msg="You doesn't have the right to transfert this amount of money ";

}else {


  $msg = transfert($destination,$AccomptSending ,$montant);


}

}
?>


<!doctype html>
<html lang="fr">

<head>
  <title>Transfert</title>
</head>

<body>
  <header>
    <h1>Gestion des transferts</h1>
  </header>

  <section>
    <article>
      <form role="form" action="" method="post" name="transfertform">
        <div class="fieldset">
          <div class="fieldset_label">

          </div>
          <div class="field">
            <label>N° compte destinataire : </label>
            <?php
            $row=GetAllUser()->fetchAll();

            echo '<select name="accompt"  class="form-control">';
              foreach ($row as $id => $user) {

                echo '<option value="'.$user['numero_compte'].'">' . $user['numero_compte'] . ' ' . $user['nom'].'</option>';

              }
              echo '</select>'
            ?>

          </div>
          <div class="field">
            <label>Amount : </label><input type="number" size="5" name="montant"  required class="form-control">
          </div>
          <button type="submit" name="form" class="btn btn-primary" >Transfert</button>
          <?php

          ?>
        </div>
      </form>
      <div>
        <span class="text-info"><?php if (isset($msg)) { echo $msg; } ?></span>
      </div>
</html>
