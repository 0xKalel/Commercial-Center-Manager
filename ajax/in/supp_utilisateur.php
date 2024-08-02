<?php session_start();
	include("../../config.php");
	include("../../php/bdd_securite.php");

	$nom=Securite::bdd($_POST['nom'],$bdd2);
	
	if($bdd->query("DELETE FROM admin WHERE nom='$nom'"))
		echo 2;
	else echo 1;
	

 ?>