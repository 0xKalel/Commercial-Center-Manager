<?php session_start();
$reference="../../php/";
include("../../config.php");
if(isset($_POST["nom"])){
	foreach($_POST as $cle=>$valeur){
		$$cle=$valeur;
	}
	$z_index=2;
	$top_desc=15;
	$left_desc=10;
	$display_desc='block';
	$font_size=13;
	if(	$bdd->query("insert INTO locaux(
		libelle,etage,longueur,
		largeur,description,surface,font_size,
		width,height,top,gauche,z_index,type)
	VALUES(
		'$nom','$etage','$longueur',
		'$largeur','$description','$surface','$font_size',
		'$width','$height','$top','$gauche','$z_index','$type')")
	)
		echo $bdd->insert_id;
	else
		echo "erreur connexion";
}
else
	echo "les informations n'ont pas pu etre envoyées. réessayez";

?>




