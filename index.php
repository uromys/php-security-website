<?php
session_start();
include_once 'acessdb.php';
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
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div >

                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                <li><p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                <li><a href="login.php">Login</a></li>
    

                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

    <div class="container-fluid text-center">
        <div style="margin-top: 15%;
        margin-bottom: 18%;">
            <h2><?php if (isset($_SESSION['usr_id'])) { ?>
                <p>Signed in as <?php echo $_SESSION['usr_name']; ?></p>
                <?php } ?></h2>

            <h3><a href="login.php">Login</a></h3>
        </div>
    </div>




<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
