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
	
	$donnees_routes=$bdd->get_results(
		"SELECT * FROM locaux, contrats, locataires WHERE `locaux`.`id` =$id AND `locaux`.`id`=`contrats`.`local` AND `locataires`.`id`=`contrats`.`locataire`  AND `contrats`.`date_debut` < '$date' AND `contrats`.`date_fin` > '$date'");
	$routes=array();
	if(count($donnees_routes)){
		foreach($donnees_routes as $r)
		{
			$routes=array();
    		$nbr_mois=diff_en_mois_entre_deux_date($r->date_debut,$r->date_fin);
    		$nbr_mois_rest=diff_en_mois_entre_deux_date($r->date,$r->date_fin);
    		//$nomtant_rest=($r->montant * $nbr_mois_rest) / $nbr_mois;
    		// $nomtant_rest=($r->montant * $nbr_mois_rest);
    		$autre_declaration=($r->autre_declaration * $nbr_mois_rest);

			$route=array();
			foreach($r as $cle=>$valeur)
			{
				$route[$cle]=securiser($valeur);
			}
			$route["indice"]="1";
			$route["montant"]=$r->montant;
			$route["autre_declaration"]=$autre_declaration;
			$route["nom_locataire"]=$autre_declaration;
			array_push($routes,$route);
	 	}
	} else{
	 	$donnees_routes=$bdd->get_results(
		"SELECT * FROM locaux WHERE `locaux`.`id` =$id");
		foreach($donnees_routes as $r)
		{
			$route=array();
			foreach($r as $cle=>$valeur)
			{
				$route[$cle]=securiser($valeur);
			}
			$route["indice"]="0";
			array_push($routes,$route);
	 	}

	 }
	echo json_encode($routes);

	function diff_en_mois_entre_deux_date($start,$end) {
		//$date_format=Y-m-d
		sscanf($start, "%4s-%2s-%2s", $annee, $mois, $jour);
		$a1=$annee;
		$m1=$mois;
		sscanf($end, "%4s-%2s-%2s", $annee, $mois, $jour);
		$a2=$annee;
		$m2=$mois;

		$dif_en_mois=($m2-$m1)+12*($a2-$a1);
		return $dif_en_mois ;
	}
?>
					