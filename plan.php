<?php 	
include("php/detection_session.php");
include("config.php");
$cle_actuelle="plan";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<title>Plan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="mondersky" />
	<script type="text/javascript" src="js/jscolor.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.0.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript"src="js/messages_fr.js"></script>
	<script type="text/javascript" src="js/liste_options.js"></script>
	<script src="js/ui_drag_resize.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/design.css" type="text/css"/>
	<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<style id="test"></style>
	<style>  
	/*.libre, #leg_libre{  background-color: <?php echo $color1; ?>!important;   }  */
	.libre, #leg_libre{  background: -moz-linear-gradient(top,  rgb(49, 138, 175) 63%, rgb(29, 118, 155) 100%);  !important;  
		background: -webkit-gradient(linear, left top, left bottom, color-stop(63%,rgb(49, 138, 175)), color-stop(100%,rgb(29, 118, 155)));
		background: -webkit-linear-gradient(top,  rgb(49, 138, 175) 63%,rgb(29, 118, 155) 100%); 
		background: -o-linear-gradient(top,  rgb(49, 138, 175) 63%,rgb(29, 118, 155) 100%); 
		background: -ms-linear-gradient(top,  rgb(49, 138, 175) 63%,rgb(29, 118, 155) 100%); 
		background: linear-gradient(to bottom, rgb(49, 138, 175) 63%,rgb(29, 118, 155) 100%); 
	}  
	.local, #leg_occupe{ background-color: <?php echo $color2; ?> }
	</style>
</head>
<body class="dzoom" data-twttr-rendered="true">
	<div id="conteneur">

		<div id="repense" style="display:none;"> 
			<h3></h3>
		</div>
		<?php 
		include("php/entete.php");
		include("php/liste_options.php");
		?>


		<div class="conteneur" >
			<div id="conteneur_plan">
				<div class="conteneur_gauche fenetre_noir">
					<div class="bordures_map">
						
						<div id="sole" class="local">
							<div class="etage" id="etage1" <?php if ($etageSelecnionne!="RDC") echo " style='display: none;'"?>> 
								<div style="text-align: center;"><h3 class="titre">RDC</h3></div>
								<?PHP 
								$etage=1;
								include("php/chargement.php"); 
								?> 
								<img src="elements/escalier.png" style="width: 20px; height: 36px; top: 368px; left: 131px; z-index: 5; position: absolute;"/>
								<img src="elements/escalier.png" style="width: 33px; top: 19px; left: 131px; z-index: 5; position: absolute;"/>

							</div>

							<div class="etage" id="etage2" <?php if ($etageSelecnionne!="ETAGE1") echo " style='display: none;'"?>>
								<div style="text-align: center;"><h3 class="titre">etage 1</h3></div>
								<?PHP 
								$etage=2;
								include("php/chargement.php"); 
								?>
								<img src="elements/escalier.png" style="width: 12px; height: 55px; top: 300px; left: 114px; z-index: 5; position: absolute;"/>
								<img src="elements/escalier2.png" style="width: 100px; height: 20px; top: 140px; left: 128px; z-index: 5; position: absolute;"/>
							</div>

							<div class="etage" id="etage3" <?php if ($etageSelecnionne!="ETAGE2") echo " style='display: none;'"?>>
								<div style="text-align: center;"><h3 class="titre">etage 2</h3></div>
								<?PHP 
								$etage=3;
								include("php/chargement.php"); 
								?>
								<img src="elements/escalier2.png" style="width: 50px; height: 20px; top: 102px; left: 194px; z-index: 5; position: absolute;"/>
							</div>
							<div id="draggable0" class="dep draggable0 nouveau_local local" style="left: 0px;">
								<span id='cible'>Nouveau local </span>
							</div>
						</div>
					</div>
				</div>
				<div class="conteneur_droit">

					<div id='btn' class="fenetre_noir">
						<h3 class="titre">Actions</h3>
						<form style="text-align:center">
							<span class="bouton_action selection_etage bouton_bleu" id='rdc'     onclick="etage(0);">RDC</span> 
							<span class="bouton_action selection_etage bouton_bleu" id='etage_1' onclick="etage(1);">1</span>  
							<span class="bouton_action selection_etage bouton_bleu" id='etage_2' onclick="etage(2);">2</span>  
							<span class="bouton_action bouton_bleu" onclick="zoom();"><span  id='zoom'></span></span>  

							<?PHP 
							$option="ajouter_modifier";
							include("php/options_admin.php"); 
							?>	
						</form>

					</div>
					<div class="infos_bas">
						
						<div id='info'  class="fenetre_noir">
							<h3 class="titre">Informations de l'étage</h3>

							<table id="info_desc">
								<thead>
									<th>réservés</th>
									<th>non réservés</th>
									<th>total</th>
								</thead>
								<tbody>
									<tr>
										<td class='lblvalue' id='nbr_res'><p></p></td>
										<td class='lblvalue' id='nbr_no_res'><p></p></td>
										<td class='lblvalue' id='nbr'><p></p></td>
									</tr>
								</tbody>

							</table>

						</div>
						<div id="legend" class="fenetre_noir">
							<h3 class="titre">Légende</h3>
							<table  id="tableau_legende">
								<tr>
									<td>Libre</td>
									<td>Occupé</td>
									<td> -3 m</td>
									<td>-15 J</td>
								</tr>
								<td><div class="leg" id="leg_libre"></div></td>
								<td><div class="leg" id="leg_occupe"></div></td>
								<td><div class="leg" style="background-color: yellow;"></div></td>
								<td><div class="leg" style="background-color: red;"></div></td>
								<tr>
								</tr>
							</table>
						</div>
					</div>

					<div id="info_desc2" style="display: none;" class="fenetre_noir">
						<div class="infos_local">
							
							<span class="bouton_fermer"></span>
							<h3 class="titre">Informations local</h3>
							<table><tbody></tbody></table>
							<div>
								<button type="button"  id="modifier_ce_local" class="bouton_bleu">Modifier</button>
								<button type="button"  id="supprimer_ce_local" class="bouton_rouge" title="supprimer">X</button>
							</div>
						</div>
						<div class="modifications_local">
							<h3 class="titre">Modifications</h3>
							<form action="" method="post">

								<input type="hidden" class="input"  placeholder="id" name="id" />
								<input type="text" class="input" name="libelle" placeholder="nom" value="Nouveau local" id='champ' />
								<div class="select_conteneur">
									<label for="type">type</label>
									<select name="type" id="" class="input">
										<option value="local">local</option>
										<option value="bureau">bureau</option>
									</select>
								</div>
								<?php /*
								<div class="select_conteneur">
									<label for="type">locataire</label>
									<select name="idlocataire" id="" class="input" style="width: 137px;">
										<option value="0" selected>aucun</option>
										<?php 
										$data=$bdd->get_results("SELECT id,nom FROM locataires ");
										foreach($data as $d){
											?>
											<option value="<?php echo $d->id;?>"><?php echo $d->nom;?></option>
											<?php
										}
										?>

									</select>
								</div>
								*/
								?>
								
								<input type="text" class="input"  placeholder="longueur" name="longueur" />
								<input type="text" class="input"  placeholder="largeur"  name="largeur" />
								<input type="text" class="input"  placeholder="surface"  name="surface" />
								<input type="hidden" name="top" />
								<input type="hidden" name="gauche" />
								<input type="hidden" name="width" />
								<input type="hidden" name="height" />
								<input type="hidden" name="etage" />
								<textarea name="description" id="" cols="5" rows="3" class="input" placeholder="description"></textarea>
							</form>
							<br />
							<button type="button"  id="annuler_modification" class="bouton_bleu"  >annuler</button>
							<input type="submit"  id="enregistrer_modification" value="enregistrer" class="bouton_bleu"  />
						</div>
					</div>
					<div id="conteneur_nouveau_local" class="fenetre_noir" style="position: relative;text-align: center;">
						<span class="bouton_fermer"></span>
						<h3 class="titre">Nouveau local</h3>
						<div style="" id="draggable_container">
							
						</div>
						<p class='message_deplacer' ><span>Déplacez le nouveau local vers la position désirée</span></p>
						<form action="" method="post" >
							<input type="text" class="input" name="nom" placeholder="nom" value="Nouveau local" id='champ' />
							<div class="select_conteneur">
								<label for="type">type</label>
								<select name="type" id="" class="input">
									<option value="local">local</option>
									<option value="bureau">bureau</option>
								</select>
							</div>
							<!-- <div class="select_conteneur">
								<label for="type">locataire</label>
								<select name="idlocataire" id="" class="input" style="width: 137px;">
									<option value="0" selected>aucun</option>
									<?php 
									$data=$bdd->get_results("SELECT id,nom FROM locataires ");
									foreach($data as $d){
										?>
										<option value="<?php echo $d->id;?>"><?php echo $d->nom;?></option>
										<?php
									}
									?>
									
								</select>
							</div> -->
							<input type="text" class="input"  placeholder="longueur" name="longueur" />
							<input type="text" class="input"  placeholder="largeur"  name="largeur" />
							<input type="text" class="input"  placeholder="surface"  name="surface" />
							<input type="hidden" name="top" />
							<input type="hidden" name="gauche" />
							<input type="hidden" name="width" />
							<input type="hidden" name="height" />
							<input type="hidden" name="etage" />
							<textarea name="description" id="" cols="5" rows="3" class="input" placeholder="description"></textarea>
							<br />
							<button type="button"  id="annuler_nouveau" class="bouton_bleu"  >annuler</button>
							<input type="submit" value="enregistrer" class="bouton_bleu"  />
						</form>
					</div>
				</div>
			</div>
			
		</div>

	</div>

	<?PHP 
	include("php/modifier_cpt.php");
	$option="options_supplementaires";
	include("php/options_admin.php"); 
	?>
	<script src="js/scripts.js" type="text/javascript"></script>
	<script src="js/loader.js" type="text/javascript"></script>
	<script type="text/javascript">
	

$("#sole").delegate(".local:not('.dep')","click",function(){
	afficher_loader()
	$(".infos_bas").hide();
	Local=$(this).attr("id");
	Local=Local.replace("etage1_local","");
	var param={id:Local};
	$.post("ajax/out/detaille_local.php",param,function(resultat){
		var resultat=jQuery.parseJSON(resultat);
		var details="";
		var id="";
		$(".modifications_local form")[0].reset()
		champs= {
			"id":"id",
			"nom":"libelle",
			"type":"type",
			"longueur":"longueur",
			"largeur":"largeur",
			"surface":"surface",
			"locataires":"nom",
			"date de debut":"date_debut",
			"date de fin":"date_fin",
			"montant":"montant",
			"autre declaration":"autre_declaration",
			"description":"description"
		}
		if(resultat[0].indice=="1")
			for(var i=0;i<resultat.length;i++)
			{

				$.each(champs,function(index,value){
					if(index!="id")
					eval('details+="<tr><td id=\'titleP\'> '+index+':</td><td>"+resultat[i].'+value+'+"</td> </tr>"');
					else
					eval('details+="<tr style=\'display:none\'><td id=\'titleP\'> '+index+':</td><td>"+resultat[i].'+value+'+"</td> </tr>"');
					$(".modifications_local [name="+value+"]").val(eval("resultat[i]."+value))
				})
			}
			else 
				for(var i=0;i<resultat.length;i++)
				{
					details+=
					"<tr><td id='titleP'> nom: </td><td>"+resultat[i].libelle+"</td></tr>"+
					"<tr><td id='titleP'> type: </td><td>"+resultat[i].type+"</td></tr>"+
					"<tr><td id='titleP'> longueur: </td><td>"+resultat[i].longueur+"</td></tr>"+
					"<tr><td id='titleP'> largeur: </td><td>"+resultat[i].largeur+"</td></tr>"+
					"<tr><td id='titleP'> surface: </td><td>"+resultat[i].surface+"</td></tr>"+
					"<tr><td id='titleP'> description: </td><td>"+resultat[i].description+"</td></tr>"; 
					$.each(champs,function(index,value){
						$(".modifications_local [name="+value+"]").val(eval("resultat[i]."+value))
					})
					// $(".modifications_local select[name=type]").val(resultat[i].typ)
					// $(".modifications_local select[name=idlocataire]").val(resultat[i].idlocataire)
				}

				$("#info_desc2 table tbody").html(details);
				$("#info_desc2").show();
				cacher_loader()
			})
});

$(document).ready(function(){
	$("#modifier_ce_local").click(function(){
		$(".modifications_local").show()
		$(".infos_local").hide()
	})
	$("#annuler_modification").click(function(){
		$(".modifications_local").hide()
		$(".infos_local").show()
	})
	$("#enregistrer_modification").click(function(){
	afficher_loader()
		var position;
		var affichage="";
		etage_courrant=$(".etage").index($(".etage:visible"))+1;
		$(".modifications_local form [name=etage]").val(etage_courrant)
		var param=$(".modifications_local form").serializeArray();
		if(param[4].value=="") param[4].value=0;
		if(param[5].value=="") param[5].value=0;
		if(param[6].value=="") param[6].value=0;
		id=param[0].value
		largeur=param[4].value
		longueur=param[5].value
		surface=param[6].value
		$.post("ajax/in/modifier_local.php",param,function(result){
			// var result = jQuery.parseJSON(result);
			if(result==1){
				nom_local=$(".modifications_local input[name=libelle]").val();
				$('#etage1_local'+id).html('<span id="c'+result+'" class="client">'+nom_local+"</br>"+largeur+"X"+longueur+"m</br>"+surface+'m²</span>')
				// $(".modifications_local form")[0].reset();
				// $("#draggable_container").append('<div id="draggable0" class="dep draggable0 nouveau_local local" style="left: 85px;"><span id="cible">Nouveau local </span></div>')
				$(".modifications_local").hide()
				$(".infos_local").show()
						setTimeout(function(){
						$('#etage1_local'+id).click()
							
						},100)
			}
			else
				alert(result);
			cacher_loader();
		})
})
$("#supprimer_ce_local").click(function(){
		etage_courrant=$(".etage").index($(".etage:visible"))+1;
		id=$(".modifications_local input[name='id']").val()
	var param={id:id};
	if(confirm("voulez vous vraiment supprimer ce local? les contrats qui y sont associés ne seront plus valides.")){

	afficher_loader()
	console.log(param);
	$.post("ajax/in/supprimer_local.php",param,function(result){
		if(result==1)
			$('#etage1_local'+id).remove()
		else
			alert(result)
		cacher_loader()
		$(".modifications_local").hide()
				$(".infos_local").show()
	})
	}
})
$(document).mousemove(function(event) {
	currentMousePos.x = event.pageX;
	currentMousePos.y = event.pageY;
});
$("#conteneur_nouveau_local form").submit(function(){
	afficher_loader()
	var position;
	var affichage="";
	var draggable0=$("#draggable0");
	position=$(draggable0).offset();
	document_position=$("#sole").offset();
	var left=position.left-document_position.left;
	var top=position.top-document_position.top;
	top+=15;
	left+=15;
	etage_courrant=$(".etage").index($(".etage:visible"))+1;
	$("#conteneur_nouveau_local form input[name=gauche]").val(left)
	$("#conteneur_nouveau_local form input[name=top]").val(top)
	$("#conteneur_nouveau_local form input[name=height]").val($(draggable0).height())
	$("#conteneur_nouveau_local form input[name=width]").val($(draggable0).width())
	$("#conteneur_nouveau_local form input[name=etage]").val(etage_courrant)
	var param=$("#conteneur_nouveau_local form").serializeArray();
	if(param[3].value=="") param[3].value=0;
	if(param[4].value=="") param[4].value=0;
	if(param[5].value=="") param[5].value=0;
	largeur=param[3].value
	longueur=param[4].value
	surface=param[5].value
	$.post("ajax/in/enregistrer_local.php",param,function(result){
		var result = jQuery.parseJSON(result);
		if(result>0){
			nom_local=$("#conteneur_nouveau_local input[name=nom]").val();
			$("#etage"+etage_courrant).append('<div id="etage1_local'+result+'" class="local libre"><span id="c'+result+'" class="client">'+nom_local+"</br>"+largeur+"X"+longueur+"m</br>"+surface+'m²</span></div')
			$('#etage1_local'+result).css({top:top,left:left,height:$(draggable0).height(),width:$(draggable0).width()})
			$("#conteneur_nouveau_local form")[0].reset();
			$(".reduire_hauteur").toggleClass("reduire_hauteur")
			$("#conteneur_nouveau_local").hide()
			$(".infos_bas").show()
			$("#draggable0").css({
				top : 0,
				left : 0,
				height:100,
				width:100,
				display:"none"
			}).find("#cible").html("Nouveau local")
				// $("#draggable_container").append('<div id="draggable0" class="dep draggable0 nouveau_local local" style="left: 85px;"><span id="cible">Nouveau local </span></div>')
				$(".etage .local,.etage img").css("opacity","1")
			}
			else
				alert(result);
			cacher_loader();

		})
return false;
})
$('#champ').on("keyup",function(){
	$("#cible").text($("#champ").val())
})
$("#ajouter_local").click(function(){
	$(".infos_bas,#info_desc2").hide()
	$("#conteneur_nouveau_local,#draggable0").show()
	$(".etage .local,.etage img").css("opacity","0.4")
});
$("#conteneur_nouveau_local .bouton_fermer,#annuler_nouveau").click(function(){
	$("#conteneur_nouveau_local,#draggable0").hide()
	$(".infos_bas").show()
	$(".etage .local,.etage img").css("opacity","1")
})
$("#sole").droppable()
setTimeout(alerte, 200);
$("#info_desc2 .bouton_fermer").click(function(){
	$("#info_desc2").hide()
	$(".infos_bas").show()
})
info(<?php if ($etageSelecnionne=="RDC") echo 1; else if ($etageSelecnionne=="ETAGE1") echo 2; else echo 3?>);

});

</script>
</body>

</html>