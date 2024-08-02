<?php
session_start();
$reference="../../php/";
include("../../config.php");
if(isset($_POST["libelle"])){
	foreach($_POST as $cle=>$valeur){
		$$cle=$valeur;
	}
	$z_index=2;
	$top_desc=15;
	$left_desc=10;
	$display_desc='block';
	$font_size=13;
		$bdd->query("UPDATE locaux SET
		libelle='$libelle',
		etage='$etage',
		longueur='$longueur',
		largeur='$largeur',
		description='$description',
		surface='$surface',
		-- font_size='$font_size',
		-- width='$width',
		-- height='$height',
		-- top='$top',
		-- gauche='$gauche',
		-- z_index='$z_index',
		type='$type' WHERE id='$id' ");
		echo 1;
}
else
	echo "les informations n'ont pas pu etre envoyées. réessayez";

?>




