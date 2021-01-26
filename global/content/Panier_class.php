<?php

require_once("Database.php");

class Panier{
    private $id;
    private $quantite;
    private $id_utilisateur;
    private $id_plat;
    
    public function __construct($id,$quantite,$id_utilisateur,$id_plat){
        $this->id = $id;
        $this->quantite = $quantite;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_plat = $id_plat;
    }

    public function getId(){return $this->id;}
    public function getQuantite(){return $this->quantite;}
    public function getIdUtilisateur(){return $this->id_utilisateur;}
    public function getIdPlat(){return $this->id_plat;}
    
    public function ajouter(){
        $pdo = monPDO::getPDO();
        $sql = "INSERT INTO panier(id,quantite,id_utilisateur,id_plat) VALUES (:id,:quantite,:id_utilisateur,:id_plat)";
        $req = $pdo->prepare($sql);
        $req->execute([
            ":id" => $this->id,
            ":quantite" => $this->quantite,
            ":id_utilisateur" => $this->id_utilisateur,
            ":id_plat" => $this->id_plat
        ]);
    }

}


?>