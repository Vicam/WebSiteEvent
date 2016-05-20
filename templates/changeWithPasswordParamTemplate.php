<div class="contenu">
	<div class="titre">
		<?php
		echo "<h3 class=\"titre\">Changement de $param</h3>
	</div>";
	
		if(isset($ChangeText)){ 
			echo $ChangeText; 
		}
		echo " <form action=\"index.php?action=changeWithPasswordParam\" method=\"post\" class=\"field\">
			<table>
				<tr>
					<th>Mot de passe actuel :</th>
					<td><input type=\"password\" name=\"currentPassword\"/></td>
				</tr>
				<tr>
					<th>Nouveau $param :</th>
					<td><input type=\"text\" name=\"new.$param.\"/></td>
				</tr>
				<th />
					<td>
						<a href=\"index.php?action=monCompte\" class=\"normalButton\">
						Retour</a>
						<input type=\"submit\" class=\"normalButton\" value=\"Sauvegarder\" />
					</td>				
			</table>
		</form>
		";	

	?>
</div>
