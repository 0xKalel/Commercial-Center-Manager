<?php
session_start();
$reference="../../php/";
include("../../config.php");
include("../../php/bdd_securite.php");


	$nom=Securite::bdd($_POST["nom"],$bdd2);
	$tel=Securite::bdd($_POST["tel"],$bdd2);
	$mobile=Securite::bdd($_POST["mobile"],$bdd2);
	$res=$bdd->get_var("SELECT COUNT(*) FROM locataires WHERE nom='$nom'");

	if($res>0){
		echo "un locataire avec le meme nom existe déja";
	} 
	else {
		if($bdd->query("INSERT INTO locataires(nom,tel,mobile) VALUES('$nom','$tel','$mobile')"))
			echo 1; //informations correctes
		else echo "erreur connexion";
	};

?>