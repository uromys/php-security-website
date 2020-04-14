<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php");
}

include_once 'acessdb.php';
include_once 'sendmail.php';
//envoyer le mail
if( empty($_SESSION['$ArrayOfStringGenerated'])){ //  true only when we enter the page
  //echo " genre";
  $mail=searchemail($_SESSION['id_user']);
  $_SESSION['mail']=$mail;
  $_SESSION['$ArrayOfStringGenerated'] = array();
  $StringGeneratedByEmail = sendingmail($mail);
  array_push($_SESSION['$ArrayOfStringGenerated'],$StringGeneratedByEmail);
  // we store in an array if the user fail the first time and select an older  mail .
}
if(isset($_POST['sendmail'])){// button sendingmail pressed , we don't initialize
$StringGeneratedByEmail = sendingmail($_SESSION['mail']);
array_push($_SESSION['$ArrayOfStringGenerated'],$StringGeneratedByEmail);

}

if (isset($_POST['form'])){
  //echo $_POST['confirmation'];
  foreach ($_SESSION['$ArrayOfStringGenerated'] as $StringGeneratedByEmail ){
    //  echo $StringGeneratedByEmail; // if you are too tired to check your mail or write it

    if ( $StringGeneratedByEmail==$_POST['confirmation'] ){
          header("Location:lobby.php");

    }else {
      $errormsg = "Incorrect  confirmation ,check your spam ";
    }
  }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">


            </button>
            <a class="navbar-brand" href="login.php"> Home</a>
        </div>
        <!-- menu items -->
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="login.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>Enter the password send at <?php echo $mail;?></legend>

                    <div class="form-group">
                        <label for="name">confirmation</label>
                        <input type="text" name="confirmation" placeholder=" the 8 characters send by mail"  class="form-control" />
                    </div>



                    <div class="form-group">
                        <input type="submit" name="form" value="send" class="btn btn-primary" />
                        <input type="submit" name="sendmail" value="send another mail" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>

</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
