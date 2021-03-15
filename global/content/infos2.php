<?php

session_start();
echo "OK";

$data_proteine = $_POST["proteine"];

switch($data_proteine){
    case "proteines0":
        $_SESSION["proteine"] = "poulet";
        var_dump($_SESSION);
    break;
    case "proteines1":
        $_SESSION["proteine"] = "boeuf";
        var_dump($_SESSION);
    break;
    case "proteines2":
        $_SESSION["proteine"] = "saumon";
        var_dump($_SESSION);
    break; 
};
