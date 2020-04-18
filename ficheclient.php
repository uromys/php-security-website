<?php
session_start();
if($_SESSION['profil_user']!="employe"){
header("Location: accueil.php");

include_once 'include.php';

}
//$_SESSION['allClient']= GetAllUser()->fetchAll();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Client</title>
  <link rel="stylesheet" type="text/css" media="all"  href="css/bootstrap.min.css" />
</head>
<script>
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}

</script>
<body>
    <header>
        <h2> All clients </h2>
    </header>
    <section>
        <article>

          <div class="liste">
            <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                  <th>Link</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Numero Compte</th>
                  <th>balance</th>
                </tr>
              </thead>
              <tbody>
              <?php

              foreach ($_SESSION['allClient'] as $cle => $client) {
                $thisClient=$client['id_user'];
                $jscode = 'openInNewTab('. json_encode("virement.php?id=$thisClient") . ');';

                echo '<tr>';
                echo '<td onclick="' . htmlspecialchars($jscode) . '">' .'Use this accompt  to transmit money'.' </td>';
                echo '<td>'.$client['nom'].'</td>';
                echo '<td>'.$client['prenom'].'</td>';
                echo '<td>'.$client['numero_compte'].'</td>';
                echo '<td>'.$client['solde_compte'].'</td>';
                echo '</tr>';
              }
               ?>
               </tbody>
            </table>
          </div>

        </article>
    </section>
</body>
</html>
