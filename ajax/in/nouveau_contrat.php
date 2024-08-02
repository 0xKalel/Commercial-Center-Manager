<?php
session_start();
$reference="../../php/";
include("../../config.php");
$valid_formats=array("jpg", "png", "gif", "bmp","jpeg");
$path="../../elements/contrats/";
$path2="elements/slider/";
foreach($_POST as $key=>$value) { $$key=$value; }
// var_dump($_POST);
$nblocaux=count($libelle);
$datedebut=$_POST["datedebut"];
$date_contrat=$_POST["date"][0];
function localDisponible($idLocal,$idLocataire,$datedebut,$datefin) {
// var_dump(get_dates($idLocal,$idLocataire));
	$dates_libres=dates_libres(get_dates($idLocal,$idLocataire));
	$n=count($dates_libres);

	if($n==0 || $datefin<=$dates_libres[0]['date_fin'] || $datedebut>=$dates_libres[$n-1]['date_fin'])  { return true; }
	else {
		$i=1;	 
		while($i<$n-1 && ($datedebut<$dates_libres[$i]['date_debut'] || $datefin>$dates_libres[$i]['date_fin'] )) $i++;
		return $i<$n-1;
	}
	
}

function insertion($libelle,$nom,$date,$date_debut,$date_fin,$montant,$autre_declaration) {
	global $bdd;
	global $date_contrat;
	$dateInput = explode('/',$date_debut);
	$date_debut = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
	$dateInput = explode('/',$date_fin);
	$date_fin = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
	if($bdd->query(
		   "INSERT INTO contrats(local,locataire,date_debut,date_fin,montant,autre_declaration,date) VALUES ('$libelle','$nom','$date_debut','$date_fin','$montant','$autre_declaration','$date_contrat')"
	    )
	)
		echo "reussi";
	else
		echo "non reussi";
}

$resultats['locaux']['disponibles']=array();
$resultats['locaux']['factures']=array();
$resultats['locaux']['non disponibles']=array();

$i=0;

	// echo "date_fin".$datedebut[$i]."kk";
	$datefin=plus_mois($datedebut[$i],$nb_annees[$i],$nb_mois[$i]);
	$local=get_local($libelle[$i]);

	// if(localDisponible($libelle[$i],$nom,$datedebut[$i],$datefin)) {

		$facture['Designation']=$local->libelle;   

		$facture['surface']='('.$local->longueur.'m X '.$local->largeur.'m) '.$local->surface.'m<sup>2</sup>';

		$facture['Qte']=$nb_annees[$i]*12+$nb_mois[$i];
		$facture['Prix Unit']=$montant[$i];
		$facture['T.V.A']=17;
		$facture['MONT.H.T']=$facture['Qte']*$facture['Prix Unit'];
		$facture['MONT.T.T.C']=(int)(($facture['T.V.A']*$facture['MONT.H.T'])/100)+$facture['MONT.H.T'];

		$facture['Prix Unit']=format_monetaire($facture['Prix Unit']);
		$facture['MONT.H.T']=format_monetaire($facture['MONT.H.T']);
		$facture['MONT.T.T.C']=format_monetaire($facture['MONT.T.T.C']);

		array_push($resultats['locaux']['factures'],$facture);

		array_push($resultats['locaux']['disponibles'],$local);
		if($type_facture=='facture')
			insertion($libelle[$i],$nom,$date[$i],$datedebut[$i],$datefin,$montant[$i],$autre_declaration[$i]);
	else array_push($resultats['locaux']['non disponibles'],$local);
	
?>