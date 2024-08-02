	<?php
	
	$reference="php/";
	include("config.php");
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<head>	
		<title>facture <?php echo $_GET["id"] ?></title>
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
				FROM contrats 
				WHERE id =$id  ");
			$nom=$bdd->get_var("SELECT nom FROM locataires WHERE id=".$contrat->locataire." ");
			?>
			<DIV  style="width: 200px;float:right;" id="fast">
				<h1><img src="elements/logo_noir.png" alt="" id="logo"/></h1>
				<div class="client" style="margin-top: 100px;">
					<?php echo $nom;?>
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
				<div id="orange"><H1 id="titre">Facture N°<?php echo $contrat->id; ?></h1></div>
				<table  style="background:white;width: 900px;margin-left: 50px;"id="feuille">
					<tr>
						<td class="labeltd">
							<label><b>Designation :</b></label>
						</td>
						<td>
							<label >location de local 1 mois</label>
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
						<td ><?php echo format_monetaire($contrat->montant); ?></td>
					</tr>
					<tr>
						<td class="labeltd">
							<label><b>Montant T.T.C : </b> </label>
						</td>
						<td ><?php echo format_monetaire($contrat->montant+$contrat->montant*0.19);?></td>
					</tr>
				</table>
				<br />
				<center> <button onclick="window.print()" class="button_orange" >imprimer</button></center>
				<br />
			</div>
		</div>
	</div>
	<script>
	function format_monetaire(monnaie) {
		// exp=/^[0-9]*$/;
		// if(exp.exec(monnaie)) return false;
		// if(monnaie.match("/^[0-9]*$/")) return false;
		// if(!preg_match('/^[0-9]*$/', $monnaie)) return false;
		sizeNum=monnaie.length;

		nbPoints=(sizeNum%3==0)?parseInt(sizeNum/3)-1:parseInt(sizeNum/3);
		console.log(nbPoints);
		for (i = 1; i <= nbPoints; i++) 
			monnaie=substr(monnaie,0,sizeNum-3*i)+','+substr(monnaie,sizeNum-3*i,4*i-1);

		return monnaie+'.00 DA';

	}
	var a = moment("<?php echo $contrat->date_debut;?>");
	var b = moment("<?php echo $contrat->date_fin;?>");
	difference=b.diff(a,"months")
	$("#cible_date").html(difference);
	$("#prix_unit").html(format_monetaire(<?php echo $contrat->montant;?>/difference))
	</script>
</body>
</html>