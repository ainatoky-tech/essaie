<?php
namespace app\models;
use Flight;

class Utilisateur{
    
    public static function RegisterUser($nom,$email,$password){
        $hashedpassword = password_hash($password , PASSWORD_BCRYPT);
        $sql = "INSERT INTO commerce_utilisateur(nom,email,MDP) VALUES (? ,? ,?)";
        $PDO= Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$nom,$email,$hashedpassword]);
        return $PDO->lastInsertId();
    }


    public static function LoginForAll($nom,$email,$password){
        $sql = "SELECT * FROM commerce_utilisateur WHERE nom = ? AND email = ? ";
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$nom,$email]);
        $utilisateur = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if($utilisateur && password_verify($password,$utilisateur['MDP'])){
            echo "mot de passe correspondant ";
            return $utilisateur;
        }
        return false;
    }

    public static function nbUser(){
        $sql = "SELECT COUNT(utilisateur_id) as total_utilisateur FROM commerce_utilisateurs";
        $PDO = Flight::db();
        $stmt = $PDO->query($sql);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total_utilisateur'];
    }


}

?>