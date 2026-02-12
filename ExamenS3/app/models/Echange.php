<?php
namespace app\models;
use Flight;

Class Echange{
    public static function sendProposition($demandeur_id,$recepteur_id,$produit1_id,$produit2_id){
        $sql = "INSERT INTO commerce_echange(demandeur_id,recepteur_id,produit1_id,produit2_id,date_echange,statut) 
        VALUE (? ,? ,? ,? ,NOW() ,'en_attente') ";
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$demandeur_id,$recepteur_id,$produit1_id,$produit2_id]); 
    }


    public static function getPropositionReceivedById($recepteur_id){
        $sql = "SELECT * FROM commerce_echange WHERE recepteur_id = ? AND statut = 'en_attente' ORDER BY date_echange DESC";
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$recepteur_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function updateStatus($id_echange, $nouveau_statut , $demandeur_id) {
        $sql = "UPDATE commerce_echange SET statut = ? WHERE echange_id = ? AND demandeur_id = ? ";
        $PDO = Flight::db();
        $stmt = $PDO->prepare($sql);
        return $stmt->execute([$nouveau_statut, $id_echange,$demandeur_id]);
    }
}
?>