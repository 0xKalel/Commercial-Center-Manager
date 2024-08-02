	<?php
	
	$reference="php/";
	include("config.php");
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<head>	
		<title>facture Proforma</title>
		<meta charset="ANSI">
		<meta http-equiv="Content-Type" content="ANSI" />
		<meta name="author" content="mondersky" />
		<link   type="text/css" href="css/facture.css" rel="stylesheet">
		<link  media="print"  type="text/css" href="css/facture_impression.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery-2.1.0.js"></script>
		<script type="text/javascript" src="js/moment.js"></script>
	</head> <body>
	<div id="entet">
		<div style="float:left; width: 450px;"id="cordoner" >
			<h3 >SARAI ANNABA</h3>
			<br style="margin-top: 25px;">Avenue de l'ALN,rue ABDAOUI Mouloud local n°07 , Annaba<br>
			<b>Tel:</b>+213(0)38433454
			<BR><b>Tel/Fax:</b>+213(0)38442782
			</div>
			<?php $id= $_GET["id"];
			$contrat=$bdd->get_row("SELECT *
				FROM proforma 
				WHERE id =$id  ");
			?>
			<DIV  style="width: 200px;float:right;" id="fast">
				<h1><img src="elements/logo_noir.png" alt="" id="logo"/></h1>
				<div class="client" style="margin-top: 100px;">
					<?php echo $contrat->locataire;?>
					<br />
					le <?php echo $contrat->date;?>
				</div>
			</div>
		</div>
		<div style="padding-top: 150px;">
			<div class="conteneur">
				<br><div id="entet">
			</div>
			<div id="affichage1">
				<div id="orange"><H1 id="titre">Facture proforma</h1></div>
				<table  style="background:white;width: 900px;margin-left: 50px;"id="feuille">
					<tr>
						<td class="labeltd">
							<label><b>Designation :</b></label>
						</td>
						<td>
							<label >location de bureaux 1 mois</label>
						</td>
					</tr>
					<tr>
						<td class="labeltd">
							<label><b>Qte : </b> </label>
						</td>
						<td ><span id="cible_date"></span></td>
					</tr>
					<tr>
						<td class="labeltd">
							<label><b>Prix Unit : </b> </label>
						</td>
						<td ><span id="prix_unit"></span></td>
					</tr>
					<tr>
						<td class="labeltd">
							<label><b>T.V.A : </b> </label>
						</td>
						<td >19%</td>
					</tr>
					<tr>
						<td class="labeltd">
							<label><b>Montant H.T : </b> </label>
						</td>
						<td ><?php echo $contrat->montant;?></td>
					</tr>
					<tr>
						<td class="labeltd">
							<label><b>Montant T.T.C : </b> </label>
						</td>
						<td ><?php echo $contrat->montant+$contrat->montant*0.19;?></td>
					</tr>
				</table>
				<br />
				<center> <button onclick="window.print()" class="button_orange" >imprimer</button></center>
				<br />
			</div>
		</div>
	</div>
	<script>
	var a = moment("<?php echo $contrat->date_debut;?>");
	var b = moment("<?php echo $contrat->date_fin;?>");
	difference=b.diff(a,"months")
	$("#cible_date").html(difference);
	$("#prix_unit").html(<?php echo $contrat->montant;?>/difference)
	</script>
</body>
</html>