<?php
require_once("Database.php");
require_once("Plat_classe.php");
require_once("PlatDAO.php");
require_once("Panier.php");

$panier = new Panier();

$json = ["error" => true];

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $pdo = monPDO::getPDO();
    $sql = "SELECT id FROM plats WHERE id = :id";
    $req = $pdo->prepare($sql);
    $req->execute([
        ":id" => $id
    ]);
    $plat = $req->fetchAll(PDO::FETCH_OBJ);
    if(empty($plat)){
        $json["message"] = "Ce produit n'existe pas";
    }
    $panier->add($plat[0]->id);
    $json["error"] = false;
    $json["total"] = $panier->total();
    $json["count"] = $panier->count();
    $json["message"] = "Le produit a bien été ajouté à votre panier";
} else {
    $json["message"] = "Vous n'avez pas sélectionné de produit à ajouter au panier";
}
echo json_encode($json);