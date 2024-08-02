<?php include("php/detection_session.php");
include("config.php");
$cle_actuelle="locaux";
if(isset($_GET["local"])){
	$local=$bdd->get_row("SELECT * FROM locaux WHERE id='".$_GET["local"]."'");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<title><?php if(isset($_GET["local"])){echo $local->libelle;}else{ echo "Locaux";}?></title>
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
	<script type="text/javascript" src="js/liste_options.js"></script>
	<script src="js/lightbox.js"></script>
	<script src="js/loader.js"></script>
	<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<link href="css/lightbox.css" rel="stylesheet" />
	<style id="test"></style>
	<style type="text/css">

	</style>
</head>

<body>

	<div id="conteneur">

		<div id="light-box">
			<div id="table">
				<div id="table-cell">
					<div id="conteneur">
						<!-- <img id='facture' src="images/1.jpg" alt=""> -->
						<img id='fermer' src="elements/close_button.png" alt=''>
						<img id='icon-impr' src='elements/icone-impr.png' alt=''>
					</div>
				</div>			
			</div>
		</div>

		<div id="repense" style="display:none;"> 
			<h3></h3>
		</div>
		<div class="main">
			<?php 
			include("php/entete.php");
			include("php/liste_options.php");
			?>	
			<div class="conteneur petit">
				<!-- <form action="" method="post" id="form_supp_locataires"> -->
				<div style="text-align:center; margin-top:20px; ">
					<!-- <button type='button' class="btt" id="ajouter_document">nouveau document</button> -->
					<!-- <button type='button' class="btt" id="retour" style="display: none;">Retour</button> -->
					<span class="res" style="display: none;">

					</span>
				</div>
			</div>
			<?php 
			if(!isset($_GET["local"])){

				?>

				<div  id ="locaux">
					<?PHP include("php/list_locaux.php"); ?> 
				</div>
				<?php 
			}
			?>
			
			<div  id ="detaille_local" style="display: none" >		
				<div style="text-align:center;"> 
					<button type='button' class="documents_btt active" id="infos" value="">Infos</button>
					<button type='button' class="documents_btt" id="factures_electricite" value="">Factures Electricité</button>
					<button type='button' class="documents_btt" id="factures_internet">Factures Internet</button>
					<button type='button' class="documents_btt" id="factures_telephone">Factures Téléphone</button>
					<button type='button' class="documents_btt" id="factures_eau">Factures d'eau</button>
					<button type='button' class="documents_btt" id="autres">Autres</button>
				</div>
				<div class="contenu_tabs">
					<div id="infos_contenu">
						
						<center>
							<h4>Informations:</h4>
						</center>
						<center>
							<table id="table_detaille_local">
								<tr>
									<td class="labelle">Nom:</td>
									<td id="nom"><?php echo $local->libelle;?></td>
								</tr>
								<tr>
									<td class="labelle">Etage:</td>
									<td id="etage"><?php echo $local->etage;?></td>
								</tr>
								<tr>
									<td class="labelle">Type:</td>
									<td id="type"><?php echo $local->type;?></td>
								</tr>
								<tr>
									<td class="labelle">Longueur :</td>
									<td id="longueur"><?php echo $local->longueur;?><span class="labelle">m</span></td>
								</tr>
								<tr>
									<td class="labelle">Largeur :</td>
									<td id="largeur"><?php echo $local->largeur;?><span class="labelle">m</span></td>
								</tr>
								<tr>
									<td class="labelle">Surface :</td>
									<td id="surface"><?php echo $local->surface;?><span class="labelle">m²</span></td>
								</tr>
								<tr>
									<td class="labelle">Déscription:</td>
									<td id="description"><?php echo $local->description;?></td>
								</tr>
							</table>
						</center>
						<br />
						<center>
							<h4>historique de location:</h4>
						</center>
						<table id="tableau_historique">
							<thead>
								<tr>
									<th id="locatair">Nom</th>
									<th id="telephone">Téléphone</th>
									<th id="mobile">Mobile</th>
									<th id="date_debut">Date début</th>
									<th id="date_fin">Date fin</th>
									<th id="montant">Montant</th>
									<th id="autre_declaration">Autre déclaration</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div id='docs'> </div>
				</div>
			</div>
			<div id="list_image" style="display: none;"> 
				HELLO
			</div>
			<!-- 				</form> -->

		</div>
		<?PHP 
		include("php/modifier_cpt.php");
		$option="options_supplementaires";
		include("php/options_admin.php"); 
		?>

	</div>
	<div class="black_background" id="black_background_ajouter_document" style="display: none;">
		<div id="lightbox_container">
			<div class="fenetre" id="lightbox_document">
				<img src="elements/close_button.png" class="close_button" alt="" />
				<center>
					<form method="post" id="form_document"  enctype="multipart/form-data" action="ajax/in/nouveau_document.php">
						<h3>Nouveau document pour <span class="titre"></span></h3>
						<table class="tbl" id="frm_document">
							<tr class="cache">
								<td></td>
								<td>
									<select class="selection" id="local" name="local">
									</select>
								</td>
							</tr>
							<tr>
								<td>Type</td>
								<td>
									<select class="selection" id="type_document" name="type_document">
										<option name="electricite" id="electricite" value="factures_electricite">Facture électricité</option>
										<option name="internet" id="internet" value="factures_internet">Facture internet</option>
										<option name="telephone" id="telephone" value="factures_telephone">Facture téléphone</option>
										<option name="eau" id="eau" value="factures_eau">Facture d'eau</option>
										<option name="autre" id="autre" value="autres">Autre</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>document</td>
								<td><input class="inpt" id="document_image" type="file" name="document_image[]" multiple/></td>
							</tr>
						</table>
						<center><input class="btt2" type="submit" value="OK"/></center>
					</form>
				</center>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	function ouvrir_local(id){
		afficher_loader()
		$("#locaux").css("display","none");
		$("#detaille_local").css("display","");
		$("#retour").css("display","");
		var param={id:id};
		$.post("ajax/out/historique_local.php",param,function(result){
			var resultat = jQuery.parseJSON(result);
			var historique="";
			for(var i=0;i<resultat.length;i++)
			{
				historique+="<tr id='"+resultat[i].id+"'> <td> "+resultat[i].nom+
				"</td> <td> "+resultat[i].tel+
				"</td> <td> "+resultat[i].mobile+
				"</td> <td> "+resultat[i].date_debut+
				"</td> <td> "+resultat[i].date_fin+
				"</td> <td> "+resultat[i].montant+
				"</td> <td> "+resultat[i].autre_declaration+
				"</td></tr>"; 
			}
			$("#tableau_historique tbody").html(historique);
			if(historique=="")
				$("#tableau_historique").replaceWith("<center>Aucun historique pour ce local</center>");
			$("#factures_electricite").attr("value",id);
			$("#factures_internet").attr("value",id);
			$("#factures_telephone").attr("value",id);
			$("#factures_eau").attr("value",id);
			$("#autres").attr("value",id);
			cacher_loader()
		})
}
$(document).ready(function(){
	<?php 
	if(isset($_GET["local"])){
		?>
		ouvrir_local(<?php echo $_GET["local"];?>)
		<?php
	}
	?>

	function cacher_lightbox(){
		$('.black_background').fadeOut(500);
	};
	function selection_locaux(){

		var param={sort:'0',ordre:'0',filtre:'0',page : '0'};
		$.post("ajax/out/charger_locaux.php",param,function(resultat){
			var resultat=jQuery.parseJSON(resultat);
			var locaux="";
			for(var i=0;i<resultat.length;i++)
			{
				locaux+="<option value='"+resultat[i].id+"'>"+resultat[i].libelle+"</option>"; 
			}
			$("select#local").html(locaux);
					// if(fonction_supplementaire!=0)
					// 	fonction_supplementaire()
				})
	};
	$('.close_button').mousedown(function(){
		cacher_lightbox();
	});
	$('#tableau_locaux').delegate(".plus","click",function(){
		facture_objet=$(this);
		$('#black_background_ajouter_document').css("display","");
		$('.black_background').find("[name=local]").val($(facture_objet).parent().parent().attr("id"));
		$('.black_background .titre').html($('.black_background').find("[name=local] [value="+$(facture_objet).parent().parent().attr("id")+"]").html());
	});
	$("#form_document").validate({
		rules :{
			"local" :{
				"required" :true,
			},
			"type_document" :{
				"required" :true,
			},
			"document_image" :{
				"required" :true,
			},
		},
	});

	$("#form_document").ajaxForm({
		beforeSubmit: function () {
		afficher_loader()
			return $("#form_document").valid();
		},
		success:function(result){
			if (result==1){
				cacher_lightbox();
			}else{
				alert(result)
			}
			cacher_loader()
		}
	});

	selection_locaux();
	$("#tableau_locaux tbody").delegate(".liste", "click", function() {
		window.open('?local=' + $(this).parent().parent().attr("id"));
			// ouvrir_local($(this).attr("id"))

		});

	$("#retour").mousedown(function(){

		$("#locaux").css("display","block");
		$("#detaille_local").css("display","none");
		$("#retour").css("display","none");
	});

	$(".documents_btt").click(function(){
		$(".documents_btt.active").removeClass("active")
		$(this).addClass("active")
		// $('#table_detaille_local').css('display','none');
		// $('#tableau_historique').css('display','none');

		var typeDoc=$(this).attr('id'),
		idLocal=$(this).attr('value'),
		path="elements/documents/"+idLocal+"/"+typeDoc+"/",
		docs=$('#docs');

		docs.empty();
		if($(this).attr("id")=="infos"){
			$("#infos_contenu").show();
			$(docs).hide()
		}
		else{
			afficher_loader()
			$.post("ajax/out/liste_documents.prov.php",{ dirname: "../../"+path },function(resultat) {
				resultat=$.parseJSON(resultat);
				var n=resultat.length;
				$("#infos_contenu").hide();
				$(docs).show()
				if(n>0) {		
					for (var i = 0; i < n; i++) {
						docs.append("<a href='"+path+resultat[i]+"' data-lightbox='image-1' class='document_thumb' style='background-image:url("+path+resultat[i]+")'></a> ")
					};

					docs.find('img').css({
						'width': 90,
						'height': 130,
						'border':'1px solid black'
					})

					docs.css('margin','0px auto');
					docs.find('.page img').click(function() { clickDoc($(this)); })
					docs.find('.control').click( function() { docs.find('.page img').click(function() { clickDoc($(this)); }) });

					function clickDoc(doc) {
						$('#light-box').find('#facture').attr('src',doc.attr('src'));
						$('#light-box').css({'display':'block'});
					}

					$('#light-box #fermer').click(function() { $('#light-box').css('display','none'); });

					$('#light-box #icon-impr').hover(
						function() { $(this).stop(true, false).animate( { opacity: 1 }, 250 ); },
						function() { $(this).stop(true, false).animate( { opacity: 0.5 }, 250 ); }
						);

					$('#light-box #icon-impr').click(function() { imprimer('#light-box #facture'); })
				}
				else {
					$("#docs").html("<h3>Aucun Document</h3>");
				}
				cacher_loader()
			})
}

});
});
</script>
</body>

</html>