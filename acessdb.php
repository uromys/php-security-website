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
