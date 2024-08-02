<div id="paramettres" style="display: none;">
	<center>
	 <table style="width:100%;">
	 	<tr>
	 		<td>
	 			<form method="post" id="frm" action="php/deconnexion.php">
	 				<input type="submit" value="Déconnexion" style="width:100%;">
	 			</form>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td>
	 			<button id="modifier_compte" style="width:100%;">Modifier compte</button>
	 		</td>
	 	</tr>
	 	<?PHP 
			$option="options_supplementaires_btn";
			include("php/options_admin.php"); 
		?>	
	 </table>
	</center>
</div>