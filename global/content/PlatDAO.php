<?php

class PlatDAO{
    public static function getPlatBD(){
        $pdo = monPDO::getPDO();
        $sql = "SELECT * FROM plats";
        $req = $pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPlat($id){
        $pdo = monPDO::getPDO();
        $sql = "SELECT * FROM plats WHERE id = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            ":id" => $id
        ]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function getChoix($id){
        $pdo = monPDO::getPDO();
        $sql = "SELECT DISTINCT c.* FROM choix AS c INNER JOIN box_options AS bo ON c.id = bo.id_choix INNER JOIN plats ON bo.id_plat = plats.id WHERE plats.id = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            "id" => $id
        ]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTypeChoix($id){
        $pdo = monPDO::getPDO();
        $sql = "SELECT DISTINCT bo.* FROM box_options AS bo WHERE bo.id_choix = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            "id" => $id
        ]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // SELECT DISTINCT box_options.id, box_options.nom ,box_options.id_choix FROM plats LEFT JOIN box_options ON plats.id = box_options.id_plat WHERE plats.id
    public static function getCat(){
        $pdo = monPDO::getPDO();
        $sql = "SELECT * FROM categories_plats";
        $req = $pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}