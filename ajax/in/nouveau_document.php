<?php
session_start();
$reference="../../php/";
include("../../config.php");
$valid_formats=array("jpg", "png", "gif", "bmp","jpeg","pdf","JPG", "PNG", "GIF", "BMP","JPEG","PDF");
$path="../../elements/documents/";
$path2="elements/slider/";
foreach($_POST as $key=>$value)
{
	$$key=securiser($value);
}
if(isset($_FILES["document_image"]))
{	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$local=$_POST["local"];
		$type=$_POST["type_document"];
		if (!file_exists("../../elements/documents/$local/$type/")) mkdir("../../elements/documents/$local/$type/",0777,true);
		$path = "../../elements/documents/$local/$type/";
		for ($i=0;$i<count($_FILES["document_image"]['name']);$i++)
		{
			$name = $_FILES['document_image']['name'][$i];
			list($txt, $ext)=explode(".", $name);
			if(in_array($ext,$valid_formats)){
				$actual_image_name=time()."document$i.".$ext;
				$tmp=$_FILES['document_image']['tmp_name'][$i];
				$actual=$path.$actual_image_name;
				move_uploaded_file($tmp, $path.$actual_image_name);
				echo 1;
			}
			else echo "le type de fichier doit etre une image ou un pdf.";
		}

		// $name=$_FILES['contrat_image']['name'];
		// $size=$_FILES['contrat_image']['size'];

		// if(strlen($name)){
		// 	list($txt, $ext)=explode(".", $name);
		// 	if(in_array($ext,$valid_formats)){
		// 		if($size<(1024*1024)) {
		// 			$actual_image_name=time()."contrat.".$ext;
		// 			$tmp=$_FILES['contrat_image']['tmp_name'];
		// 			$actual=$path2.$actual_image_name;

		// 			if(move_uploaded_file($tmp, $path.$actual_image_name)){

		// 				$libelle=$_POST["libelle"];
		// 				$nom=$_POST["nom"];

		// 				$parts=explode('/', $_POST['datedebut']);
		// 				$date_debut ="$parts[2]-$parts[1]-$parts[0]";
		// 				$parts2=explode('/', $_POST['datefin']);
		// 				$date_fin ="$parts2[2]-$parts2[1]-$parts2[0]";



		// 					if($bdd->query("INSERT INTO contrats(local,locataire,date_debut,date_fin) VALUES($libelle,$nom,'$date_debut','$date_fin')"))
		// 						echo 0; 
		// 					else echo 1;
		// 			}
		// 		} else echo 2;
		// 	} else echo 3; 
		// } else echo 4;
	}

} else echo 0; //
?>