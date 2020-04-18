<?php

session_start();
include_once 'acessdb.php';


//check if form is submitted
if (isset($_POST['form'])) {
    $con=connexion();
    $login =  htmlspecialchars($_POST['login'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
    $password=password_hash($_POST['password'], PASSWORD_BCRYPT, [12]);
    $request=GetUser($login);
$numberofTry=counttry($login);
if($numberofTry<=4){
      $row =  $request->fetch();
    if (password_verify($_POST['password'], $row['mot_de_passe'])) {// loging sucess
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['usr_name'] = $row['nom'];
          $_SESSION['surname'] =$row['prenom'];
        $_SESSION['profil_user'] = $row['profil_user'];
  
        header("Location:confirmation.php");

    } else {// on affiche une erreur, et on rajoute une tentative de connexion a notre BDD pour empecher le brute force
          $errormsg = "Incorrect login or Password";

          inserttry($login);
        if($numberofTry<=3&& $numberofTry>0 ){
          //echo $numberofTry;
          $tryleft=4-$numberofTry;
          $errormsg.="<br>".$tryleft ." try left";

        }
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
  <div class="bg">

  <p class="py-5 text-center"></p>
<nav class="navbar navbar-default" role="navigation">  <!--for smaller screens like mobile-->
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
                    <legend>Login</legend>

                    <div class="form-group">
                        <label for="name">login</label>
                        <input type="text" name="login" placeholder="Your login" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>
                    <div class="form-group">
<?php if ($numberofTry<=3)
{

  echo '<input type="submit" name="form" value="loging" class="btn btn-primary" />';
}else{
  $errormsg.="<br> wait 1 minute before trying to reconnect";
}

 ?>

                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>


</div>

</div>
</body>
</html>
