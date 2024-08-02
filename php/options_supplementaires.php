<div class="black_background" id="black_background_utilisateur" style="display: none;">
	<div id="lightbox_container">
		<div class="lightbox" id="lightbox_utilisateur">
			<img src="elements/close_button.png" class="close_button" alt="" />
			<center>
			<form method="post" id="form_ajouter_cpt" >
				<table  id="frm_modifier_cpt">
					
					<tr>
						<td><input class="inpt" id="nom" type="text" placeholder="Nom d'utilisateur" name="nom" size="40" autocomplete="off" value=""/></td>
					</tr>
					<tr>
						<td><input class="inpt" id="mot_de_passe" type="password" placeholder="Mot de passe" name="mot_de_passe" size="40" autocomplete="off" value=""/></td>
					</tr>
					<tr>
						<td><input class="inpt" id="confirmation" type="password" placeholder="Confirmation de mot passe" name="confirmation" size="40" autocomplete="off" value=""/></td>
					</tr>
					<tr>
						<td>
							Principal<input type="radio"  name="type" value="principal"  id="type" size="40" checked/>
							assistant<input type="radio" name="type" value="assistant"  id="type" size="40"/>
						</td>
					</tr>
					<tr>
						<td><input id="envoi" class="btt" type="submit" value="Ajouter"/></td>
					</tr>
				</table>
			</form>
			</center>
		</div>
	</div>
</div>

<div class="black_background" id="black_background_utilisateur2" style="display: none;">
	<div id="lightbox_container">
		<div class="lightbox" id="lightbox_utilisateur2">
			<img src="elements/close_button.png" class="close_button" alt="" />
			<center>
			<form method="post" id="form_supp_cpt" >
				<table  id="frm_supp_cpt">
					
					<tr>
						<td><select class="selection" name="nom" id="nom">
							
						</select></td>
					</tr>
					<tr>
						<td><input id="envoi" class="btt" type="submit" value="Supprimer"/></td>
					</tr>
				</table>
			</form>
			</center>
		</div>
	</div>
</div>

<div class="black_background" id="black_background_options" style="display: none;">
	<div id="lightbox_container">
		<div class="lightbox" id="lightbox_options">
			<img src="elements/close_button.png" class="close_button" alt="" />
			<center>
			<form method="post" id="form_options" >
				<table  id="frm_options">
					
					<tr><td>L'étage a affiché au démarage</td></tr>
					<tr>
						<td><select class="selection" name="etage" id="etage">
							<option value="RDC">RDC</option>
							<option value="ETAGE1">1ER ETAGE</option>
							<option value="ETAGE2">2EME ETAGE</option>
						</select></td>
					</tr>
					<tr><td>Nombre de ligne de la table a affiché</td></tr>
					<tr>
						<td><select class="selection" name="interval" id="interval">
							<?php 
								for ($i=1; $i<21; $i++){
									echo "<option value='$i'>$i</option>";
								}
							 ?>
						</select></td>
					</tr>
					<tr><td>Couleur du local libre</td></tr>
					<tr>
						<td><input class="inpt color valid" id="color1" type="text" placeholder="Couleur de local libre" name="color1" size="40" autocomplete="off" value=""/></td>
					</tr>
					<tr><td>Couleur du local occupé</td></tr>
					<tr>
						<td><input class="inpt color valid" id="color2" type="text" placeholder="Couleur de local occupé" name="color2" size="40" autocomplete="off" value=""/></td>
					</tr>
					<tr>
						<td><input id="envoi" class="btt" type="submit" value="Enregistrer"/></td>
					</tr>
				</table>
			</form>
			</center>
		</div>
	</div>
</div>