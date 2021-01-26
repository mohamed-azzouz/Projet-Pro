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

    public static function getCat(){
        $pdo = monPDO::getPDO();
        $sql = "SELECT * FROM categories_plats";
        $req = $pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}