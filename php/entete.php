<div id="entete">
	<nav>
		<ul>
			<?php 
		// var_dump($liste_pages);
			foreach($liste_pages as $p){
				$selected=($p==$cle_actuelle)? "selected":"";
				?>
				<li class="lien_page <?php echo $selected;?>"><a href="<?php echo $p;?>"><?php echo $p;?></a></li>
				<?php
			}
			?>
			
			<!-- <li><a class="lien_page" href="javascript:"><img id="icone_parametres" src='elements/parametre.png'></a></li> -->
		</ul>
	</nav>	
	<img id="logo" src="elements/logo.png">
</div>