<?php
include_once 'include.php';
$_SESSION['messagesRecus']= GetmyMessage($_SESSION['id_user'])->fetchAll();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Messages</title>
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
        <h2>  Messages received</h2>
    </header>

    <section>
        <article>

          <div class="liste">
            <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                  <th>From</th>
                  <th>Subjet</th>
                  <th>Message</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
              <?php

              foreach ($_SESSION['messagesRecus'] as $cle => $message) {

                $Sender = GetUserById($message['id_user_from']);
                $jscode = 'openInNewTab('. json_encode("infoclient.php") . ');';

                echo '<tr>';
                echo '<td onclick="' . htmlspecialchars($jscode) . '">' . $Sender['nom'] .' '. $Sender['prenom'] .' </td>';
                echo '<td>'.$message['sujet_msg'].'</td>';
                echo '<td>'.$message['corps_msg'].'</td>';
                echo '<td>'.$Sender['profil_user'].'</td>';
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
