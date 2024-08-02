<?php session_start();
require_once("inclusions/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="fr">
<?php 
require_once("inclusions/config.php");
	header('Content-type: text/html; charset=ANSI');
if(isset($_POST["admin_user"])){
	$user_admin=securiser($_POST["admin_user"]);
	$user_pass=securiser(md5($_POST["admin_user"]));
	$db_admin=$bdd->get_var("SELECT valeur FROM parametres WHERE champs='admin' ");
	if($user_admin==$db_admin){
		$db_pass=$bdd->get_var("SELECT valeur FROM parametres WHERE champs='pass' ");
		if(isset($_POST["admin_mdp"])){
			if($db_pass==md5($_POST["admin_mdp"])){
				$_SESSION["admin_us"]=true;
			}
			else
			{
				?>
				<script type="text/javascript">alert("Informations incorrectes");document.location.href=""</script>
				<?php
			}
		}
		else{
				?>
				<script type="text/javascript">alert("Veuillez entrer votre mot de passe");document.location.href=""</script>
				<?php
		}
	}
}
if(isset($_SESSION["admin_us"]))
{
?>
	<head>
		<meta charset="ANSI">
		<meta http-equiv="Content-Type" content="ANSI" />
		<meta name="keywords" content=""><meta name="robots" content="noindex"> 
		<title>Bati-Etanche - Administration</title>
		<link rel="Shortcut Icon" href="elements/favicon.ico">
		<script src="js/jquery.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<!--[if IE]><link rel="stylesheet" href="/site_media/css/ie.css" type="text/css" media="screen, projection"><![endif]-->
		<!--[if lt IE 7]> <script type="text/javascript" src="/site_media/scripts/unitpngfix.js"></script><![endif]--> 
		
		<link rel="alternate" type="application/rss+xml" title="alexswanson.net notes" href="/feeds/posts/">
		<link rel="stylesheet" type="text/css" href="css/admindesign.css" media="all">
		<script>
			function echapper(string){
				return string;
			}
			var nom="produits";
			function delete_banner(element){
				var id=$(element).parent().parent().attr("element");
				$.post("ajax/delete_banner.php",{nom_de_la_table:nom,id:id},function(result){
				if(result==0)
					afficher_elements()
				else
					alert("error")
				})
			}
			function afficher_elements()
			{
				$("#menu .bouton.active").toggleClass("active");
				$("#menu .bouton[ids="+nom+"]").toggleClass("active")
				var info="";
				param={nom_de_la_table:nom}
				$.post("ajax/chargement/charger_produits.php",param,function(resultat){
					var resultat=jQuery.parseJSON(resultat);
					for(var i=0;i<resultat.length;i++){ 
						info+="<tr element='"+resultat[i].id+"' height='70'><td><button type='button' onClick='delete_banner(this)' >supprimer</button><img src =' "+resultat[i].liens+" '> </td> <td>"+resultat[i].titre+"</td> <td><div id='description'>"+resultat[i].description+"</div></td>  </tr>";
					}
					$("#contenue").html(info);
					$("#imageform , button").show();
				})
			}
			function erreur(){
								$("#preview").show();
							}
			function effacer () {
  $(':input','form').not(':button, :submit, :reset, :hidden').val('');
}
			
			$(document).ready(function(){
			
				afficher_elements();
					$("#menu .bouton").not(".dernier").click(function(){
						nom=$(this).attr("ids")
						afficher_elements()
						$("#conteneur_newsletter").hide();
						$("#gestion").show();
					})
					$("#menu .bouton.dernier").click(function(){
						nom=$(this).attr("ids")
						$("#menu .bouton.active").toggleClass("active");
						$("#menu .bouton[ids="+nom+"]").toggleClass("active")
						$("#conteneur_newsletter").show();
						$("#gestion").hide();
					})
					$("#conteneur_newsletter form").click(function(){
						param={mail_titre:$(this).find("#mail_titre").val(),contenu:$(this).find("#contenu").val()}
						$.post("ajax/chargement/envoyer_newsletter.php",param,function(resultat){
							if(result=0)
								alert("Votre email a été envoyé a tout les abbonnés")
							else
								alert("erreur lors de l'envois de l'email")
						});
						return false;
					})
					$('#envoi').live('click', function()
					{
						$("#preview").html('');
						$("#imageform").ajaxForm(
						{
							data: {nom_de_la_table:nom},
							target: '#preview',
							success:function() {afficher_elements();effacer();
							},
							error:erreur,
							dataType: "html", 
							
						}).submit();
					
					});
			})
		</script>
	</head>
	<body> 
		<div id="side-glass" class="container prepend-1 append-1" style="margin-top:100px;" > 	
			<div id="main" class="prepend-1 span-15 last">  
			
				<div id="menu_conteneur">
					<div id="menu">
						<div class="bouton premier" ids="produits">
							 Produits
						</div>
						<div class="bouton" ids="services">
							 Services
						</div>
						<div class="bouton" ids="travaux">
							 Travaux
						</div>
						<div class="bouton dernier" ids="newsletter">
							 Newsletter
						</div>
					</div>
				</div>
				<div id="gestion">
					<div id="contenue">
					</div>
					<form id="imageform" method="post" enctype="multipart/form-data" action='ajax/enregistrement/ajaximage.php'>
					<table>
						<tr>
							<td>
								<label for="titre">Titre</label>
							</td>
							<td>
								<input type="text" name="titre" id="titre" />
							</td>
						</tr>
						<tr>
							<td>
								<p>Description</p>
							</td>
							<td>
								<textarea rows="10" cols="40" name="description" id="description"></textarea>
							</td>
						</tr>
						<tr>
							<td id="image">
								Telecharger image :
							</td>
							<span id="taille" style="position:absolute;margin-top:250px;font-size:14px;" ></span>
							<td>
								<input type="file" name="photoimg" id="photoimg" style="position:absolute;margin-top:-12px" />
							</td>
						</tr>
					</table>
					</form>
					</br>
					<button type="button" id="envoi" style="margin-top:350px;" >envoyer</button>
					<div id='preview' >
					</div>
				</div>
				<div id="conteneur_newsletter">
					<h2 style="text-align:right">Abonn&eacute;s:<?php echo $bdd->get_var("SELECT COUNT(*) FROM newsletter") ?></h2>
					<form  method="post" action='ajax/enregistrement/ajaximage.php'>
						<input type="text" name="mail_titre" id="mail_titre" placeholder="titre" />
						<textarea cols="8" rows="5" placeholder="contenu" name="contenu" id="contenu" ></textarea>
						<input type="submit" value="envoyer" />
					</form>
				</div>
			</div>	
		</div>
		
		</div>
		<!-- /main -->

	</body>
	</html>
<?php
}else{
?><head>
		<meta charset="ANSI">
		<meta http-equiv="Content-Type" content="ANSI" />
		<meta name="keywords" content=""><meta name="robots" content="noindex"> 
		<title>Bati-Etanche - Administration</title>
		<link rel="Shortcut Icon" href="elements/favicon.ico">
		<script src="js/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="css/admindesign.css" media="all">
	</head>
	<body> 
		<div id="side-glass" class="container prepend-1 append-1" style="margin-top:100px;" > 	
			<div id="main" class="prepend-1 span-15 last">  
				<div id="conteneur_login">
						<form action="" method="post">
							<input type="text" name="admin_user"  placeholder="nom d'utilisateur" required />
							<br/>
							<input type="password" name="admin_mdp" placeholder="mot de passe" required />
							<br/>
							<input type="submit" value="Se connecter">
						</form>
				</div>	
			</div>
		</div>
		<!-- /main -->

	</body>
	</html>
<?php 
}
?>
