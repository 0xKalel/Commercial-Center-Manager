<?php 	
include("php/detection_session.php");
include("config.php");
$cle_actuelle="locataires";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
	<title>Locataires</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="mondersky" />
	<script type="text/javascript" src="js/jscolor.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.0.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript"src="js/messages_fr.js"></script>
	<script type="text/javascript" src="js/liste_options.js"></script>
	<script type="text/javascript" src="js/loader.js"></script>
	<link rel="stylesheet" href="css/design.css" type="text/css"/>
	<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<style id="test"></style>
</head>

<body>
	<div id="repense" style="display:none;"> 
		<h3></h3>
	</div>
	<div id="conteneur">
		
		<div class="main">
			<?php 
			include("php/entete.php");
			include("php/liste_options.php");
			?>	
			<div class="conteneur petit">
				<button class="btt" id="ajouter_locataire" type="button">Ajouter</button>
				<form action="" method="post" id="form_supp_locataires">
					<div class="options">
						<!-- <input type="submit" class="btt" id="supprimer_locataire" name="supprimer_locataire" value="Supprimer"/> -->
						<span class="res" style="display: none;">
							
						</span>
					</div>
				</form>
			</div>
			
			<div id ="locataires">
				<form action="" method="post" id="form_selection_suppression">
					<?PHP include("php/list_locataires.php"); ?> 
				</form>
			</div>
		</div>
	</div>

	<div class="black_background" id="black_background_ajouter_locataire" style="display: none;">
		<div id="lightbox_container">
			<div class="lightbox" id="lightbox_locataire">
				<center>
					<form method="post" id="form_locataires" >
						<h3 class="titre">
							Nouveau locataire:
						</h3>
						<img src="elements/close_button.png" class="close_button" alt="" />
						<table class="tbl" id="frm_locataires">
							<tr>
								<td><input class = "inpt" id = "nom" type = "text" placeholder = "Nom du locataire" name = "nom" size = "40" autocomplete = "off" /></td>
							</tr>
							<tr>
								<td><input class = "inpt" id = "tel" type = "text" placeholder = "Téléphone" name = "tel" size = "40" autocomplete = "off" /></td>
							</tr>
							<tr>
								<td><input class = "inpt" id = "mobile" type = "text" placeholder = "Mobile" name = "mobile" size = "40" autocomplete = "off" /></td>
							</tr>

							<tr>
								<td><input class = "inpt" id = "rcn" type = "text" placeholder = "RC N°" name = "rcn" size = "40" autocomplete = "off" /></td>
							</tr>

							<tr>
								<td><input class = "inpt" id = "mat_fiscal" type = "text" placeholder = "MAT FISCAL" name = "mat_fiscal" size = "40" autocomplete = "off" /></td>
							</tr>

							<tr>
								<td><input class = "inpt" id = "objet" type = "text" placeholder = "Objet" name = "mat_fiscal" size = "40" autocomplete = "off" /></td>
							</tr>

							<tr>
								<td class="td_bouton">
									<input class="btt2" type="submit" value="OK"/></td>
								</tr>
							</table>
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
		function cacher_lightbox(){
			$('.black_background').fadeOut(500);
		}
		$(document).ready(function() {
			$("#form_locataires").validate({
				rules :{
					"nom" :{
						"required" :true,
					},
					"tel" :{
						"required" :true,
					},
					"mobile" :{
						"required" :true,
					}
				},

				submitHandler: function(){
		afficher_loader()
					$.post("ajax/in/nouveau_locataire.php", $("#form_locataires").serialize(), function(resultat){
						cacher_lightbox();
						if (resultat == 1) {
							$("#repense h3").html("Locataire ajouté");
							$("#repense").css("background-color","green");
							Sort="id";Ordre="DESC";Filtre;Page=1;
							charger_locaux(Sort,Ordre,Filtre,Page,function(){
								$("#tableau_locataires tr").eq(1).find("td").css("background-color","#AACB21");
								setTimeout(function(){
									$("#tableau_locataires tr").eq(1).find("td").toggleClass("dernier_ajoute");
								},700);
								$("#repense").css("display","block");
								setTimeout(function(){$("#repense").fadeOut(2000);},3000);
							})
						}else{
							alert(resultat)
						}
		cacher_loader()
					})
				}
			});
$("#tableau_locataires").delegate(".supprimer","click",function(){ 
	if (confirm("La supression de ce locataire entrainera la supression des contrats qui lui sont associés. etes vous sure?")) { 
		afficher_loader()
	supp=[];
	supp[0]=$(this).parent().parent().attr("id");
	var param={supp:supp};
	$.post("ajax/in/supprimer_locataires.php",param,function(result){
		var result = jQuery.parseJSON(result);
		if(result==1)
			charger_locaux(Sort,Ordre,Filtre,Page);
		else
			alert(result)
		cacher_loader()
	})
}
})
			$("#form_supp_locataires").validate({
				rules :{
				},

				submitHandler: function(){
		afficher_loader()
					$.post("ajax/in/supprimer_locataires.php", $("#form_selection_suppression").serialize(), function(resultat){
						cacher_lightbox();
						if (resultat == 1){
							$("#repense h3").html("Locataires supprimés!");
							$("#repense").css("background-color","green");
							Sort="id";Ordre="DESC";Filtre;Page=1;
							charger_locaux(Sort,Ordre,Filtre,Page,function(){
							})
						}else{
							alert(resultat)
						}
						$("#repense").css("display","block");
						setTimeout(function(){$("#repense").fadeOut(2000);},3000);

		cacher_loader()
					})
				}
			});



		});



$('.close_button').click(function(){
	cacher_lightbox();
});

$('#ajouter_locataire').click(function(){
	$('#black_background_ajouter_locataire').css("display","");
});

$("#tableau_locataires tbody ").click(
	jQuery.fn.multiselect = function() {
		$(this).each(function() {
			var checkboxes = $(this).find("input:checkbox");
			checkboxes.each(function() {
				var checkbox = $(this);
			            // Highlight pre-selected checkboxes
			            if (checkbox.prop("checked"))
			            	(checkbox.parent()).parent().css("background-color","red");
			                // checkbox.parent().addClass("multiselect-on");
			                
			            // Highlight checkboxes that the user selects
			            checkbox.click(function() {
			            	if (checkbox.prop("checked"))
			            		(checkbox.parent()).parent().css("background-color","red");
			                    // checkbox.parent().addClass("multiselect-on");

			                    else
			                    	(checkbox.parent()).parent().css("background-color","");
			                    //checkbox.parent().removeClass("multiselect-on");
			                });
			        });
		});
	});


</script>
</body>

</html>