<?php 
include("php/detection_session.php");
include("config.php");
$cle_actuelle="contrats";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<title>Contrats</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="mondersky" />
	<link rel="stylesheet" href="css/design.css" type="text/css"/>
	<link href="js/date_piker/css/ui-darkness/jquery-ui-1.10.4.custom.css" rel="stylesheet"/>
	<link href="js/date_piker/css/ui-darkness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>
	<style id="test"></style>
	<script type="text/javascript"src="js/jquery-2.1.0.js"></script>
	<script type="text/javascript" src="js/date_piker/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/date_piker/js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="js/date_piker/js/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="js/date_fr.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/messages_fr.js"></script>
	<script type = "text/javascript"src="js/jquery.form.js"></script>
	<script type = "text/javascript"src="js/responsiveslides.js"></script>
	<script src="js/loader.js" type="text/javascript"></script>
	<script src="js/jquery.PrintArea.js"></script>
	<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/demo.css">
	<link rel="stylesheet" href="css/responsiveslides.css">
	<script>
	$(document).ready(function() {
//				$("#envoi").click(jax);
$( ".date" ).datepicker();
$( ".datedebut,.datefac" ).datepicker();

$("#form_contrats").validate({
	rules :{
		"nb_annees[]":{
			"required":true,
		},
		"nb_mois[]":{
			"required":true,
		},
		"nom" :{
			"required" :true,
		},
		"libelle[]" :{
			"required" :true,
		},
		"date[]" :{
			"required" :true,
		},
		"datedebut[]" :{
			"required" :true,
		},
				        // "datefin" :{
				        //   "required" :true,
				        // },
				        "montant[]" :{
				        	"required" :true,
				        },
				    },
				});


selection_locataires();

});
	</script>

	<script type="text/javascript" src="js/liste_options.js"></script>
</head>

<body>
	<div id="conteneur">
		<div id="repense" style="display:none;"> 
			<h3></h3>
		</div>

		<div class="main">
			<?php 
			include("php/entete.php");
			include("php/liste_options.php");
			?>		
			<div class="conteneur petit">

				<form action="" method="post" id="form_supp_contrats">
					<div class="options">
						<button class="btt" id="ajouter_contrat" type="button">Ajouter</button>
						<button class="btt" id="facture_proforma" type="button">Facture proforma</button>
						<!-- <input type="submit" class="btt" id="supprimer_contrat" name="supprimer_contrat" value="Supprimer"/> -->
						<span class="res" style="display: none;">

						</span>
					</div>
				</form>
			</div>

			<div method="post" id ="locataires">
				<?PHP include("php/list_contrats.php"); ?> 
			</div>
		</div>
	</div>
	<div class="black_background" id="black_background_ajouter_contrat" style="display: none;">
		<div id="lightbox_container" >
			<div class="lightbox" id="lightbox_contrat" style='width:800px'>

				<form method="post" id="form_contrats" enctype="multipart/form-data" action="ajax/in/nouveau_contrat.php">
					<img src="elements/close_button.png" class="close_button" alt="" />

					<div id='partie-fixe'>	
						<h2 class="titre">Nouveau contrat</h2>
						<br />
						<br />
						<select style="display:none" class="selection selection2 type_facture" name="type_facture" id="type_facture">
							<option default> facture </option>
						</select>
						<div class="conteneur_contrats_client">
							<label for="nom" id="label_client">client</label>
							<select class="selection selection2 nom" name="nom" id="nom" style="margin-left: 10px;"> </select>
						</div>
						<div class="conteneur_contrats_local">
							<label for="libelle" id="label_local">local</label>
							<select class='selection selection2 libelle selection_locaux' name='libelle[]' style="margin-left: 10px;"> </select>
						</div>
					</div>

					<div id="partie-non-fixe">
						<div class='infos_contrat'>
							<div class="conteneur_champs">
								<label for="date[]" class="label">Date facture</label>
								<input class='inpt inpt2 datefac reint_manuelle' type='text' placeholder='Date' name='date[]' size='40' autocomplete='off' />
							</div>
							<div class="conteneur_champs">
								<label for="datedebut[]" class="label">Date début</label>
								<input class='inpt inpt2 datedebut reint_manuelle' type='text' placeholder='Date début' name='datedebut[]' size='40' autocomplete='off' />
							</div>
							<label for="nb_mois[]" class="label">années</label>
							<div class='inpt-incr-annee champs_controles'>
								<input type='text' autocomplete='off' name='nb_annees[]' placeholder='A' class='inpt inpt2 annees' maxlength='20' style='' value="1">
								<div style='width: 20px; height:35px; '>
									<input type='button' class='plus-annees' style='position:absolute; right:0px; top: 1px; width:20px; height:17px; line-height:10px; color:black;' value='+'>
									<input type="button" class='moins-annees' style='position:absolute;right:0px; bottom:0;width:20px; height:17px; line-height:10px;color:black' value='-'>	
								</div>
							</div>
							<label for="nb_mois[]" class="label">mois</label>
							<div class='inpt-incr-mois champs_controles'>
								<input type='text' autocomplete='off' name='nb_mois[]' placeholder='M'  class='inpt inpt2 mois' maxlength='20' style='' value="0">
								<div style='width: 20px; height:35px; '>
									<input type='button' class='plus-mois' style='position:absolute; right:0px; top: 1px; width:20px; height:17px; line-height:10px; color:black;' value='+'>
									<input type='button' class='moins-mois' style='position:absolute;right:0px; bottom:0;width:20px; height:17px; line-height:10px;color:black' value='-'>	
								</div>
							</div>
							<br />
							<br />

							<div>
								<label for="montant[]" class="label">Montant</label>
								<input style="margin-right: 50px;" class='inpt inpt2 montant' type='text' placeholder='Montant (DA/Mois)' name='montant[]' size='40' autocomplete='off' />
								<label for="autre_declaration[]" class="label">Frais suplémentaires</label>
								<input class='inpt inpt2 autre-declaration' type='text' placeholder='Autre déclaration (DA/Mois)' name='autre_declaration[]' size='40' autocomplete='off' />		
							</div>
							<!-- <div class='num'> 1 </div>	 -->
							<!-- <img class='plus-infos' src='elements/infos-icones.png'>						 -->
							<!-- <input id='plus'  class="btt btt2" type='button'  value="Plus"/> -->
							<!-- <input id='moins' class="btt btt2" type='button'  value="Moins" disabled/> -->
						</div>
						<div class="conteneur_valider">
							<input id="envoi" class="btt btt2" type="submit"  value="Valider" />
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
	<div class="black_background" id="black_background_facture_proforma" style="display: none;">
		<div id="lightbox_container" >
			<div class="lightbox" id="lightbox_contrat" style='width:800px'>

				<form method="post" id="form_contrats" enctype="multipart/form-data" action="ajax/in/nouveau_proforma.php" class="form_proforma">
					<img src="elements/close_button.png" class="close_button" alt="" />

					<div id='partie-fixe'>	
						<h2 class="titre">Facture proforma</h2>
						<br />
						<br />
						<select style="display:none" class="selection selection2 type_facture" name="type_facture" id="type_facture">
							<option default> facture </option>
						</select>
						<div class="conteneur_contrats_client">
							<label for="nom" id="label_client">client</label>
							<input type="text" class="inpt inpt2" name="nom" id="nom" style="margin-left: 10px;width: 200px;" placeholder="nom du client"/>
						</div>
						<div class="conteneur_contrats_local">
							<label for="libelle" id="label_local">local</label>
							<select class='selection selection2 libelle selection_locaux' name='libelle[]' style="margin-left: 10px;"> </select>
						</div>
					</div>

					<div id="partie-non-fixe">
						<div class='infos_contrat'>
							<div class="conteneur_champs">
								<label for="date[]" class="label">Date facture</label>
								<input class='inpt inpt2 date reint_manuelle' type='date' placeholder='Date' name='date[]' size='40' autocomplete='off' />
							</div>
							<div class="conteneur_champs">
								<label for="datedebut[]" class="label">Date début</label>
								<input class='inpt inpt2 datedebut reint_manuelle' type='date' placeholder='Date début' name='datedebut[]' size='40' autocomplete='off' />
							</div>
							<label for="nb_mois[]" class="label">années</label>
							<div class='inpt-incr-annee champs_controles'>
								<input type='text' autocomplete='off' name='nb_annees[]' placeholder='A' class='inpt inpt2 annees' maxlength='20' style='' value="1">
								<div style='width: 20px; height:35px; '>
									<input type='button' class='plus-annees' style='position:absolute; right:0px; top: 1px; width:20px; height:17px; line-height:10px; color:black;' value='+'>
									<input type="button" class='moins-annees' style='position:absolute;right:0px; bottom:0;width:20px; height:17px; line-height:10px;color:black' value='-'>	
								</div>
							</div>
							<label for="nb_mois[]" class="label">mois</label>
							<div class='inpt-incr-mois champs_controles'>
								<input type='text' autocomplete='off' name='nb_mois[]' placeholder='M'  class='inpt inpt2 mois' maxlength='20' style='' value="0">
								<div style='width: 20px; height:35px; '>
									<input type='button' class='plus-mois' style='position:absolute; right:0px; top: 1px; width:20px; height:17px; line-height:10px; color:black;' value='+'>
									<input type='button' class='moins-mois' style='position:absolute;right:0px; bottom:0;width:20px; height:17px; line-height:10px;color:black' value='-'>	
								</div>
							</div>
							<br />
							<br />

							<div>
								<label for="montant[]" class="label">Montant</label>
								<input style="margin-right: 50px;" class='inpt inpt2 montant' type='text' placeholder='Montant (DA/Mois)' name='montant[]' size='40' autocomplete='off' />
								<label for="autre_declaration[]" class="label">Frais suplémentaires</label>
								<input class='inpt inpt2 autre-declaration' type='text' placeholder='Autre déclaration (DA/Mois)' name='autre_declaration[]' size='40' autocomplete='off' />		
							</div>
							<!-- <div class='num'> 1 </div>	 -->
							<!-- <img class='plus-infos' src='elements/infos-icones.png'>						 -->
							<!-- <input id='plus'  class="btt btt2" type='button'  value="Plus"/> -->
							<!-- <input id='moins' class="btt btt2" type='button'  value="Moins" disabled/> -->
						</div>
						<div class="conteneur_valider">
							<input id="creer_proforma" class="btt btt2" type="submit"  value="Créer" />
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
	<div class="black_background" id="black_background_detaille_contrat" style="display: none;">
		<div id="lightbox_container">
			<div class="lightbox" id="lightbox_detaille_contrat">
				<img src="elements/close_button.png" class="close_button" alt="" />
				<div id="delta">
					<div class="callbacks_container" id="slider">
						<ul class="rslides" id="slider4">

						</ul>
					</div>	
				</div>
				<div id="delta2">
					<center>
						<table>
							<tbody>

							</tbody>
						</table>
					</center>
				</div>
			</div>
		</div>
	</div>
	<div class="black_background" id="black_background_ajouter_fichier" style="display: none;">
		<div id="lightbox_container" >
			<div class="fenetre" id="lightbox_contrat" style='width:450px'>
				<img src="elements/close_button.png" class="close_button" alt="" />
				<center>
					<form method="post" id="form_document"  enctype="multipart/form-data" action="ajax/in/nouveau_fichier_contrat.php">
						<h3 style="text-align: center;">fichier</h3>
						<h4 class="rouge"></h4>
						<input type="hidden" name="contrat" />
						<table class="tbl" id="frm_document"> 
							<tr>
								<td><input class="inpt" id="document_image" type="file" name="document_image[]" style="width:310px" /></td>
							</tr>
						</table>
						<center><input class="btt2" type="submit" value="OK"/></center>
					</form>
				</center>
			</div>
		</div>
	</div>
	<?PHP 
	include("php/modifier_cpt.php");
	$option="options_supplementaires";
	include("php/options_admin.php"); 
	?>

	<script type="text/javascript">
	var Image_actuelle=0;
	$("#form_document").ajaxForm({
		beforeSubmit: function () {
			afficher_loader()
			return $("#form_document").valid();
		},
		success:function(result){
			if (result=="reussi"){
				charger_locaux(Sort,Ordre,Filtre,Page);
				cacher_lightbox();
			}else{
				alert(result)
			}
			cacher_loader()
		}
	});
	function cacher_lightbox(){
		$('.black_background').fadeOut(500);
		$('#form_document')[0].reset();
	};

	$('#tableau_contrats').delegate(".imprimante","click",function(){
		facture_objet=$(this);
		window.open('facture?id=' + $(facture_objet).parent().parent().attr("id"));
	});
	$('#tableau_contrats').delegate(".plus","click",function(){
		facture_objet=$(this);
		$('#black_background_ajouter_fichier').css("display","");
		$('#black_background_ajouter_fichier').find("[name=contrat]").val($(facture_objet).parent().parent().attr("id"));
		// $('#black_background_ajouter_fichier .titre').html($('.black_background').find("[name=contrat] [value="+$(facture_objet).parent().parent().attr("id")+"]").html());
	});
	function selection_locataires(){
		var param={sort:'0',ordre:'0',filtre:'0',page : '0'};
		$.post("ajax/out/charger_locataires.php",param,function(resultat){
			var resultat=jQuery.parseJSON(resultat);
			var locataires="";
			for(var i=0;i<resultat.length;i++)
			{
				locataires+="<option value='"+resultat[i].id+"'>"+resultat[i].nom+"</option>"; 
			}

			$("select#nom").html(locataires);
		})
	};

	function selection_locaux(libelle){

		var param={sort:'0',ordre:'0',filtre:'0',page : '0'};
		$.post("ajax/out/charger_locaux.php",param,function(resultat){
			var resultat=jQuery.parseJSON(resultat);
			var locaux="";
			for(var i=0;i<resultat.length;i++)
			{
				locaux+="<option value='"+resultat[i].id+"'>"+resultat[i].libelle+"</option>";
			}
			console.log($(".selection_locaux").length);
			$(".selection_locaux").html(locaux);
		})
	};

	$('.close_button').click(function(){
		cacher_lightbox();
	});

	$('#ajouter_contrat').click(function(){
		$('#black_background_ajouter_contrat').css("display","");
		//		allLocaux=getAllLocaux();
	});
	$('#facture_proforma').click(function(){
		$('#black_background_facture_proforma').css("display","");
		//		allLocaux=getAllLocaux();
	});


// $("#tableau_contrats tbody").delegate(".plus", "click", function() {
// 	affichier_contrat($(this).parent().parent().attr("id"));
// });
var D=true, Id=0;

// $("#tableau_contrats tbody ").click(

// 	jQuery.fn.multiselect = function() {

// 		$(this).each(function() {
// 			var checkboxes = $(this).find("input:checkbox");
// 			checkboxes.each(function() {
// 				var checkbox = $(this);
// 			            // Highlight pre-selected checkboxes
// 			            if (checkbox.prop("checked"))
// 			            	(checkbox.parent()).parent().css("background-color","red");
// 			                // checkbox.parent().addClass("multiselect-on");

// 			            // Highlight checkboxes that the user selects
// 			            checkbox.click(function() {
// 			            	D=false;
// 			            	if (checkbox.prop("checked"))
// 			            		(checkbox.parent()).parent().css("background-color","red");
// 			                    // checkbox.parent().addClass("multiselect-on");

// 			                    else
// 			                    	(checkbox.parent()).parent().css("background-color","");
// 			                    //checkbox.parent().removeClass("multiselect-on");
// 			                });
// 			        });
// 			if(D==true){
// 			        	//détaille_contrat();
// 			        	$('#black_background_detaille_contrat').css("display","");
// 			        }
// 			        D=true;
// 			    });
// });

// $("#form_supp_contrats").validate({
// 	rules :{
// 	},

// 	submitHandler: function(){
// 		$.post("ajax/in/supprimer_contrats.php", $("#form_supp_contrats").serialize(), function(resultat){
// 			cacher_lightbox();
// 			if (resultat == 1){
// 				$("#repense h3").html("Contrats supprimés!");
// 				$("#repense").css("background-color","green");
// 				Sort="id";Ordre="DESC";Filtre;Page=1;
// 				charger_locaux(Sort,Ordre,Filtre,Page,function(){
// 				})
// 			}else{
// 				$("#repense h3").html("Contrats non supprimés!");
// 				$("#repense").css("background-color","red");
// 			}
// 			$("#repense").css("display","block");
// 			setTimeout(function(){$("#repense").fadeOut(2000);},3000);
// 		})
// 	}
// });
$("#tableau_contrats").delegate(".supprimer","click",function(){ 
	if (confirm("Etes vous sure de vouloir supprimer ce contrat?")) { 
		afficher_loader()
		supp=[];
		supp[0]=$(this).parent().parent().attr("id");
		var param={supp:supp};
		$.post("ajax/in/supprimer_contrats.php",param,function(result){
			var result = jQuery.parseJSON(result);
			if(result==1)
				charger_locaux(Sort,Ordre,Filtre,Page);
			else
				alert(result)
			cacher_loader()
		})
	}
})
$(".document_image").click(function(){
	Image_actuelle=$(this).index(".document_image")
	$('#black_background_documents').css("display","");
	$("#slider_image2").parent().toggleClass("callbacks1_on");
	$("#slider_image2").parent().toggleClass("premier");

});


</script>




<script type="text/javascript">

// utils
function fermer_ajout_contrat(){
	$("#form_contrats .close_button").click()
	setTimeout(function(){
		$("#form_contrats")[0].reset();
		$("#form_contrats .reint_manuelle").val(today())
	},500)
	
}
function soumettreFormContrats() {
	$('#form_contrats').on('submit', function(e) {
		e.preventDefault();
		if( $("#form_contrats").valid()){
			afficher_loader()
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serialize(),
				success: function(resultats) { 
					console.log(resultats);
					if(resultats=="reussi"){
						fermer_ajout_contrat()
					}
					else{
						alert("erreur");
					}
					// var dl=resultats['locaux']['disponibles'].length,
					// ndl=resultats['locaux']['non disponibles'].length,
				// 	msg='';

				// 	if(dl>0) {
				// 		msg='contrats crees avec succes pour : \n\n';
				// 		for (var i = 0; i < dl; i++) msg+='\t'+'-   '+resultats['locaux']['disponibles'][i].libelle+'\n';
				// 	}
				// else msg='aucun contrat cree .';

				// if(ndl>0) {
				// 	msg+='\n\nlocaux non disponibles : \n\n';
				// 	for (var i = 0; i < ndl; i++) msg+='\t'+'-   '+resultats['locaux']['non disponibles'][i].libelle+'\n';
				// }
			// genererFacture(resultats['locaux']['factures']);
			cacher_loader()
			charger_locaux(Sort,Ordre,Filtre,Page)
		}
	});
		}

	});
}
function soumettreFormProforma() {
	$('.form_proforma').on('submit', function(e) {
		e.preventDefault();
		if( $(".form_proforma").valid()){
			afficher_loader()
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serialize(),
				success: function(resultats) { 
					if(resultats>0){
						fermer_ajout_contrat()
						window.open('facture_proforma?id=' +resultats);
					}
					else{
						alert("erreur");
					}
				// 	var dl=resultats['locaux']['disponibles'].length,
				// 	ndl=resultats['locaux']['non disponibles'].length,
				// 	msg='';

				// 	if(dl>0) {
				// 		msg='contrats crees avec succes pour : \n\n';
				// 		for (var i = 0; i < dl; i++) msg+='\t'+'-   '+resultats['locaux']['disponibles'][i].libelle+'\n';
				// 	}
				// else msg='aucun contrat cree .';

				// if(ndl>0) {
				// 	msg+='\n\nlocaux non disponibles : \n\n';
				// 	for (var i = 0; i < ndl; i++) msg+='\t'+'-   '+resultats['locaux']['non disponibles'][i].libelle+'\n';
				// }
			// genererFacture(resultats['locaux']['factures']);
			charger_locaux(Sort,Ordre,Filtre,Page)
			cacher_loader();
		}
	});
		}

	});
}

function genererFacture(factures) {

	style=
	"html,body { margin: 0px; padding: 0px; }"+
	"@font-face { font-family: 'Antic'; font-style: normal; font-weight: 400; src: local('Antic'),local('Antic-Regular'),url('2GNslY5EMAZwbbytmM9wFw.woff') format('woff'); }"+
	"#facture { width: 1000px; margin: 20px auto; min-height: 900px; border: 1px solid rgb(18,111,150); background: none repeat scroll 0 0 rgb(51, 51, 51); }"+
	".table-facture { background: lavender; margin: 50px auto; border-bottom: 5px solid rgb(18,111,150) ; border-left: 1px solid rgb(18,111,150) ; border-right: 1px solid rgb(18,111,150) ; }"+
	".table-facture table { font-size: 14px; border-spacing: 0px; }"+
	".table-facture td { overflow: hidden; -o-text-overflow: ellipsis; text-overflow: ellipsis; padding-top: 10px; padding-bottom: 2px; padding-right: 10px; font-family: 'Antic'; }"+
	".table-facture thead { color:orange; background: rgb(18,111,150) ; }"+
	".table-facture thead td { padding-bottom: 10px; }"+
	".table-facture tbody tr:first-child td { padding-top: 20px; }"+
	".table-facture tbody tr:last-child td { padding-bottom: 20px; }"+
	".table-facture tbody td:nth-child(1) { font-weight: bold; }"+
	".table-facture thead td:nth-child(1),tbody td:nth-child(1) { padding-left: 80px; }"+

	"#multi-cols { width: 872px; min-height: 300px; }"+

	"#multi-cols thead td:nth-child(1),#multi-cols tbody td:nth-child(1) { width: 220px;  max-width: 220px; }"+

	"#multi-cols thead td:nth-child(2),#multi-cols tbody td:nth-child(2) { width: 170px; max-width: 170px; }"+

	"#multi-cols thead td:nth-child(3),#multi-cols tbody td:nth-child(3) { width: 60px; max-width: 60px; }"+

	"#multi-cols thead td:nth-child(4),#multi-cols tbody td:nth-child(4) { width: 120px; max-width: 120px; }"+

	"#multi-cols thead td:nth-child(5),#multi-cols tbody td:nth-child(5) { width: 50px; max-width: 50px; }"+

	"#multi-cols thead td:nth-child(6),#multi-cols tbody td:nth-child(6) { width: 120px; max-width: 120px; }"+

	"#multi-cols thead td:nth-child(7),#multi-cols tbody td:nth-child(7) { width: 120px; max-width: 120px; }"+


	"#mono-col { width: 300px; min-height: 200px; }"+
	"#mono-col thead td:nth-child(1),#mono-col tbody td:nth-child(1) { width: 200px;  max-width: 200px; }";

	locaux='';
	for (var i = 0; i < factures.length; i++) 
		locaux+="<tr>"+
	"<td>"+factures[i]['Designation']+"</td>"+
	"<td>"+factures[i]['surface']    +"</td>"+
	"<td>"+factures[i]['Qte']        +"</td>"+
	"<td>"+factures[i]['Prix Unit']  +"</td>"+
	"<td>"+factures[i]['T.V.A']      +"</td>"+
	"<td>"+factures[i]['MONT.H.T']   +"</td>"+
	"<td>"+factures[i]['MONT.T.T.C'] +"</td>"+
	"</tr>";

	windowFacture=window.open('');

	windowFacture.document.write(
		"<html>"+
		"<head>"+
		"<title></title>"+
		"<style>"+style+"</style>"+
		"</head>"+
		"<body>"+
		"<div id='facture'>"+
		"<div class='table-facture' id='multi-cols'>"+
		"<table>"+
		"<thead>"+"<tr> <td> Designation </td><td> 	Surface </td> <td> Qte </td> <td> Prix Unit </td> <td> T.V.A </td> <td> MONT.H.T </td> <td> MONT.T.T.C </td> </tr>  </thead>"+
		locaux+
		"</table>"+ 
		"</div>"+
		"</div>"+		
		"</body>"+
		"</html>"
		);
	windowFacture.stop();

}

function today() {
	date=new Date(); 	
	return date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();	
}

// initialisation


var i=1;

(function(formContrats) {
	clickPlus(); 	clickMoins();	$(".date").datepicker();	$('.date,.datedebut').val(today()).attr("defaut",today())	;
	
	miseAjourSelect($('.infos_contrat:first'));
	$('.infos_contrat:first .libelle').change(function() { miseAjourSelect($('.infos_contrat:first')); });
	ajouterEvents($('.infos_contrat'));
	getDatesLibres(formContrats);
	soumettreFormContrats();
	soumettreFormProforma();
})($('#form_contrats'));

// infos_reservation_locaux

function getDatesLibres(infos) {

	infos.find('.plus-infos').click(function() {
		var params={ 
			idLocal: infos.find('.libelle option:selected').attr('value'),
			idLocataire : $('#nom').find('option:selected').attr('value')
		};
		$.post("ajax/out/dates_libres.php",params,function(resultats){
			var resultats=jQuery.parseJSON(resultats),
			local=resultats['local'],
			dates=resultats['dates_libres'],
			q=" \" ";
			try {
				var msg=q+local+q+' sera libre : \n\n';
				for (var i = 0,n=dates.length; i < n; i++) {
					if(i==0 || i==n-1) { jusquau=' '; du='', q='     '; tiret=''; }
					else { tiret=' -  ',du='du ',jusquau=" Jusqu'au ",q=" \" "; }
					msg+='\t'+tiret+du+q+dates[i]['date_debut']+q+jusquau+" \" "+dates[i]['date_fin']+" \" "+'\n\n';
				}
			}
			catch(e) { msg=q+local+q+' est libre' }
			alert(msg);
		});
	});
}

// ajouter infos_contrat 

function miseAjourSelect(infos) {

	if(infos.size()==1) {
		if(infos.prev('.infos_contrat').size()==0 && infos.find('.libelle option').size()==0) {
			selection_locaux(infos.find('.libelle'));
		}
		else {
			if(infos.find('.libelle option').size()==0) {
				options='';
				infos.prev('.infos_contrat').find('.libelle option').filter(':not(:selected)').each(function() {
					options+='<option value='+$(this).attr('value')+'>'+$(this).text()+'</option>';
				}) ;
				infos.find('.libelle').html(options);
			}
			infos.next('.infos_contrat').find('.libelle').empty();
			miseAjourSelect(infos.next('.infos_contrat'));
		}
	}

}

function activerSubmit() {
	activer=true;
	// $('.infos_contrat').find('.date,.datedebut,.inpt-incr-mois,.montant').each(function() {
	// 	if($(this).css('border-left-color')=='rgb(255, 0, 0)') { activer=false; return false; }
	// });
	// if(activer) $('#envoi').stop(true, false).animate({opacity:1},500,function() { $(this).removeAttr('disabled'); });
	// else $('#envoi').stop(true, false).animate({opacity:0.2},500,function() { $(this).attr('disabled','disabled'); }); 

}

function clickPlus() {

	$('#plus').click(function() {
		
		if($('#partie-non-fixe .infos_contrat:last .libelle option').size()==2) 
			$(this).stop(true, false).animate({opacity:0.2},500,function() { $(this).attr('disabled','disabled'); });

		$(this).unbind('click');
		if($('#partie-non-fixe .infos_contrat').size()==1) {
			$('#partie-fixe #moins').animate({opacity:1},500,function() { $(this).removeAttr('disabled'); });
			$('#partie-non-fixe').css({'overflow':'hidden'});
		}
		else $('#partie-non-fixe').css({'overflow':'auto'});
		infos=$('#partie-non-fixe .infos_contrat:first').clone();
		infos=$(
			"<div class='infos_contrat'>"+
			"<select class='selection selection2 libelle' name='libelle[]'> </select>"+
			"<input class='inpt inpt2 date' type='date' placeholder='Date' name='date[]' size='40' autocomplete='off' />"+
			"<input class='inpt inpt2 datedebut' type='date' placeholder='Date début' name='datedebut[]' size='40' autocomplete='off' />"+

			"<div class='inpt-incr-annee'>"+
			"<input type='text' autocomplete='off' name='nb_annees[]' placeholder='A' class='inpt inpt2 annees' maxlength='20' style='border:none; width: 40px;'>"+
			"<div style='width: 20px; height:35px; '>"+
			"<input type='button' class='plus-annees' style='position:absolute; right:0px; top: 1px; width:20px; height:17px; line-height:10px; color:black;' value='+'>"+
			"<input type='button' class='moins-annees' style='position:absolute;right:0px; bottom:0;width:20px; height:17px; line-height:10px;color:black' value='-'>"+	
			"</div>"+
			"</div>"+

			"<div class='inpt-incr-mois'>"+
			"<input type='text' autocomplete='off' name='nb_mois[]' placeholder='M'  class='inpt inpt2 mois' maxlength='20' style='border:none; width: 40px;'>"+
			"<div style='width: 20px; height:35px; '>"+
			"<input type='button' class='plus-mois' style='position:absolute; right:0px; top: 1px; width:20px; height:17px; line-height:10px; color:black;' value='+'>"+
			"<input type='button' class='moins-mois' style='position:absolute;right:0px; bottom:0;width:20px; height:17px; line-height:10px;color:black' value='-'>"+	
			"</div>"+
			"</div>"+

			"<input class='inpt inpt2 montant' type='text' placeholder='Montant (DA/Mois)' name='montant[]' size='40' autocomplete='off' />"+
			"<input class='inpt inpt2 autre-declaration' type='text' placeholder='Autre déclaration (DA/Mois)' name='autre_declaration[]' size='40' autocomplete='off' />"+		
			"<div class='num'> 1 </div>"+
			"<img  src='elements/infos-icones.png' class='plus-infos'>"+						
			"</div>"
			);

infosVide=infos.clone().empty();
$('#partie-non-fixe').append(infosVide);
$('#partie-non-fixe').scrollTop(186*i++);

infos.find('input[type=text],input[type=date],.inpt-incr-annee,.inpt-incr-mois').val('');
infos.css({'display':'none'});
infosVide.before(infos);
infos.slideToggle(500,function () {  
	infos.find('.num').text(i); $('#plus').bind('click');
	infos.find('.date').datepicker();
	infos.find('.datedebut').datepicker();
	infos.find('.datedebut').css({'border':'solid 1px red'});
	infos.find('.inpt-incr-mois').css({'border':'solid 1px red'});
	infos.find('.montant').css({'border':'solid 1px red'});  
	infosVide.remove();
	clickPlus(); 
	ajouterEvents(infos);
	activerSubmit();
});
getDatesLibres(infos);
miseAjourSelect(infos);
infos.find('.date').val(today());
infos.find('.libelle').change(function() { miseAjourSelect($(this).parent('.infos_contrat')); });
});

}

function clickMoins() {
	$('#moins').click(function() {
		if($('#partie-non-fixe .infos_contrat').size()>1) {
			$('#plus').stop(true, false).animate({opacity:1},500,function() { $(this).removeAttr('disabled'); });
			i--;		$(this).unbind('click');
			infos=$('#partie-non-fixe .infos_contrat:last');
			infos.slideToggle(500, function () { 
				$('#partie-non-fixe').scrollTop(186*i); 
				infos.find('.num').text(i); 
				infos.remove();
				$('#moins').bind('click');
				clickMoins();
				activerSubmit();
			} );
			if(i==1) $('#partie-fixe #moins').animate({opacity:0.2},500,function() { 
				$(this).attr('disabled','disabled'); 
			});	
		}
	});

}

// controle dates

String.prototype.inserer = function(x,pos) {
	if(typeof x=='string' && x.length==1) {
		if(pos<0) return x+this;
		else return this.substr(0,pos)+x+this.substr(pos) ;
	}
}

Array.prototype.contains = function(obj) {
	var i = this.length;
	while (i--) { if (this[i] == obj) { return true; } }
	return false;
}

String.prototype.dateValide = function() {
	if(!/^[0-9]+\/[0-9]+\/[0-9]+$/.test(this)) return false;
	parts=this.split('/');
	j=parts[0];		m=parts[1];		a=parts[2];
	if(a==0 || m<1 || m>12 || j<1 || j>31) return false;
	if(j==29 && m==2 && a%4!=0) return false;
	if(j==30 && m==2) return false;	
	if(j==31 && (m==2 || m==4 || m==6 || m==9 || m==11) ) return false;
	return true;
}  

function ajouterEvents(infos) {

	infos.find('.date,.datedebut').on('keyup change',function() {
		if($(this).val().dateValide()) $(this).css({'border':'solid 1px gray'});
		else $(this).css({'border':'solid 1px red'});
		activerSubmit();
	});

	// infos.find('.montant').keyup(function() {
	// 	val=parseInt($(this).val());
	// 	if(val>0 && val<=999999999) $(this).css({'border':'solid 1px gray'});
	// 	else $(this).css({'border':'solid 1px red'});
	// 	activerSubmit();
	// }); 

	infos.find('.mois').keydown(function(event) {
		var skeys = ['Up','Down','Right','Left','Backspace','Del'];
		key=event.key;
		val=$(this).val().inserer(key,event.target.selectionStart);
		if(!/^(0*|0*([1-9]|1[0-1]|))$/.test(val) && !skeys.contains(key)) return false;
	});

	infos.find('.mois,.annees').keyup(function() {
		var mois=infos.find('.mois'),
		annees=infos.find('.annees'),
		m=(mois.val()=='')?0:parseInt(mois.val()),
		a=(annees.val()=='')?0:parseInt(annees.val());
		if(a==0 && m==0 ) infos.find('.inpt-incr-mois').css({'border':'solid 1px red'});
		else infos.find('.inpt-incr-mois').css({'border':'solid 1px gray'});
		activerSubmit();
	});	

	infos.find('.plus-mois').click(function() {
		mois=infos.find('.mois');
		annees=infos.find('.annees');
		m=(mois.val()=='')?0:parseInt(mois.val());
		a=(annees.val()=='')?0:parseInt(annees.val());
		if(m==11) { m=-1; if(a<99) annees.val(a+1); } 
		mois.val(m+1);
		infos.find('.mois').trigger('keyup');
	});

	infos.find('.moins-mois').click(function() {
		mois=infos.find('.mois');
		annees=infos.find('.annees');
		m=(mois.val()=='')?0:parseInt(mois.val());
		a=(annees.val()=='')?0:parseInt(annees.val());
		if(m>0) mois.val(m-1);
		if(m==0 && a>0) { annees.val(a-1); mois.val(11); }
		infos.find('.mois').trigger('keyup');
	});

	infos.find('.annees').keydown(function(event) {
		var skeys = ['Up','Down','Right','Left','Backspace','Del'];
		key=event.key;
		val=$(this).val().inserer(key,event.target.selectionStart);
		if(!/^(0*|0*([1-9]|[1-9][0-9]|))$/.test(val) && !skeys.contains(key)) return false;
	});

	infos.find('.plus-annees').click(function() {
		annees=infos.find('.annees');
		a=(annees.val()=='')?0:parseInt(annees.val());		
		if(a<99) annees.val(a+1);
		infos.find('.inpt-incr-mois').css({'border':'solid 1px gray'});
		activerSubmit();
	});

	infos.find('.moins-annees').click(function() {
		annees=infos.find('.annees');
		mois=infos.find('.mois');
		a=(annees.val()=='')?0:parseInt(annees.val());
		m=(mois.val()=='')?0:parseInt(mois.val());
		if(a>0) annees.val(a-1); 
		if(parseInt(annees.val())==0 && m==0) {
			infos.find('.inpt-incr-mois').css({'border':'solid 1px red'});
			activerSubmit();			
		}
	});

	// infos.find('.montant,.autre-declaration').keydown(function(event) {
	// 	var skeys = ['Up','Down','Right','Left','Backspace','Del'];
	// 	key=event.key;
	// 	val=$(this).val().inserer(key,event.target.selectionStart);
	// 	if(!/^[0-9]*$/.test(val) && !skeys.contains(key)) return false;
	// });

}

function affichier_contrat(id){
	var param={id:id};
	afficher_loader()
	$.post("ajax/out/charger_contrats_image.php",param,function(result){
		var result = jQuery.parseJSON(result);
		$('#slider ul').html("");
		images="";
		for (var i=0; i<result.length; i++) {
			images+="<li><img src='"+result[i]+"' width='357' height='505' alt='' />"+"<p class='caption' id="+i+">Imprimer</p>"+"</li>";
		};
		$('#slider ul').html(images)
		$(".callbacks_nav").remove()
		$("#slider4").responsiveSlides({
			auto: false,
			pager: true,
			nav: true,
			speed: 500,
			namespace: "callbacks",
			before: function () {
				$('.events').append("<li>before event fired.</li>");
			},
			after: function () {
				$('.events').append("<li>after event fired.</li>");
			}
		});
		$(".caption").click(function(){
			var imp="img#slider_image"+$(this).attr('id');
			$(imp).printArea();
		});
		$("#ajouter_paiement").click(function(){
			$("#datepaiement").css("display","");
		});
		cacher_loader()
	})

	$.post("ajax/out/detaille_contrat.php",param,function(result){
		var detaille="";
		var result = jQuery.parseJSON(result);
		if(result[0].date!='undefined'){
			detaille+="<tr><td>Nom:</td><td>"+result[0].libelle+"</td></tr>"
			detaille+="<tr><td>Locataire:</td><td>"+result[0].nom+"</td></tr>"
			detaille+="<tr><td>Date début:</td><td>"+result[0].date_debut+"</td></tr>"
			detaille+="<tr><td>Date fin:</td><td>"+result[0].date_fin+"</td></tr>"
			detaille+="<tr><td>Montant:</td><td>"+result[0].montant+"</td></tr>"
			detaille+="<tr><td>Autre déclaration:</td><td>"+result[0].autre_declaration+"</td></tr>"
			detaille+="<tr><td>Paiements:</td></tr>"
			for (var i=0; i<result.length; i++) {
				if(i==0) detaille+="<tr><td>"+result[0].date_debut+"</td><td>"+result[i].date+"</td></tr>";
				else detaille+="<tr><td>"+result[i-1].date+"</td><td>"+result[i].date+"</td></tr>";
			}
			detaille+="<tr><td><button id='#ajouter_paiement'>Ajouter paiement</button></td></tr>";
			detaille+="<tr><td><input type='date' id='datepaiement' style ='display: none'></td></tr>"
		}else detaille="nuuuuuuuuuuuuuuuuuuuuuull";

		$("#delta2 table tbody").html(detaille);

	})
};
</script>


</body>

</html>