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
		echo json_encode($bdd->get_results("SELECT * FROM locataires $filtre_bdd $sortby LIMIT $affiche, $interval"));
	}
	else {
		echo json_encode($bdd->get_results("SELECT * FROM locataires "));
	}
?>
					