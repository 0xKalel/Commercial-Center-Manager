<?php session_start();
	include("../../config.php");
	include("../../php/bdd_securite.php");

	$nom=Securite::bdd($_POST['nom'],$bdd2);
	$mot_de_passe=Securite::bdd($_POST['mot_de_passe'],$bdd2);
	$type=Securite::bdd($_POST['type'],$bdd2);

	$req=$bdd->get_var("SELECT COUNT(*) FROM admin WHERE nom='$nom'");
	echo $req;
	if ($req==0){
		if($bdd->query("INSERT INTO admin (nom, mot_de_passe, type) VALUES ('$nom', '$mot_de_passe', '$type')"))
			echo 2;
		else echo 1;
	}else echo 0;

 ?>