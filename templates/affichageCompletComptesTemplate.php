<div class="contenu">
	<div class="titre">
		<h2> Liste des comptes avec tous les paramètres </h2>
	</div>
	<?php
		
		echo "
		<div id=\"grandeTable\">
			<table>
				<tr>
					<th> Login </th>
					<th> Mot de passe </th>
					<th> statut </th>
					<th> Mail </th>
					<th> Nom </th>
					<th> Prenom </th>
					<th> Sexe </th>
					<th> Date de Naissance </th>
					<th> Adresse </th>
					<th> Code Postal </th>
					<th> Ville </th>
					<th> Pays </th>
					<th> <a href=\"index.php?action=gererCompte\" class=\"normalButton\" title=\"tableau réduit\"> - </a> </th>
				</tr>";
		for($i=0; $i<"$taille"; $i++){
			echo "
			<tr>
				<td> <a href=\"index.php?action=voirUnCompte&compte=${'pseudo'.$i}\"  title=\"modifier ce compte\"> ${'pseudo'.$i} </a> </td>
				<td> ${'password'.$i} </td>
				<td> ${'statut'.$i} </td>
				<td> ${'mail'.$i} </td>
				<td> ${'nom'.$i} </td>
				<td> ${'prenom'.$i} </td>
				<td> ${'sexe'.$i} </td>	
				<td> ${'dateNaissance'.$i} </td>
				<td> ${'adresse'.$i} </td>
				<td> ${'codePostal'.$i} </td>
				<td> ${'ville'.$i} </td>
				<td> ${'pays'.$i} </td>
			</tr>";
		}
		echo "		
			</table>
		</div>";
	?>
</div>

