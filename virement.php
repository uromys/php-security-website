<?php
session_start();
$Get=htmlspecialchars($_GET["id"]);
if($Get!="" && $_SESSION['profil_user']!="employe"){
header("Location: accueil.php");
}
include_once 'acessdb.php';


$requestGet=false;


if ($Get!=""){
  //echo $Get;
$requestGet=true;

$Sender = GetUserById($Get);
$AccomptSending=$Sender["numero_compte"];
$MoneyOfThisAccompt=$Sender["solde_compte"];


}

$token=htmlspecialchars($_SESSION['token']);
if (isset($_SESSION['token']) AND isset($token) AND !empty($_SESSION['token']) AND !empty($token)) {
    if ($_SESSION['token'] == $token) {
        if (isset($_POST['form'])){
            if($requestGet==false){
             $AccomptSending=$_SESSION['numero_compte'];
           }
          $destination=htmlspecialchars($_POST['accompt'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
          $montant=htmlspecialchars($_POST['montant'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
          if($montant>$_SESSION['solde_compte']||$montant<=0){//also verified in acessdb
            $msg="You doesn't have the right to transfert this amount of money ";
        }else {
          $msg = transfert($destination,$AccomptSending ,$montant);
        }
      }
    }else{
      echo "this was an CSRF attempt ,we are calling the cop";
    }
}

include_once 'include.php';


if ($Get!=""){// we repet this if because otherwise the value is not actualize, and if we swap the 2 if we need to modify include ,and thr structure of all the program
echo  "<h2> You are using this  Accompt Number   to do the  transfert  ".$AccomptSending ."</h2>";
echo  "<h2> This accompt has  ".$MoneyOfThisAccompt ."</h2>";
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
            <input type="hidden" name="token"  value="<?php echo $_SESSION['token'] ; ?>" />

          </div>
          <button type="submit" name="form" class="btn btn-primary" >Transfert</button>

        </div>
      </form>
      <div>
        <span class="text-info"><?php if (isset($msg)) { echo $msg; } ?></span>
      </div>
</html>
