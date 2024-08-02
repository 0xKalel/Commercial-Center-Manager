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
	if($page !='0'){
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
		$donnees_routes=$bdd->get_results("SELECT * FROM locaux $filtre_bdd $sortby LIMIT $affiche, $interval");
		$routes=array();
		if(count($donnees_routes)){
			$date=date("Y-m-d");
			foreach($donnees_routes as $r)
			{
				$route=array();
					
					
				foreach($r as $cle=>$valeur)
				{
					if($cle=='id') {
						$occupe=$bdd->get_results("SELECT * FROM locaux, contrats WHERE `contrats`.`local`=`locaux`.`id` AND `locaux`.`id`=$valeur AND `contrats`.`date_debut` < '$date' AND `contrats`.`date_fin` > '$date'");
						if (count($occupe)) $route["etat"]="Occupé";
						else $route["etat"]="Libre";
					}
					$route[$cle]=securiser($valeur);
				}
				array_push($routes,$route);
		 	}
		}
			
		echo json_encode($routes);
	}else {
		echo json_encode($bdd->get_results("SELECT * FROM locaux "));
	}
?>
					