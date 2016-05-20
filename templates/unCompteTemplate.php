<div class="contenu">
	<?php
		echo "
		<div class=\"titre\">
			<h2> Compte de $pseudo </h2>
		</div>";
		if(isset($changement)){
			echo "
			<div id=\"changement\">
				$changement
			</div>";
		}
		echo "
		<form action=\"index.php?action=updateParametreCompte&compte=$pseudo\" method=\"post\" class=\"field\">
			<table>
				<tr>
					<th>Login :</th>
					<td> <input type=\"text\" name=\"login\" value=\"$pseudo\"/> </td>
				</tr>
				<tr>
					<th>Statut :</th>
					<td> <input type=\"text\" name=\"statut\" value=\"$statut\"/> </td>
				</tr>
				<tr>
					<th>Mot de passe :</th>
					<td> <input type=\"text\" name=\"password\" value=\"$password\"/> </td>
				</tr>
				<tr>
					<th>Mail :</th>
					<td> <input type=\"email\" name=\"email\" value=\"$email\"/></td>
					</td>
				</tr>
				<tr>
					<th>Nom :</th>
					<td> <input type=\"text\" name=\"nom\" value=\"$nom\"> </td>
				</tr>
				<tr>
					<th>Prenom :</th>
					<td> <input type=\"text\" name=\"prenom\" value=\"$prenom\"/> </td>
				</tr>
				<tr>
					<th>Sexe :</th>";
						if ( $sexe == 'Femme' ) {
							echo "<td> <input type=\"radio\" class=\"radioInput\" name=\"sexe\" value=\"Homme\" > Homme
								<input type=\"radio\" class=\"radioInput\" name=\"sexe\" value=\"Femme\" checked> Femme<br> </td>";
							}
						else {
							echo "<td> <input type=\"radio\" class=\"radioInput\" name=\"sexe\" value=\"Homme\" checked> Homme
							<input type=\"radio\" class=\"radioInput\" name=\"sexe\" value=\"Femme\"> Femme<br> </td>";
						}
			echo "		
				</tr>
				<tr>
					<th>Date de Naissance :</th>
					<td><input value='$dateNaissance'type=\"date\" name=\"dateNaissance\"/></td>
				</tr>
				<tr>
					<th>Adresse :</th>
					<td><input type=\"text\" name=\"adresse\" value=\"$adresse\"/></td>
				</tr>
				<tr>
					<th>Code Postal :</th>
					<td><input type=\"number\" name=\"codePostal\" value=\"$codePostal\"/></td>
				</tr>
				<tr>
					<th>Ville :</th>
					<td><input type=\"text\" name=\"ville\" value=\"$ville\"/></td>
				</tr>
				<tr>
					<th>Pays :</th>
					<td><input type=\"text\" name=\"pays\" value=\"$pays\"/></td>
				</tr>
				<tr>
					<th />
					<td>
						<a href=\"index.php?action=gererCompte\" class=\"normalButton\">
						Retour</a>
						<input type=\"submit\" class=\"normalButton\" value=\"Enregistrer les modifications\" />
					</td>
				</tr>
			</table>
		</form>
		";	

	?>
</div>
