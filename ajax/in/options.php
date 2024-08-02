<?php session_start();
	include("../../config.php");
	include("../../php/bdd_securite.php");

	$etage=Securite::bdd($_POST['etage'],$bdd2);
	$interval=Securite::bdd($_POST['interval'],$bdd2);
	$color1=Securite::bdd($_POST['color1'],$bdd2);
	$color2=Securite::bdd($_POST['color2'],$bdd2);
	
	if($bdd->query("UPDATE options SET etage='$etage', nbr='$interval', color1='#$color1', color2='#$color2'"))
		echo 2;
	else echo 1;
	

 ?>