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
Get the public  Data of a user and store it in the session
*/

function GetUserById($userId){
  $con=connexion();
  $query='SELECT nom,prenom,profil_user,numero_compte,solde_compte,id_user FROM users WHERE id_user =?' ;
  $request = $con->prepare($query);
  try {
     $request->execute([$userId]);
$result=$request->fetch();
     //echo $result['nom'];
     return $result;
      }
  catch(Exception $ex) {
     die('Erreur : ' . $ex->getMessage());
  }
}
/*
Get the public data  from his loging

Use for login

*/





function GetUser($login){
  $con=connexion();
  $query='SELECT nom,prenom,mot_de_passe,profil_user,id_user FROM users WHERE login =?' ;
  $request = $con->prepare($query);
  try {
     $request->execute([$login]);

     //echo $result['nom'];
     return $request;
      }
  catch(Exception $ex) {
     die('Erreur : ' . $ex->getMessage());
  }
}

/*


Get all  the data of the one logged
except the password, better safe than sorry ^^
*/

function GetAllContentOfaUser($login){
  $con=connexion();
  $query='SELECT nom,prenom,profil_user,numero_compte,solde_compte,login,id_user FROM users WHERE id_user =?' ;
  $request = $con->prepare($query);
  try {
     $request->execute([$login]);

     //echo $result['nom'];
     return $request;
      }
  catch(Exception $ex) {
     die('Erreur : ' . $ex->getMessage());
  }
}



function  GetAllUser(){
  $con=connexion();
  $query='SELECT nom,prenom,profil_user,numero_compte,solde_compte,id_user FROM users order by nom' ;
  try {
    $request=$con->query($query);
    return $request;
      }
  catch(Exception $ex) {
     die('Erreur : ' . $ex->getMessage());
  }



}




/*
return email of the user ,search by id
*/
function searchemail($id){
    try {
  $con=connexion();
  $query='SELECT mail FROM email WHERE  id=?' ;
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
/*
each time you try to connect add a a value there
*/
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


/*
count try you a login connected in the last minute
*/
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


/*
get all the message of the connected users
*/
function GetmyMessage($userid){
    try {
    $con=connexion();

      $query='SELECT sujet_msg,corps_msg,id_user_from FROM messages where id_user_to=?' ;
      $request = $con->prepare($query);
      $request->execute([$userid]);
      return $request;
}catch(Exception $ex) {
    die('Erreur : ' . $ex->getMessage());
  }
}

/*

to send msg
*/

function insertmsg($iduser,$idUserReceiver,$content,$subject){
  try {
    $con=connexion();
    $query='insert  into  messages (`id_user_to`,`id_user_from`,sujet_msg,corps_msg)   values (?,?,?,?)';
    $request = $con->prepare($query);
    $request->execute([$iduser,$idUserReceiver,$content,$subject]);
    return 1;
  }catch(Exception $ex) {
      die('Erreur : ' . $ex->getMessage());
  }
}


function HasTheRighttoSendtoo(){
  try {
    $con=connexion();
    if   ($_SESSION['profil_user']=="employe"){
      $query='SELECT id_user,nom,prenom,profil_user,numero_compte,solde_compte FROM users' ;
      $request=$con->query($query);
      return $request;
    }else{
      $query='SELECT id_user,nom,prenom FROM users where profil_user="client"' ;
      $request=$con->query($query);
      return $request;
    }
  }catch(Exception $ex) {
      die('Erreur : ' . $ex->getMessage());
  }
}




function transfert($dest, $src, $value)
{
  $con=connexion();
  if ($value < 0) {
    return 'Enter a correct value';
  }
  if ($src == $dest) { //empecher de s'auto envoyer de l'argent
    return "It's not possible to transfert to your own account ";;
  }
  try{
    $con->beginTransaction();
    $query = "UPDATE users SET solde_compte = solde_compte + ? WHERE numero_compte = ?";

    $request = $con->prepare($query);
    $request->execute([$value,$dest]);
    $query2 = "UPDATE users SET solde_compte = solde_compte - ?  WHERE numero_compte = ?";
    $request2 = $con->prepare($query2);
    $request2->execute([$value,$src]);
    $con->commit();

  }catch(Exception $ex) {
      $con->rollBack();
        return('Erreur : ' . $ex->getMessage());
  }
    return "Money has been send";
}
