<?php 

	$res=$bdd->get_results("SELECT * from locaux where etage=1");
	if (count($res))
		foreach ( $res as $element){

			echo '<script>'. 
					'$("style#test").append('. 
						'"#etage1_local'.$element->id.'{'.
							'left: '.$element->left.'px;'.
							'top: '.$element->top.'px;'.
							'width: '.$element->width.'px;'.
							'height: '.$element->height.'px;'.
							'z-index: '.$element->z_index.'; '.
							'}'.
						 '#c'.$element->id.'{'.	
							'top: '.$element->top_desc.'px;'. 
							'left: '.$element->left_desc.'px; '.
							'font-size: '.$element->font_size.'px; '.
							'display: '.$element->display_desc.'; '.
							'}")'. 
					'</script>	';
				

			echo "<div class='local $element->etat' id='etage1_local$element->id' >
					 <span class='client' id='c$element->id'>".
					 $element->description."</br>".
					 $element->longueur."*".
					 $element->largeur."m</br>".
					 $element->surface."mc</span>
				</div>";
		}
	
 ?>