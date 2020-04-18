<?php

include_once 'include.php';

?>
<!DOCTYPE html>
<html>
<head>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
  <div class="bg">

  <p class="py-5 text-center"></p>

    <section>

        <article>
          <div class="fieldset">
              <div class="container-fluid">
                  <span>Vos informations personnelles</span>
              </div>
              <div class="field">
                  <label>Login : </label><span><?php echo $_SESSION["login"];?></span>
              </div>
              <div class="field">
                  <label>Profil : </label><span><?php echo $_SESSION["profil_user"];?></span>
              </div>
              <div class="field">
                  <label>Numero Compte : </label><span><?php echo $_SESSION["numero_compte"];?></span>

              </div>

                <div class="field">
                  <label> Your money   </label>  <span><?php echo   $_SESSION['solde_compte'];?><label> $  </label></span>
                </div>
          </div>
        </article>

        <div class="container-fluid" id="info">
            <ul class="nav navbar-nav navbar-center">
                <li><p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                <button class="btn btn-primary" onclick="window.location.href = 'logout.php';">logout</button>
                <button class="btn btn-primary" onclick="window.location.href = 'virement.php';">virement</button>
                <button class="btn btn-primary" onclick="window.location.href = 'message.php';">Message</button>
                  <?php
                  if ($_SESSION["profil_user"]=="employe"){
                      echo "<button class='btn btn-primary'";
                      echo 'onclick="window.location.href =\'ficheclient.php\';"';
                      echo ">infoclient</button>";


                  }


                 ?>
            </ul>
        </div>



    </section>
</div>
</body>
</html>
