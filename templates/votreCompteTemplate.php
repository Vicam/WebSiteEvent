<?php echo " 
	<div class=\"contenu\">
		<div class=\"titre\">
			<h2>Voici votre profil</h2>
		</div>
		<table>
			<tr>
				<th>Login :</th>
				<td> $pseudo </td>
			</tr>
			<tr>
				<th>Mot de passe :</th>
				<td> ******* </td>
			</tr>
			<tr>
				<th>Mail :</th>
				<td> $mail </td>
			</tr>
			<tr>
				<th>Nom :</th>
				<td> $nom </td>
			</tr>
			<tr>
				<th>Prenom :</th>
				<td> $prenom </td>
			</tr>
			<tr>
				<th>Sexe :</th>
				<td> $sexe </td>		
			</tr>
			<tr>
				<th>Date de Naissance :</th>
				<td> $dateNaissance </td>
			</tr>
			<tr>
				<th>Adresse :</th>
				<td> $adresse </td>
			</tr>
			<tr>
				<th>Code Postal :</th>
				<td> $codePostal </td>
			</tr>
			<tr>
				<th>Ville :</th>
				<td> $ville </td>
			</tr>
			<tr>
				<th>Pays :</th>
				<td> $pays </td>
			</tr>
			<tr class=\"button\">
				<th />
				<td>
					<a href=\"index.php?action=modifierParametreCompte\" class=\"normalButton\" 
					title=\"Modifier les paramètres de mon compte\"> Modifier</a>
				</td>
			</tr>
		</table>
	</div>";
?>

