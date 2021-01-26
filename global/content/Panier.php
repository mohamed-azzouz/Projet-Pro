<?php

class Panier{

    public function __construct(){
        // si il n'y a pas de session on en ouvre une
        if(!isset($_SESSION)){
            session_start();
        }
        // si il n'y a pas de session panier, je l'a crée
        if(!isset($_SESSION["panier"])){
            $_SESSION["panier"] = [];
        }

        // if(isset($_GET["delPanier"])){
        //     $this->del($_GET["delPanier"]);
        // }

        if(isset($_POST["panier"]["quantity"])){
            $this->recalc();
        }
    }

    public function recalc(){
        foreach($_SESSION["panier"] as $plat_id => $quantity){
            $_SESSION["panier"][$plat_id] = $_POST["panier"]["quantity"][$plat_id];
        }
    }

    public function count(){
        return array_sum($_SESSION["panier"]);
    }

    public function total(){
        $total = 0;
        $id_session = array_keys($_SESSION["panier"]);
        $id = implode(',',$id_session);
        if(empty($id_session)){
            $plats = [];
        }else{
            $pdo = monPDO::getPDO();
            $sql = "SELECT id, prix FROM plats WHERE id IN ($id)";
            $req = $pdo->prepare($sql);
            $req->execute();
            $plats = $req->fetchAll(PDO::FETCH_ASSOC);
        }
        foreach($plats as $plat){
            $total += ($plat["prix"]*$_SESSION["panier"][$plat["id"]]);
        }
        return $total;
    }

    // ajouter un plat au panier via son id
    public function add($plat_id){
        if(isset($_SESSION["panier"][$plat_id])){
            $_SESSION["panier"][$plat_id]++;
        } else {
            // j'attribut a ma session panier l'id du plat en question, je l'incrémente a 1
            $_SESSION["panier"][$plat_id] = 1;
        }
    }

    public function del($plat_id){
        if(isset($_SESSION["panier"][$plat_id])){
            if($_SESSION["panier"][$plat_id] <= 1){
                unset($_SESSION["panier"][$plat_id]);
            } else {
                $_SESSION["panier"][$plat_id]--;
            }
        };
    }

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