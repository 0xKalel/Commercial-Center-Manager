<?php
session_start();
$reference="../../php/";
include("../../config.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
		$bdd->query("DELETE FROM locaux WHERE id='$id' LIMIT 1");
		echo 1;
}
else
	echo "les informations n'ont pas pu etre envoyées. réessayez";

?>




