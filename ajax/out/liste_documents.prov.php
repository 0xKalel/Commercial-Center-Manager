<?php
session_start();
$reference="../../php/";
include("../../config.php");

$dirname=$_POST['dirname'];

function getFiles($dirname) {

	$files = array();
	
	if (file_exists($dirname)) {
		$dir = opendir($dirname);
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
				array_push($files,$file);
			}
		}

	}
	
	return $files;	

}



echo json_encode(getFiles($dirname));


?>
