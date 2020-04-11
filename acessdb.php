<?php
//connexion

function connexion() {
    try {
        $connexion = new PDO('mysql:host=localhost;dbname=projetsr03;charset=utf8','admin','admin');

        return $connexion;
        //echo 'Connexion etabli';
    }
    catch(Exception $ex) {
        die("Erreur " . $ex->getMessage());
    }
}

/*
return email of the user ,search by id
*/
function searchemail($id){
    try {
  $con=connexion();
  $query='SELECT mail FROM email WHERE  id=?' ;
   //$query1="SELECT * FROM users" ;
   //$query="SELECT * FROM users WHERE login ='lacouran' and mot_de_passe ='mdp'";
  $request = $con->prepare($query);


      $request->execute([$id]);



       }

          catch(Exception $ex) {
              die('Erreur : ' . $ex->getMessage());
          }
  if ($row =  $request->fetch()){
    //echo "wesh";
    return $row['mail'];

  }else {
    return "fail";
  }

}
function inserttry($logintry){
  try {
    $con=connexion();
    $query='insert  into  count_login(`login_try`,`date_try`)   values (?,?)';
    $request = $con->prepare($query);
    $request->execute([$logintry,date("Y-m-d H:i:s")]);
    return 1;
  }catch(Exception $ex) {
      die('Erreur : ' . $ex->getMessage());
  }
}



function counttry($logintry){
  try {
  $con=connexion();
  $query ='SELECT count(`login_try`)as total FROM count_login WHERE  `date_try` > (NOW() - INTERVAL 1 MINUTE)AND login_try=?';
  $request = $con->prepare($query);
  $request->execute([$logintry]);
  if ($row =  $request->fetch()){
    return $row['total'];
  }
  }catch(Exception $ex) {
      die('Erreur : ' . $ex->getMessage());


    }

}
