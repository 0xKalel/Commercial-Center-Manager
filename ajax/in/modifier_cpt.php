<?php session_start();
	include("../../config.php");
	include("../../php/bdd_securite.php");

	$nom_actuel=Securite::bdd($_POST['nom_actuel'],$bdd2);
	$mot_passe_actuel=Securite::bdd($_POST['mot_passe_actuel'],$bdd2);
	$nouveau_nom=Securite::bdd($_POST['nouveau_nom'],$bdd2);
	$nouveau_mot_passe=Securite::bdd($_POST['nouveau_mot_passe'],$bdd2);

	$req=$bdd->get_var("SELECT COUNT(*) FROM admin WHERE nom='$nom_actuel' AND mot_de_passe='$mot_passe_actuel'");
	if ($req>0){
		$res=$bdd->get_var("SELECT COUNT(*) FROM admin WHERE nom='$nouveau_nom'");
		if ($res==0){
			if($bdd->query("UPDATE admin SET nom='$nouveau_nom', mot_de_passe='$nouveau_mot_passe' WHERE nom='$nom_actuel'"))
				echo 3;
			else 
				echo 2;
		}else 
			echo 1;
	}else 
		echo 0;

 ?>