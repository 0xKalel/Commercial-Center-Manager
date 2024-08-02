<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
	//la boucle suivante prepare les variables et les securise
	$sortby="";
	$filtre_bdd="";
	$date_bdd="";
	$i=0;
	$limite=5;
	foreach($_POST as $key=>$value)
	{
		if($key=="filtre")
			$$key=$value;
		else
			$$key=$value;
	}
	if(isset($sort))
		$sortby="ORDER BY $sort $ordre";
	if(isset($filtre))
		foreach($filtre as $f)
		{
			if($i==0)
			{
				foreach($f as $fc=>$fv)
				$filtre_bdd.="WHERE $fc LIKE '$fv%'";
			}
			else
			{
				foreach($f as $fc=>$fv)
				$filtre_bdd.=" AND $fc LIKE '$fv%'";
			}
			$i++;
		}
	

	$affiche=($page-1)*$interval;
	$donnees_routes=$bdd->get_results("SELECT contrats.id, contrats.montant,contrats.autre_declaration, locaux.libelle, locataires.nom, DATE_FORMAT(date_debut,'%d/%m/%Y ') AS date_debut, DATE_FORMAT(date_fin,'%d/%m/%Y ') AS date_fin,fichier FROM contrats, locaux, locataires WHERE contrats.local=locaux.id AND contrats.locataire=locataires.id $filtre_bdd $sortby LIMIT $affiche, $interval");
	$routes=array();
	// if(count($donnees_routes))
	// 	foreach($donnees_routes as $r)
	// 	{
	// 		$route=array();
	// 		foreach($r as $cle=>$valeur)
	// 		{
	// 			$route[$cle]=securiser($valeur);
	// 		}
	// 		array_push($routes,$route);
	//  	}
	echo json_encode($donnees_routes);
?>
					