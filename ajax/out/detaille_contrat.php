<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
	//la boucle suivante prepare les variables et les securise

	$i=0;
	$limite=5;
	foreach($_POST as $key=>$value)
	{
		if($key=="filtre")
			$$key=$value;
		else
			$$key=$value;
	}
	$date=date("Y-m-d");
	
	$res=$bdd->get_results(
		"SELECT * FROM locaux, contrats, locataires, paiement WHERE `contrats`.`id` =$id AND `locaux`.`id`=`contrats`.`local` AND `locataires`.`id`=`contrats`.`locataire` AND `contrats`.`id`=`paiement`.`contrat` AND `contrats`.`date_debut` < '$date' AND `contrats`.`date_fin` > '$date' ORDER BY date");
	if (count($res)!=0) echo json_encode($res);
	else echo json_encode($bdd->get_results(
		"SELECT * FROM locaux, contrats, locataires WHERE `contrats`.`id` =$id AND `locaux`.`id`=`contrats`.`local` AND `locataires`.`id`=`contrats`.`locataire"));
?>
					