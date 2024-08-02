<?php
	session_start();
	$reference="../../php/";
	include("../../config.php");
	$id=$_POST["id"];
	$type=$_POST["type"];
	$max = -1;
	$dirname = "../../elements/documents/$id/$type/";
	$dir = opendir($dirname);
	$array = array();
	while($file = readdir($dir)) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file))
			{
				$array[] = str_replace("../../", "", $dirname.$file);
				$max++;
			}
	}
	closedir($dir);
	echo json_encode($array);
?>
					