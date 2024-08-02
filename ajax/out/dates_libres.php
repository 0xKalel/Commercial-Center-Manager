<?php
session_start();
$reference="../../php/";
include("../../config.php");


$idLocal=$_POST['idLocal'];
$idLocataire=$_POST['idLocataire'];

$dates_libres=dates_libres(get_dates($idLocal,$idLocataire));

for ($i=0,$n=count($dates_libres); $i <$n ; $i++) {
	$dates_libres[$i]['date_debut']=convert_date($dates_libres[$i]['date_debut'],'toOrdFormat');
	$dates_libres[$i]['date_fin']=convert_date($dates_libres[$i]['date_fin'],'toOrdFormat');
}

$resultats['local']=get_local($idLocal)->libelle;
$resultats['dates_libres']=$dates_libres;
echo json_encode($resultats) ;


























//echo $type_facture.'<br>'.$nom.'<br>'.$libelle.'<br>'.$date.'<br>'.$datedebut.'<br>'.$annees.'<br>'.$mois.'<br>'.$montant.'<br>'.$autre_declaration;

// function convert_date($dates) {
// 	if(is_array($dates)) for ($i=0; $i < count($dates) ; $i++) $dates[$i]=date('Y-m-d', strtotime($dates[$i]));
// 	else $dates=date('Y-m-d', strtotime($dates));
// 	return $dates;
// }

// function dates_libres($dates_debuts,$dates_fins) {
// 	$dates_debuts=convert_date($dates_debuts);
// 	$dates_fins=convert_date($dates_fins);
// 	$i=0;  $n=count($dates_debuts);
	
// 	$dates_libres=array();
	
// 	for ($i=0; $i < $n ; $i++) {
// 		$dates=array();
// 		if($i==$n-1) { $dates[0]=$dates_fins[$n-1]; $dates[1]='infinity';  }
// 		else if($dates_fins[$i]<$dates_debuts[$i+1]) { $dates[0]=$dates_fins[$i]; $dates[1]=$dates_debuts[$i+1];  } 
// 		if(count($dates)>0) array_push($dates_libres, $dates);
// 	}
// 	return $dates_libres;
// }

// function date_disponible($dd,$df,$dates_libres) {
// 	$i=0;	$n=count($dates_libres);
// 	if($dates_libres[$n-1][1]=='infinity') $dates_libres[$n-1][1]=$df; 
// 	while($i<$n && !($dd>=$dates_libres[$i][0] && $df<=$dates_libres[$i][1] )) $i++;
// 	return $i<$n; 
// }

// function plus_mois($date,$nba,$nbm) {
// 	$parts=explode('-', $date);
// 	$a=$parts[0];		$m=$parts[1]; 		$j=$parts[2];
// 	$a=$a+$nba;
// 	if($nbm+$m>12) { $m=($nbm+$m)-12; $a++; } else { $m=$nbm+$m; }
// 	$new_date=$a.'-'.$m.'-'.$j;
// 	return $new_date;
// }

// function insertion($libelle,$nom,$date,$date_debut,$date_fin,$montant,$autre_declaration) {
// 	global $bdd;
// 	if($bdd->query(
// 		   "INSERT INTO contrats VALUES ('','$libelle','$nom','$date','$date_debut','$date_fin','$montant','$autre_declaration')"
// 		)
// 	)
// 	return 'requete reussie';
// 	else return 'requete invalide';
// }

// function date_existante($date_debut,$date_fin,$libelle) {
// 	global $bdd;
// 	$exist=$bdd->get_results("SELECT date_debut,date_fin FROM contrats WHERE local='$libelle' AND date_debut='$date_debut' AND date_fin='$date_fin'");
// 	return count($exist)>0;
// }

// if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
		
// 	$parts=explode('/', $date); 		$date =convert_date("$parts[2]-$parts[1]-$parts[0]");
// 	$parts=explode('/', $datedebut);    $date_debut =convert_date("$parts[2]-$parts[1]-$parts[0]");

// 	if($nb_annees=='') $nb_annees=0; 	if($nb_mois=='') $nb_mois=0;

// 	$date_fin=convert_date(plus_mois($date_debut,$nb_annees,$nb_mois));
	
// 	if($type_facture=='facture' && !date_existante($date_debut,$date_fin,$libelle) ) {

// 		$dates=$bdd->get_results("SELECT date_debut,date_fin FROM contrats WHERE id='$libelle'");

// 		if(count($dates)>0) {
// 			foreach ($dates as $d) {
// 				$dates_debuts[]=$d->date_debut;
// 				$dates_fins[]=$d->date_fin;
// 			}

// 			sort($dates_debuts);		sort($dates_fins);
// 			var_dump($dates_debuts); 	
// 			var_dump($dates_fins);

// 			$dates_libres=dates_libres($dates_debuts,$dates_fins);

// 			var_dump($dates_libres);
// 			if(date_disponible($date_debut,$date_fin,$dates_libres)) echo insertion($libelle,$nom,$date,$date_debut,$date_fin,$montant,$autre_declaration) ;
// 			else echo 'non dispo';			
// 		}
// 		else echo insertion($libelle,$nom,$date,$date_debut,$date_fin,$montant,$autre_declaration) ; 
	
// 	}
	
// }


?>




