<?php
class Utils{
  //Connexion en PDO
  static function connect(){
    //Données pour se connecter
    $login = "root";
    $password = "";
    $server = "localhost";
    $dbname = "projet_BD";

    //Connexion
    $connexion = null;
    try{
      $serverinfo = "mysql:host=".$server.";dbname=".$dbname;
      $connexion = new PDO($serverinfo, $login, $password);
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
      echo 'Echec de connexion : '.$e->getMessage();
    }
    return $connexion;
  }

  //Déconnexion
  static function disconnect($connexion){
    $connexion = null;
  }

  //Requête SQL sans résultat (update, delete, insert, etc.)
  //$sql : une requête en SQL
  static function execute($connexion, $sql){
    //Version sans protection contre l'injection sql - à ne pas utiliser !
    //$connexion->exec($sql);

    //Version protégée
    try{
      //Protection de la requête
      $statement = $connexion->prepare($sql);
      //Exécution de la requête
      $statement->execute();
    }
    catch (PDOException $e){
      echo 'Echec d\'exécution : '.$e->getMessage();
    }
  }

  //Requête SQL avec résultat
  static function query($connexion, $sql){
    $result = null;
    try{
      //Protection de la requête
      $statement = $connexion->prepare($sql);
      //Exécution de la requête
      $statement->execute();
      //Récupérer le résultat depuis le statement
      $result = $statement->fetchAll();
    }
    catch (PDOException $e){
      echo 'Echec de query : '.$e->getMessage();
    }
    return $result;
  }
}
 ?>
