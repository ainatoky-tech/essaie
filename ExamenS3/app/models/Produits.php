<?php
namespace app\models;
use Flight;

Class Produits{
    public static function getAllProduct(){
        $sql = "SELECT * FROM commerce_produit";
        $PDO = Flight::db();
        $stmt= $PDO->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getProductByFilter($nom,$estimation,$idcategorie){
        $sql = "SELECT * FROM commerce_produit WHERE 1=1";
        $param = [];

        if(!empty($idcategorie)){
            $sql .= " AND categorie_id = ?  ";
            $param[] = $idcategorie;
        }
        if(!empty($nom)){
            $sql .= " AND nom LIKE ?  ";
            $param[] = $nom;
        }
        if(!empty($estimation)){
            $sql .= " AND estimation <= ?  ";
            $param[] = $estimation;
        }
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getProductExceptMe($idproprietaire){
        $sql = "SELECT * FROM commerce_produit WHERE proprietaire_id != ? ";
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$idproprietaire]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getMyProduct($utilisateur_id){
        $sql = "SELECT * FROM commerce_produit WHERE proprietaire_id = ? ";
        $PDO =Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getCategory(){
        $sql = "SELECT * FROM commerce_categorie";
        $PDO = Flight::db();
        $stmt = $PDO->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function AddProduit($nom, $photo, $description, $estimation, $categorie_id,$proprietaire_id){
        $sql = "INSERT INTO commerce_produit (nom, photo, descriptions, estimation, categorie_id, proprietaire_id) VALUES (?, ?, ?, ?, ?, ?)";
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([
            $nom,
            $photo,
            $description ?: null,
            $estimation,
            $categorie_id,
            $proprietaire_id
        ]);
    }
    
}
?>