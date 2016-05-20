<div class="contenu">
	<div class="titre">
		<?php
		echo "<h3 class=\"titre\">Changement d'Email</h3>
	</div>";
	
		if(isset($ChangeText)){ 
			echo $ChangeText; 
		}
		echo " <form action=\"index.php?action=changeEmail\" method=\"post\" class=\"field\">
			<table>
				<tr>
					<th>Nouveau E-mail :</th>
					<td><input type=\"email\" name=\"newEmail\"/></td>
				</tr>
				<tr>
					<th>Mot de passe actuel :</th>
					<td><input type=\"password\" name=\"currentPasswordEmail\"/></td>
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
