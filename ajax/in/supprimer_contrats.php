<?php session_start();
	$reference="../../php/";
	include("../../config.php");
	include("../../php/bdd_securite.php");
	$path="../../elements/contrats/";

	if(isset($_POST["supp"])){
		try{
			for ($i=0;$i<count($_POST["supp"]);$i++)
				{
					$x=$_POST['supp'][$i];
					$bdd->query("DELETE FROM contrats WHERE id=$x");
					supprimer_dossier($path.$x."/");
				}
			echo 1;
		} catch(Exception $e){
		    echo "erreur connexion";
		} 
	}

	function supprimer_dossier($directory, $empty = false) {
	    if(substr($directory,-1) == "/") {
	        $directory = substr($directory,0,-1);
	    }
	 
	    if(!file_exists($directory) || !is_dir($directory)) {
	        return false;
	    } elseif(!is_readable($directory)) {
	        return false;
	    } else {
	        $directoryHandle = opendir($directory);
	 
	        while ($contents = readdir($directoryHandle)) {
	            if($contents != '.' && $contents != '..') {
	                $path = $directory . "/" . $contents;
	 
	                if(is_dir($path)) {
	                    supprimer_dossier($path);
	                } else {
	                    unlink($path);
	                }
	            }
	        }
	 
	        closedir($directoryHandle);
	 
	        if($empty == false) {
	            if(!rmdir($directory)) {
	                return false;
	            }
	        }
	 
	        return true;
	    }
	}
?>