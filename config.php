<?php

	function securiser($string) { return addslashes(htmlentities(htmlspecialchars(trim($string)))); }

	function echapper($string) {
		$string=str_replace("é","&egrave;",$string);
		$string=str_replace("è","&ecute;",$string);
		return $string;
	}

	include("php/ezSQL/shared/ez_sql_core.php"); 
	include("php/ezSQL/mysqli/ez_sql_mysqli.php"); 


	$bdd=new ezSQL_mysqli('mawajmmo_khalil','6EUeZAK}&bhk','mawajmmo_projects_gestion_locaux','localhost');

	$bdd2=new mysqli('localhost','mawajmmo_khalil','6EUeZAK}&bhk','mawajmmo_projects_gestion_locaux');
	$bdd ->query("SET NAMES 'utf8'");

	$etageSelecnionne=$bdd->get_var("SELECT etage FROM options");
	$interval=$bdd->get_var("SELECT nbr FROM options");
	$color1=$bdd->get_var("SELECT color1 FROM options");
	$color2=$bdd->get_var("SELECT color2 FROM options");


// util 
// 
function format_monetaire($monnaie) {

	if(!preg_match('/^[0-9]*$/', $monnaie)) return false;
	$monnaie=(string)((int)$monnaie);
	$sizeNum=strlen($monnaie);

	$nbPoints=($sizeNum%3==0)?(int)($sizeNum/3)-1:(int)($sizeNum/3);

 	for ($i = 1; $i <= $nbPoints; $i++) 
 		$monnaie=substr($monnaie,0,$sizeNum-3*$i).','.substr($monnaie,$sizeNum-3*$i,4*$i-1);

return $monnaie.'.00 DA';

}

// util : gestion dates

function plus_mois($date,$nba,$nbm) {
	// $parts=explode('/', $date);
	// echo "2".$date;
	// $a=$parts[0];		$m=$parts[1]; 		$j=$parts[2];
	// $a=$a+$nba;

	// if($nbm+$m>12) { $m=($nbm+$m)-12; $a++; } else { $m=$nbm+$m; }

	// switch ($j) {
	// 	case 29: if($m==2 && $a%4!=0) { $j=1; $m=3; } break;
	// 	case 30: if($m==2) { $j=1; $m=3; } break;
	// 	case 31: if($m==2) { $j=1; $m=3;} else if($m==4 || $m==6 || $m==9 || $m==11) $j=30;	break;
	// }
	// // echo $a.'-'.$m.'-'.$j;
// echo "j".$date_fin;
$myDateTime = DateTime::createFromFormat('d/m/Y', $date);
$newDateString = $myDateTime->format('d-m-Y');
$nombre_mois=$nba*12+$nbm;
$resultat=date('d/m/Y',strtotime($newDateString." +$nombre_mois months"));
return $resultat;
	// return (new DateTime($a.'-'.$m.'-'.$j))->format('Y-m-d');
}

function convert_date($date,$format) {

		if($format=='toSqlFormat') { $format='Y-m-d'; $x=2; $y=0; $separateur='/'; } 
		elseif($format=='toOrdFormat') { $format='d/m/Y'; $x=0; $y=2; $separateur='-'; }
		else { $format='Y-m-d'; $x=0; $y=2; $separateur='-'; }

		$parts=explode($separateur,$date);
		// if(count($parts)==3) $date=(new DateTime($parts[$x].$separateur.$parts[1].$separateur.$parts[$y]))->format('Y-m-d');
		
		// return $date;

}

function get_dates($idLocal,$idLocataire) {
	global $bdd;
	$get_dates=array();
	if($get_dates=$bdd->get_results("SELECT date_debut,date_fin FROM contrats WHERE local='$idLocal' AND locataire='$idLocataire'")) {
		foreach ($get_dates as $date) { $dates_debuts[]=$date->date_debut; $dates_fins[]=$date->date_fin; }
		sort($dates_debuts);		
		sort($dates_fins);
		for ($i=0,$n=count($dates_debuts); $i <$n ; $i++) { 
			$dates_debuts[$i]=convert_date($dates_debuts[$i],'');
			$dates_fins[$i]=convert_date($dates_fins[$i],'');
		}
		$dates['dates_debuts']=$dates_debuts;
		$dates['dates_fins']=$dates_fins;
		return $dates;
	}
	return null;
}

function dates_libres($dates) {
	if(count($dates)==0) return null;
	$i=0;  $n=count($dates['dates_debuts']);
	$dates_libres=array(); 
	$date['date_debut']='avant le';		
	$date['date_fin']=$dates['dates_debuts'][0];
	array_push($dates_libres, $date);
	// var_dump($dates['dates_fins']);
	$i=0;
		if(plus_mois($dates['dates_fins'][$i],0,1)<=$dates['dates_debuts'][$i+1]) {
			$date['date_debut']=$dates['dates_fins'][$i]; 
			$date['date_fin']=$dates['dates_debuts'][$i+1];
			array_push($dates_libres, $date);  
		} 

	$date['date_debut']='a partir du';		$date['date_fin']=$dates['dates_fins'][$n-1];
	array_push($dates_libres, $date);
	
    return $dates_libres;

}

function comparerTemp($x,$y) {
	// if($x==$y) $o='='; elseif($x>$y) $o='>'; else $o='<';
	// echo $x.$o.$y.'<br>';
}

// util : requetes locaux

function get_local($idLocal) { 
	global $bdd; 
	return $bdd->get_row("SELECT libelle,longueur,largeur,surface FROM locaux WHERE id='$idLocal'"); 
}

function get_locataire($idLocataire) { 
	global $bdd; 
	return $bdd->get_row("SELECT nom,rcn,mat_fiscal FROM locataires WHERE id='$idLocataire'"); 
}

	$liste_pages = (object)array(
		"plan","locaux","locataires","contrats"
		);

define("MESSAGE_LEGENDE_JAUNE", "locaux dont le contrat expire dans moins de 14 jours");
define("MESSAGE_LEGENDE_ROUGE", "locaux dont le contrat expire dans moins de 7 jours");
define("MESSAGE_LEGENDE_VERT", "locaux dont le contrat est en cour");
define("MESSAGE_LEGENDE_BLEU", "locaux sans contrats");
define("MESSAGE_INFOS_RESERVES", "nombre de locaux avec contrat en cour dans l'etage");
define("MESSAGE_INFOS_NON_RESERVES", "nombre de locaux sans contrat dans l'etage");
define("MESSAGE_INFOS_TOTAL", "nombre total des locaux dans l'etage");
define("MESSAGE_ETAGE_RDC", "selectionner le rez-de-chaussée");
define("MESSAGE_ETAGE_1", "selectionner l'etage 1");
define("MESSAGE_ETAGE_2", "selectionner l'etage 2");
define("MESSAGE_ETAGE_3", "selectionner l'etage 3");
define("MESSAGE_BOUTON_ZOOM", "zoomer le plan");
define("MESSAGE_BOUTON_DEZOOM", "dézoomer le plan");
define("MESSAGE_BOUTON_NOUVEAU_LOCAL", "ajouter un nouveau local");
define("MESSAGE_PLAN_INFOS_LOCAL", "afficher/modifier les informations de ce local");
define("MESSAGE_PLAN_ESCALIER", "escalier");
define("MESSAGE_PLAN_VIDE", "espace vide");
define("MESSAGE_BOUTON_FERMER", "fermer");
define("MESSAGE_BOUTON_MODIFIER_INFOS_LOCAL", "modifier les informations de ce local");

define("MESSAGE_BOUTON_ORDRE", "cliquez ici pour trier les lignes selon ce champ, cliquez de nouveau pour changer de direction");
define("MESSAGE_BOUTON_AJOUTER_LOCAL", "ajouter un document a ce local");
define("MESSAGE_BOUTON_LISTE_LOCAL", "afficher les informations et documents de ce local");

define("MESSAGE_BOUTON_AJOUTER_LOCATAIRE", "ajouter un nouveau locataire");
define("MESSAGE_BOUTON_SUPPRIMER_LOCATAIRE", "supprimer ce locataire");

define("MESSAGE_BOUTON_AJOUTER_CONTRAT", "ajouter un nouveau contrat");
define("MESSAGE_BOUTON_SUPPRIMER_CONTRAT", "supprimer ce contrat");

define("MESSAGE_PARAMETRES", "parametres");

define("MESSAGE_PAGINATION_PREMIER", "aller vers la premiere page du tableau");
define("MESSAGE_PAGINATION_DERNIER", "aller vers la derniere page du tableau");
define("MESSAGE_PAGINATION_PAGE", "aller vers cette page du tableau");
?>
