<?php


class monPDO{

    private const HOST_NAME = "localhost";
    private const DB_NAME = "projetpro";
    private const USER_NAME = "root";
    private const PWD = "";

    private static $pdoInstance = null;

    public static function getPDO(){
        if(is_null(self::$pdoInstance)){
            try{
                $connexion = "mysql:host=".self::HOST_NAME.";dbname=".self::DB_NAME;
                $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                self::$pdoInstance = new PDO($connexion,self::USER_NAME,self::PWD,$options);
            }
            catch(PDOException $e){
                $message = "Erreur de connexion à la BD". $e->getMessage();
                die($message);
            }
        }
        return self::$pdoInstance;
    }
}