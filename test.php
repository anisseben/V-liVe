
<?php
require_once("lib/fonctionsHTML.php");
$parametres="";
$reponse = file_get_contents("http://vlille.fil.univ-lille1.fr/?commune=LILLE&commune=LOOS".$parametres);
$array=json_decode($reponse,true);


require_once("Carte.php");

?>
