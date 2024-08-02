<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
	
	echo json_encode($bdd->get_results("SELECT * FROM admin"));

?>
					