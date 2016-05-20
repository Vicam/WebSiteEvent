<div class="contenu">
	<div class="titre">
		<h2> Liste de tous les comptes du site </h2>
	</div>
	<?php
		if(isset($changement)){
			echo "
			<div id=\"changement\">
				$changement
			</div>";
		}
		echo "
		<div id=\"petiteTable\">
			<table>
				<tr>
					<th class=\"espace\"> Login </th>
					<th class=\"espace\"> Mot de passe </th>
					<th class=\"espace\"> statut </th>
					<th class=\"espace\"> Mail </th>
					<th class=\"espace\"> Modifier </th>
					<th class=\"espace\"> Supprimer </th>
					<th class=\"espace\">  <a href=\"index.php?action=gererComptePlus\" class=\"normalButton\" title=\"tableau complet\"> + </a> </th>
				</tr>";
		for($i=0; $i<"$taille"; $i++){
			echo "
			<tr>
				<td class=\"espace\"> ${'pseudo'.$i} </td>
				<td class=\"espace\"> ${'password'.$i} </td>
				<td class=\"espace\"> ${'statut'.$i} </td>
				<td class=\"espace\"> ${'mail'.$i} </td>
				<td class=\"espace\"> <a href=\"index.php?action=voirUnCompte&compte=${'pseudo'.$i}\" class=\"normalButton\" 
					title=\"Modifier les paramètres de ce compte\"> Modifier</a> </td>
				<td class=\"espace\"> <a href=\"index.php?action=supprimerUnCompte&compte=${'pseudo'.$i}\" class=\"normalButton\" 
					id=\"important\" title=\"Supprimer un compte définitivement\"> Supprimer</a> </td>
			</tr>";
		}
		echo "		
			</table>
		</div>";
	?>
</div>

