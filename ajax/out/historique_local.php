<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
	//la boucle suivante prepare les variables et les securise
	
	$id =$_POST['id']; 
	$donnees_routes=$bdd->get_results(
		"SELECT * FROM locaux, contrats, locataires WHERE `locaux`.`id` =$id AND `locaux`.`id`=`contrats`.`local` AND `locataires`.`id`=`contrats`.`locataire`");
	$routes=array();
	if(count($donnees_routes)){
		foreach($donnees_routes as $r)
		{
			$route=array();
			foreach($r as $cle=>$valeur)
			{
				$route[$cle]=securiser($valeur);
			}
			array_push($routes,$route);
	 	}
	} 
	echo json_encode($routes);
?>
					