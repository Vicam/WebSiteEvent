<div class="contenu">
	<div class="titre">
		<h2>Inscription</h2>
	</div>
	<div class="erreur">
		<?php
			if(isset($inscErrorText))
			echo '<span class="error">' . $inscErrorText . '</span>';
		?>
	</div>
	<div class="field">
		<form action="index.php?action=inscription" method="post">
			<table>
				<tr>
					<th>Login* :</th>
					<td><input type="text" name="inscLogin" required/></td>
				</tr>
				<tr>
					<th>Mot de passe* :</th>
					<td><input type="password" name="inscPassword" required/></td>
				</tr>
				<tr>
					<th>Mail* :</th>
					<td><input type="email" name="mail" required/></td>
				</tr>
				<tr>
					<th>Nom :</th>
					<td><input type="text" name="nom"/></td>
				</tr>
				<tr>
					<th>Prenom :</th>
					<td><input type="text" name="prenom"/></td>
				</tr>
				<tr>
					<th>Sexe :</th>
					<td>  <input type="radio" class="radioInput" name="sexe" value="Homme" checked> Homme
						  <input type="radio" class="radioInput" name="sexe" value="Femme"> Femme<br>
					</td>
				</tr>
				<tr>
					<th>Date de Naissance :</th>
					<td><input value='1990-01-20'type="date" name="dateNaissance"/></td>
				</tr>
				<tr>
					<th>Adresse :</th>
					<td><input type="text" name="adresse"/></td>
				</tr>
				<tr>
					<th>Code Postal :</th>
					<td><input type="number" name="codePostal"/></td>
				</tr>
				<tr>
					<th>Ville :</th>
					<td><input type="text" name="ville"/></td>
				</tr>
				<tr>
					<th>Pays :</th>
					<td><input type="text" name="pays"/></td>
				</tr>
				<tr>
					<th />
					<td><input type="submit" class="normalButton" value="Creer mon compte" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
