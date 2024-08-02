<?php
	$reference="../../php/";
	$includes_folder="../../inclusions/";
	include("../../inclusions/config.php");
	$var=$_POST["nom_de_la_table"];
	$titre=$_POST["titre"];
	$description=addslashes($_POST["description"]);
	$path="../../elements/slider/";
	$path2="elements/slider/";
	$valid_formats=array("jpg", "png", "gif", "bmp","jpeg");
	header('Content-type: text/html; charset=ANSI');
if(isset($_FILES["photoimg"]))
{
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
		
		$name=$_FILES['photoimg']['name'];
		$size=$_FILES['photoimg']['size'];
		if(strlen($name))
			{
			list($txt, $ext)=explode(".", $name);
			if(in_array($ext,$valid_formats))
				{
				if($size<(1024*1024)) // Image size max 1 MB
					{
					$actual_image_name=time().$var.".".$ext;
					$tmp=$_FILES['photoimg']['tmp_name'];
					$actual=$path2.$actual_image_name;
						if(move_uploaded_file($tmp, $path.$actual_image_name))
							{
								$produits= $bdd->query("INSERT INTO $var (titre,description,liens) VALUES('$titre','$description','$actual') ");
							}
						else
						echo "erreur image invalide";
					}
				else
				echo "l'image ne doit pas dépasser 1MB";
				}
			else
			echo "format invalide..";
			}
		else
		echo "veuillez selectionner une image..!";
		exit;
		} 

		}else
		echo "veuillez selectionner une image..!";
