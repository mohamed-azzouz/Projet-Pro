<?php

require_once("Database.php");

class Users{
    private $id;
    private $nom;
    private $prenom;
    private $mdp;
    private $mdp2;
    private $mail;
    private $tel;
    private $id_droits;
    private $connmdp;

    public function __construct($nom = "",$prenom = "",$mdp = "",$mdp2 = "",$mail = "",$tel = "",$connmdp = "")
    {
        $this->mdp = password_hash($mdp,PASSWORD_DEFAULT);
        $this->nom = filter_var($nom,FILTER_SANITIZE_SPECIAL_CHARS);
        $this->prenom = filter_var($prenom,FILTER_SANITIZE_SPECIAL_CHARS);
        $this->mdp2 = $mdp2;
        $this->mail = filter_var($mail,FILTER_SANITIZE_SPECIAL_CHARS);
        $this->tel = $tel;
        $this->id_droits = 1;
        $this->connmdp = $connmdp;
    }

    public function verify(){

        $pdo = monPDO::getPDO();
        $sql = "SELECT mail FROM utilisateurs WHERE mail = :mail";
        $req = $pdo->prepare($sql);
        $req->execute([
            ":mail" => $this->mail
        ]);
        $mailExist = $req->fetch();
        if(!$mailExist){
            if(strlen($this->mdp2) > 5 && strlen($this->mdp2) < 20){
                if(password_verify($this->mdp2, $this->mdp)){
                    return "ok";
                } else {
                    $error = "Les mots de passes ne correspondent pas";
                    return $error;
                }
            } else {
                $error = "Le mot de passe doit contenir entre 5 et 20 caractères";
                return $error;
            }
        } else {
            $error = "Ce mail existe déjà";
            return $error;
        }
    }

    public function inscription(){
        $pdo = monPDO::getPDO();
        $sql = "INSERT INTO utilisateurs(id,nom,prenom,mdp,mail,tel,id_popup,id_droits) VALUES (:id,:nom,:prenom,:mdp,:mail,:tel,0,:id_droits)";
        $req = $pdo->prepare($sql);
        $req->execute([
            ":id" => $this->id,
            ":nom" => $this->nom,
            ":prenom" => $this->prenom,
            ":mdp" => $this->mdp,
            ":mail" => $this->mail,
            ":tel" => $this->tel,
            ":id_droits" => $this->id_droits
        ]);
        return "ok";
    }

    public function connect(){
        $pdo = monPDO::getPDO();
        $sql = "SELECT * FROM utilisateurs WHERE mail = :mail";
        $req = $pdo->prepare($sql);
        $req->execute([
            ":mail" => $this->mail
        ]);
        $result = $req->fetch();
        if($result){
            if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL) === false) {
                if(password_verify($this->connmdp,$result["mdp"])){
                    $this->prenom = $result["prenom"];
                    return "ok";
                } else {
                    $error = "ok";
                    return $error;
                }
            } else {
                $error = "email non valide";
                return $error;
            }
        } else {
            $error = "le mail n'existe pas";
            return $error;
        }
    }

    public function getNom(){return $this->nom;}
    public function getLogin(){return $this->mail;}
    public function getDroits(){return $this->id_droits;}
}