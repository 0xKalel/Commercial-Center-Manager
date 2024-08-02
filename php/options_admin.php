<?php 
	$admin=$_SESSION['admin'];
	$req=$bdd->get_var("SELECT type FROM admin WHERE nom='$admin'");

	if ($req=="principal"){
		if ($option=="historique")
			echo "<div id='detailles' style='display: none;'><a href='#' style='float: right; margin-top: 10px;'>HISTORIQUE</a></div>";	
		else if ($option=="ajouter_modifier"){
			?>
			<span class="bouton_action bouton_bleu"   ><span id='ajouter_local'></span></span> 
			<!-- <span class="bouton_action bouton_bleu"  ><span id='modifier_local'></span></span>  -->
			<?php
		}
		else if ($option=="options_supplementaires") include('options_supplementaires.php');
		else if ($option=="options_supplementaires_btn") include('options-supplementaires_btn.php');
	}



?>