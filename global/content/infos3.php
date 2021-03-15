<?php

session_start();
echo "OK";

$data_feculent = $_POST["feculent"];


switch($data_feculent){
    case "feculent0":
        $_SESSION["feculent"] = "riz";
        var_dump($_SESSION);
    break;
    case "feculent1":
        $_SESSION["feculent"] = "quinoa";
        var_dump($_SESSION);
    break;
    case "feculent2":
        $_SESSION["feculent"] = "pates";
        var_dump($_SESSION);
    break; 
};
