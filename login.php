<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php");
}

include_once 'acessdb.php';

//check if form is submitted
if (isset($_POST['form'])) {
    $con=connexion();
    $login =  $_POST['login'];
    //echo $login+$password;
    $password =  $_POST['password'];
      //echo ($login);
      //echo ($password);

  //  $result = mysqli_query($con, "SELECT * FROM users WHERE login = '" . $login. "' and mot_de_passe = '" . md5($password) . "'"); //md5 of password is stored instead of war string
   $query='SELECT * FROM users WHERE login =? and mot_de_passe =?' ;
    //$query1="SELECT * FROM users" ;
    //$query="SELECT * FROM users WHERE login ='lacouran' and mot_de_passe ='mdp'";
   $request = $con->prepare($query);

   try {

       $request->execute([$login,$password]);
       //$request=$con->q]uery($query);



        }

   catch(Exception $ex) {
       die('Erreur : ' . $ex->getMessage());
   }

    if ($row =  $request->fetch()) {
    //echo("wtf2");
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['usr_name'] = $row['nom'];
        $_SESSION['profil_user'] = $row['profil_user'];
        header("Location:index2.php");
    } else {
        $errormsg = "Incorrect login or Password";
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
                        <input type="submit" name="form" value="form" class="btn btn-primary" />
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
