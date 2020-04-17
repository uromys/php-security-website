<?php
include_once 'acessdb.php';


session_start();
//for all page after login and confirmation
if(!isset($_SESSION['connected'])) {
    header("Location: index.php");
}
$request=GetAllContentOfaUser($_SESSION['id_user']);
$row =  $request->fetch();
$_SESSION['solde_compte'] = $row['solde_compte'];
?>
 <head>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" >
     <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
 </head>
 <nav class="navbar navbar-default" role="navigation">
     <div class="container-fluid">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <div>
                 <a class="navbar-brand" href="accueil.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
             </div>
         </div>
         <div class="collapse navbar-collapse" id="navbar1">

             <ul class="nav navbar-nav navbar-right">

                 <li><p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Signed in as <?php echo $_SESSION['usr_name']." ".$_SESSION["surname"]; ?></p></li>
                 <li><a href="logout.php">Log Out</a></li>

             </ul>
             <div>
             <ul class="nav navbar-nav navbar-center">
                <li> <label> Your money   </label><?php echo   $_SESSION['solde_compte'];?><label> $  </label></li>

             </ul>
           </div>
         </div>
     </div>
 </nav>
