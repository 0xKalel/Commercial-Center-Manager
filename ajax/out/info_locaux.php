<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
	//la boucle suivante prepare les variables et les securise

	$etage=$_POST['Num'];
		
	$req=$bdd->get_results("SELECT * FROM locaux WHERE etage=$etage");
	$info=array();
	$info['nbr']=count($req);
	$date=date("Y-m-d");
	$req2=$bdd->get_results("SELECT DISTINCT(`locaux`.`id`) FROM `locaux`,`contrats`,`paiement` WHERE etage=$etage AND `locaux`.`id`=`contrats`.`local` AND `contrats`.`id`=`paiement`.`contrat` AND `contrats`.`date_debut` < '$date' AND `contrats`.`date_fin` > '$date'");
	$info['nbr_libre']=$info['nbr'] - count($req2);
	$info['nbr_occupe']=count($req2);
	
	echo json_encode($info);
	
?>
					