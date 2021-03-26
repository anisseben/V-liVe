<?php

function convertToHTML($table){
  $res="";
  foreach ($table as $key) {
      $fields=$key["fields"];
      $res.="<li etat=\"".$fields["etat"]."\" etatconnexion=\"".$fields["etatconnexion"]."\" data-nbvelosdispo=\"".$fields["nbvelosdispo"]."\" data-nbplacesdispo=\"".$fields["nbplacesdispo"]."\" data-commune=\"".$fields["commune"]."\" type=\"".$fields["type"]."\"
      libelle=\"".$fields["libelle"]."\" datemiseajour=\"".$fields["datemiseajour"]."\" localisation=\"".$fields["localisation"]."\" data-nom=\"".$fields["nom"]."\" adresse=\"".$fields["adresse"]."\" data-geo=\"".json_encode($fields["geo"])."\"> <b>nom: </b>".$fields["nom"].
      "<b>commune: </b>".$fields["commune"]."<b>nbvelos: </b>".$fields["nbvelosdispo"]."<b>nbplaces: </b>".$fields["nbplacesdispo"]." </li>";
  }
  return $res;

}

?>
