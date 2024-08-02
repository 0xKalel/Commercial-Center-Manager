<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
		foreach($_POST as $key=>$value)
	{
		$$key=securiser($value);
	}
	if($nom_table=="contrats")
	$nbr_page=$bdd->get_var("SELECT count(*)  FROM contrats, locaux, locataires WHERE contrats.local=locaux.id AND contrats.locataire=locataires.id ");
		else
	$nbr_page=$bdd->get_var("SELECT count(*) FROM $nom_table");
	echo json_encode($nbr_page);
	