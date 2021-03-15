<?php

$data = json_decode($_POST['json']);

// var_dump($_POST["json"]);
// var_dump($data);

// inset dbb <div class=""</div>

$genre = $data->{"genre"};
$age = $data->{"age"};
$obj = $data->{"obj"};
$habitude = $data->{"habitude"};

$homme = "img-homme";
$femme = "img-femme";
$age_20_30 = "img-2030";
$age_30_40 = "img-3040";
$age_40_50 = "img-4050";
$seche = "img-seche";
$stabilisation = "img-stabi";
$masse = "img-masse";
$activ_leger = "img-sport1";
$activ_moyen = "img-sport2";
$activ_regulier = "img-sport3";

/* homme */

echo $genre == $homme && $age == $age_20_30 && $obj == $seche && $habitude == $activ_leger ? "coucou" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $seche && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $seche && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $stabilisation && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $stabilisation && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $stabilisation && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $masse && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $masse && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_20_30 && $obj == $masse && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $seche && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $seche && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $seche && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $stabilisation && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $stabilisation && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $stabilisation && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $masse && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $masse && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_30_40 && $obj == $masse && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $seche && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $seche && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $seche && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $stabilisation && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $stabilisation && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $stabilisation && $habitude == $activ_regulier ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $masse && $habitude == $activ_leger ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $masse && $habitude == $activ_moyen ? "" : "";
echo $genre == $homme && $age == $age_40_50 && $obj == $masse && $habitude == $activ_regulier ? "" : "";

/*femme*/

echo $genre == $femme && $age == $age_20_30 && $obj == $seche && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $seche && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $seche && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $stabilisation && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $stabilisation && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $stabilisation && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $masse && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $masse && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_20_30 && $obj == $masse && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $seche && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $seche && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $seche && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $stabilisation && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $stabilisation && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $stabilisation && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $masse && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $masse && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_30_40 && $obj == $masse && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $seche && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $seche && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $seche && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $stabilisation && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $stabilisation && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $stabilisation && $habitude == $activ_regulier ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $masse && $habitude == $activ_leger ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $masse && $habitude == $activ_moyen ? "" : "";
echo $genre == $femme && $age == $age_40_50 && $obj == $masse && $habitude == $activ_regulier ? "" : "";


echo $genre, $age, $obj, $habitude;

?>