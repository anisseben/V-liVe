<?php
require_once("lib/fonctionsHTML.php");

$parametres="";
$erreur_nom="";
$erreur_nbr="";
$erreur_commune="";
$nom= filter_input(INPUT_GET,'nom',FILTER_SANITIZE_STRING);
if ($nom===FALSE || is_numeric($nom)){
  $parametres.="/?nom=";
  $erreur_nom="<b style =\"color : red \">veuillez saisir un nom</b>";

}
else {
  $parametres.="/?nom=$nom";
}

$commune= filter_input(INPUT_GET,'commune',FILTER_SANITIZE_STRING);
if ($commune===FALSE || is_numeric($commune)){
  $parametres.="&commune=";
  $erreur_commune="<b style =\"color : red ;\">veuillez saisir un nom</b>";
}
else{
  $parametres.="&commune=$commune";
}

$nbvelos = filter_input(INPUT_GET,'nbvelos',FILTER_VALIDATE_INT,['options'=>['default'=>"",'min_range'=>0]]);
if ($nbvelos===FALSE){
  $parametres.="&nbVelosDispo=";
  $erreur_nbr="<b style =\"color : red ;\">veuillez saisir un nombre</b>";
}
else {
  $parametres.="&nbVelosDispo=$nbvelos";
}

$nbplaces = filter_input(INPUT_GET,'nbplaces',FILTER_VALIDATE_INT,['options'=>['default'=>"",'min_range'=>0]]);
if ($nbplaces===FALSE){
  $parametres.="&nbPlacesDispo=";
  $erreur_nbr="<b style =\"color : red \">veuillez saisir un nombre</b>";
}
else {
  $parametres.="&nbPlacesDispo=$nbplaces";
}

$service=$_GET['service'];

if($service="en_service"){
$parametres.="&etat=EN%20SERVICE";
}
if($service="hors_service"){
  $parametres.="&etat=HORS%20SERVICE";
}
else{
  $parametres.="&etat=HORS%20SERVICE&etat=EN%20SERVICE";
}

$reponse = file_get_contents("http://vlille.fil.univ-lille1.fr".$parametres);
$array=json_decode($reponse,true);



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
 <meta charset="UTF-8" />
 <title>Carte</title>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
 <script src="VliveImage.js/VliveImage.js"></script>
 <script src="carte.js"></script>
 <link rel="stylesheet" href="style/style.css"/>
</head>
<body>
<h1> Station velos </h1>
<img src="img/img.jpg" alt="wrraper">
<div id="carte_campus"></div>

<form action="Carte.php" method = "get">
  <fieldset id="recherche">
    <legend> Recherche d'une stations </legend>
    <div id="input">
    <div class ="input"><label for="nom">Nom : </label><input type="text" id="nom" name="nom"size="25" maxlength="25" /><?php echo $erreur_nom ?></div>
    <div class ="input"><label for="nom">Commune : </label><input type="text" id="commune" name="commune" size="25" maxlength="25" /><?php echo $erreur_commune ?></div>
    <div class ="input"><label for="nbvelos">Nombre de velos : </label><input type="text" id="nbvelos" name="nbvelos" size="25" maxlength="25" /><?php echo $erreur_nbr ?></div>
    <div class ="input"><label for="nbplaces">Nombre de places : </label><input type="text" id="nbplaces" name="nbplaces" size="25" maxlength="25"/><?php echo $erreur_nbr ?></div>
  </div>
    <div id="service">
      <label for="en_service">en service</label><input type="radio" id="en_service" name="service" value="en_service">
      <label for="hors_service">hors service</label><input type="radio" id="hors_service" name="service" value="hors_service">
      <label for="Tout">Tout</label><input type="radio" id="Tout" name="service" value="Tout" checked>
   </div>
  </fieldset>
  <section id="submit">
    <button type="submit" name="valid" value="envoyer">Recherche</button>
  </section>
</form>


<ul id="stations">
  <?php
    echo convertToHTML($array);
  ?>

</ul>

</body>
