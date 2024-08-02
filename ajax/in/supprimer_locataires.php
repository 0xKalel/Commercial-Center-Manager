<?php session_start();
	$reference="../../php/";
	include("../../config.php");
	include("../../php/bdd_securite.php");

	if(isset($_POST["supp"])){
		try{
			for ($i=0;$i<count($_POST["supp"]);$i++)
				{
					$x=$_POST['supp'][$i];
					$bdd->query("DELETE FROM locataires WHERE id=$x");
				}
			echo 1;
		} catch(Exception $e){
		    echo "erreur connexion";
		} 
	}
	else
		echo "aucun élement n'a été sélectionné";
?>