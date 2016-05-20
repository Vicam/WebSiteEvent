<div class="contenu">
	<div class="titre">
		<h3 class="titre">Changement de mot de passe</h3>
	</div>
	<?php
		if(isset($ChangePasswordText)){ 
			echo $ChangePasswordText; 
		}
		echo " <form action=\"index.php?action=changePassword\" method=\"post\" class=\"field\">
			<table>
				<tr>
					<th>Mot de passe actuel :</th>
					<td><input type=\"password\" name=\"currentPassword\"/></td>
				</tr>
				<tr>
					<th>Nouveau mot de passe :</th>
					<td><input type=\"password\" name=\"newPassword\"/></td>
				</tr>
				<tr>
					<th>Répéter le nouveau mot de passe :</th>
					<td><input type=\"password\" name=\"verifiedPassword\"/></td>
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
