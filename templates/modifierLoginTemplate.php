<div class="contenu">
	<div class="titre">
		<?php
		echo "<h3 class=\"titre\">Changement de Login</h3>
	</div>";
	
		if(isset($ChangeText)){ 
			echo $ChangeText; 
		}
		echo " <form action=\"index.php?action=changeLogin\" method=\"post\" class=\"field\">
			<table>
				<tr>
					<th>Nouveau Login :</th>
					<td><input type=\"text\" name=\"newLogin\"/></td>
				</tr>
				<tr>
					<th>Mot de passe actuel :</th>
					<td><input type=\"password\" name=\"currentPasswordLogin\"/></td>
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
