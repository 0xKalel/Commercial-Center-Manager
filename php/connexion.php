<?php session_start();
	include("../config.php");
	include("bdd_securite.php");

	$admin=Securite::bdd($_POST['admin'],$bdd2);
	$passe=Securite::bdd($_POST["mot_de_passe"],$bdd2);

	$req="SELECT COUNT(*) FROM admin WHERE nom='$admin' and mot_de_passe='$passe'";
	$res=$bdd->get_var("SELECT type FROM admin WHERE nom='$admin' and mot_de_passe='$passe'");
	$cnx=$bdd->get_var($req);

	if($cnx>0){
		$_SESSION['admin']=$admin;
		$_SESSION['passe']=$passe;
		$_SESSION['type']=$res;
		header("Location:../plan");
	}else{
		$_SESSION['msg']="Nom ou mot de passe incorrect.";
		header("Location:../index");
	}

 ?>