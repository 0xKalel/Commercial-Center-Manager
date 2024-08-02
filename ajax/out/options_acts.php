<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
		
	$req=$bdd->get_results("SELECT * FROM options");
	
	echo json_encode($req);

?>
	