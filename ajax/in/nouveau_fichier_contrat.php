<?php
session_start();
$reference="../../php/";
include("../../config.php");
$valid_formats=array("jpg", "png", "gif", "bmp","jpeg","pdf","JPG", "PNG", "GIF", "BMP","JPEG","PDF");
$path="../../elements/documents/contrats/";
foreach($_POST as $key=>$value)
{
	$$key=securiser($value);
}
$path2="elements/documents/contrats/$contrat/";
if(isset($_FILES["document_image"]))
{	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$local=$_POST["contrat"];
		if (!file_exists("../../elements/documents/contrats/$contrat/")) mkdir("../../elements/documents/contrats/$contrat/",0777,true);
		$path = "../../elements/documents/contrats/$contrat/";
		for ($i=0;$i<count($_FILES["document_image"]['name']);$i++)
		{
			$name = $_FILES['document_image']['name'][$i];
			$size = $_FILES['document_image']['size'][$i];
			if(strlen($name)){
			list($txt, $ext)=explode(".", $name);
			if(in_array($ext,$valid_formats)){
				if($size<(10*1024*1024)) // Image size max 3 MB
				{
					$actual_image_name=time()."document$i.".$ext;
					$tmp=$_FILES['document_image']['tmp_name'][$i];
					$actual=$path.$actual_image_name;
					move_uploaded_file($tmp, $path.$actual_image_name);
					if($bdd->query("UPDATE contrats SET fichier='".$path2.$actual_image_name."' WHERE id=".$_POST["contrat"].""))
			 						echo "reussi"; 
			 					else echo "erreur";
				}
			else echo "le fichier ne doit pas dépasser 10mb.";
		}
			else echo "le type de fichier doit etre une image ou un pdf.";
		}

	}
}
} else echo 0; //
?>