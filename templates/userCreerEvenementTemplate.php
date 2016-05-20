<div class="field">
	<?php
		if(isset($inscErrorText))
		echo '<span class="error">' . $inscErrorText . '</span>';
	?>

	<form action="index.php?action=evenementCree" method="post" id="creerEvenementField">
		<table>
			<tr>
				<th>Nom de l'événement : </th>
				<td><input type="text" name="nom" placeholder="Donnez lui un titre court et distinctif" required/></td>
			</tr>
			<tr>
				<th>Adresse complête :</th>
				<td><input type="text" name="lieu" placeholder="Précisez où il est organisé" required/></td>
			</tr>
			<tr>
				<th>Début :</th>
				<td  class="labelDate"><input type="date" name="dateDeDebut" placeholder="2016-01-01" required/></td>				
			</tr>
			
			<tr>
			<th>Se termine :</th>
				<td  class="labelDate"><input type="date" name="dateDeFin" placeholder="2016-01-01" /></td>
			</tr>
			
			<tr>
				<th><p>Image :</p></th>
				<td><input type="text" name="image" placeholder="Insérez ici le lien de l'image" required/></td>
			</tr>
			
			<tr>
				<th>Lien :</th>
				<td><input type="text" name="lien" placeholder="Coller ici le lien de l'évènement (s'il y en a un)" /></td>
			</tr>
			
			<tr>
				<th>Description de l'événement :</th>
				<td><textarea rows="7" cols="50" name="description" placeholder="Décrivez les spécificités de votre événement"></textarea></td>
			</tr>
			<tr>
				<th>Nom de l'organisateur :</th>
				<td><input type="text" name="nomOrganisateur" /></td>
			</tr>
			<tr>
				<th>Description de l'organisateur :</th>
				<td><textarea rows="7" cols="50" name="descriptionOrganisateur" placeholder="Présentez-vous ici"></textarea></td>
			</tr>
			
			<tr>
				<th>Créer des places</th>
				<td><input type="number" name="nombrePlaces" placeholder="Donnez un nombre de places pour votre événement" required/></td>
			</tr>
			
			<tr>
				<th>Type d'événement :</th>
				<td>
					<select data-check="{}" name="type" required>
						<option value="" selected="selected">Sélectionnez le type d'événement</option>
						<option value="Attraction">Attraction</option>
						<option value="Autre">Autre</option>
						<option value="Camp, voyage ou retraite">Camp, voyage ou retraite</option>
						<option value="Concert ou spectacle">Concert ou spectacle</option>
						<option value="Conférence">Conférence</option>
						<option value="Convention">Convention</option>
						<option value="Course ou compétition d'endurance">Course ou compétition d'endurance</option>
						<option value="Dîner ou gala">Dîner ou gala</option>
						<option value="Festival ou foire">Festival ou foire</option>
						<option value="Formation, cours ou atelier">Formation, cours ou atelier</option>
						<option value="Jeu ou compétition">Jeu ou compétition</option>
						<option value="Projection">Projection</option>
						<option value="Rassemblement">Rassemblement</option>
						<option value="Rencontre ou événement social">Rencontre ou événement social</option>
						<option value="Salon professionnel, grand public ou exposition">Salon professionnel, grand public ou exposition</option>
						<option value="Séance de dédicaces">Séance de dédicaces</option>
						<option value="Séminaire ou entretien">Séminaire ou entretien</option>
						<option value="Soirée ou activité sociale">Soirée ou activité sociale</option>
						<option value="Tournoi">Tournoi</option>
						<option value="Visite">Visite</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Theme de l'événement :</th>
				<td>
					<select data-check="{}" name="theme">
						<option value="" selected="selected">Sélectionnez un thème</option>
						<option value="Arts du spectacle et de la scène">Arts du spectacle et de la scène</option>
						<option value="Automobiles, bateaux et avions">Automobiles, bateaux et avions</option>
						<option value="Autre">Autre</option>
						<option value="Concerts et spectacles">Concerts et spectacles</option>
						<option value="Événement communautaire et culturel">Événement communautaire et culturel</option>
						<option value="Événement professionnel">Événement professionnel</option>
						<option value="Famille et éducation">Famille et éducation</option>
						<option value="Fête et événement saisonnier">Fête et événement saisonnier</option>
						<option value="Films et divertissement">Films et divertissement</option>
						<option value="Gastronomie">Gastronomie</option>
						<option value="Maison et mode de vie">Maison et mode de vie</option>
						<option value="Mode et beauté">Mode et beauté</option>
						<option value="Passions et loisirs">Passions et loisirs</option>
						<option value="Politique et gouvernement">Politique et gouvernement</option>
						<option value="Religion et spiritualité">Religion et spiritualité</option>
						<option value="Santé et bien-être">Santé et bien-être</option>
						<option value="Sciences et technologies">Sciences et technologies</option>
						<option value="Sports et fitness">Sports et fitness</option>
						<option value="Voyages et activités de plein air">Voyages et activités de plein air</option>
						<option value="Œuvres de bienfaisance">Œuvres de bienfaisance</option>
					</select>		
				</td>
			</tr>
			
			<tr>
				<th>Statut :</th>
				<td>  
					<input type="radio" name="statutPrive" value="0" class="radioInput" checked> Public
					<br>
					<input type="radio" name="statutPrive" value="1" class="radioInput"> Privé (seuls les autres membres peuvent voir votre événement)<br>
				</td>
			</tr>
			
			<tr>
				<th />
				<td><input type="submit" value="Creer un événement !" class="normalButton"/></td>
			</tr>
		</table>
	</form>
	<br>
	<br>

</div>

