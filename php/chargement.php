<?php 
	
	$res=$bdd->get_results("SELECT * from locaux where etage=$etage");

	if (count($res))
		foreach ($res as $element){
			$etat="";
			$date=date("Y-m-d");
			$res2=$bdd->get_row("SELECT MAX(`contrats`.`date_fin`) as z,locataires.nom as loc FROM `locaux`,`contrats`,locataires WHERE `locaux`.`id`=`contrats`.`local` AND locataires.id=contrats.locataire AND `contrats`.`local`=$element->id  AND  `contrats`.`date_fin` > '$date'");
			$nom_local=$element->libelle;
			// var_dump($res2);
			if ($res2->z) {
					$nom_local=$res2->loc;
					$date1=date('Y-m-d', strtotime($date." +15 days"));
					$date2=date('Y-m-d', strtotime($date." +90 days"));
					if ($date1>$res2->z) $etat='expere';
					else if ($date2>$res2->z) $etat='experant';
					else $etat='occupe';
				// }
			}
			else $etat='libre';

			echo '<script>'. 
					'$("style#test").append('. 
						'"#etage1_local'.$element->id.'{'.
							'left: '.$element->gauche.'px;'.
							'top: '.$element->top.'px;'.
							'width: '.$element->width.'px;'.
							'height: '.$element->height.'px;'.
							'z-index: '.$element->z_index.'; '.
							'opacity: 1;'.
							'}'.
						 '#c'.$element->id.'{'.	
							'top: '.$element->top_desc.'px;'. 
							'left: '.$element->left_desc.'px; '.
							'font-size: '.$element->font_size.'px; '.
							'display: '.$element->display_desc.'; '.
							'}")'. 
					'</script>	';
				

			echo "<div class='local $etat' id='etage1_local$element->id' >
					 <span class='client' id='c$element->id'>".
					 $nom_local."</br>".
					 $element->longueur." X ".
					 $element->largeur."m</br>".
					 $element->surface."m²</span>
				</div>";
		}
	
 ?>