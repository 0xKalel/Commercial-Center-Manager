<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("config.php"); 
if (isset($_SESSION['admin'])) 
	header('Location: plan');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="mondersky" />
		<link rel="stylesheet" href="css/design_login.css" type="text/css"/>
		<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
		<script type="text/javascript"src="js/jquery-2.1.0.js"></script>
		<script type="text/javascript"src="js/jquery.validate.min.js">  </script>
	    <script type="text/javascript"src="js/messages_fr.js">  </script>
	</head>
	<body>
		<div class='main'>
			BIENVENUE
			<p>Veuillez entrer votre nom d'utilisateur et votre mot de passe.</p>
			<div class="frm">
				<center> 
				<form method="post" id="frm" action="php/connexion.php">
					<table class="tbl">
						<tr><td id="msg">	
							<?php 
								if(isset($_SESSION['msg'])){
									$msg=$_SESSION["msg"];
									echo "$msg";
									session_destroy();
								}  
							?>
						</td></tr>
						<tr>
							<td><input class="inpt" id="admin" type="text" placeholder="Nom d'admin" name="admin" size="40" autocomplete="off" value="hamid" /></td>
						</tr>
						<tr>
							<td><input class="inpt" id="mot_de_passe" type="password" placeholder="Mot de passe" name="mot_de_passe" size="40" autocomplete="off" value="hamid" /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Connexion" class="btt" onClick="effacer()"/></td>
						</tr>
					</table>
				</form>
				</centre>


			</div>
		</div>



		<script type="text/javascript">


		    function effacer(){
		        $('#msg').html("") ;
		    }

		     $(document).ready(function(){

		        $('#frm').validate({
			        rules : {
			            "admin" :{
			             	"required" : true,
			            },

			            "mot_de_passe" : {
			              	"required" :true,
			            }
			        }


		       	});
		    });   

    	</script>

	</body>

</html>