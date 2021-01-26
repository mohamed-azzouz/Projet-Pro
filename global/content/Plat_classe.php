<?php

class Plat{

    private $id;
    private $nom;
    private $image = [];
    private $description;
    private $prix;
    private $id_cat;

    public static $mesPlats = [];

    public function __construct($id,$nom,$image,$description,$prix,$id_cat){
        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image;
        $this->description = $description;
        $this->prix = $prix;
        $this->id_cat = $id_cat;
        
        self::$mesPlats[] = $this;
    }

    public function getId(){return $this->id;}
    public function getNom(){return $this->nom;}
    public function getImage(){return $this->image;}
    public function getDescription(){return $this->description;}
    public function getPrix(){return $this->prix;}
    public function getIdcat(){return $this->id_cat;}

    public function setId($id){$this->id = $id;}
    public function setNom($nom){$this->nom = $nom;}
    public function setImage($image){$this->image = $image;}
    public function setDesctiption($description){$this->description = $description;}
    public function setPrix($prix){$this->prix = $prix;}
    public function setIdcat($id_cat){$this->id_cat = $id_cat;}

}






















?>