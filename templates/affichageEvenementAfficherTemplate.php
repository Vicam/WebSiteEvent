<?php

echo "

		<center>
			<div class='contenuEventAfficher'>
			
				<div>
					<center><img class='imageEventAfficher' src=\"$image\" /></center>
				</div>
				
				<br>
				
				<div class='contenuEventAfficherTexte'>";
					if(isset( $dateFermeture )&&$dateFermeture!='0000-00-00'){
						echo "Du $dateOuverture <br>au $dateFermeture";
					}
					else{
						echo "Le $dateOuverture";
					}
	echo "
				</div>
				
				<br>
				
				<div class='contenuEventAfficherTexte'>
					<strong>$lieu</strong>
				</div>
				
				<br> 
				
				<div class='contenuEventAfficherTexte'>
					<h2 class='nameEventAfficher'>$nomEvenement</h2>
				</div>	
				
				<br> 
				
				<div class='contenuEventAfficherTexte'>";				
					if(isset( $description )){
							echo "<strong>Description : </strong><br>$description";
					}
	echo "				
				</div>
				
				<div class='contenuEventAfficherTexte'>";				
					if(isset( $lien )){
							echo "<br><a href=\"$lien\" >Lien vers l'événement</a>";
					}
	echo "				
				</div>";
				
				if(isset( $lien )||isset( $description )){
							echo "<br>";
					}
	echo "				
				<div class='contenuEventAfficherTexte'>";				
					if(isset( $nomOrganisateur )){
							echo "<strong>Nom de l'organisateur : </strong><br>$nomOrganisateur";
					}
	echo "				
				</div>
				
				<div class='contenuEventAfficherTexte'>";				
					if(isset( $descriptionOrganisateur )){
							echo "<br><strong>Description de l'organisateur : </strong><br>$descriptionOrganisateur";
					}
	echo "									
				</div>";
				
				if(isset( $nomOrganisateur )||isset( $descriptionOrganisateur )){
							echo "<br>";
					}
	echo "				
				<div class='contenuEventAfficherTexte'>";				
					if(isset( $theme )){
							echo "$theme";
					}
	echo "									
				</div>
				
				<div class='contenuEventAfficherTexte'>
					$type
				</div>
					
				<br>	
					
				<div class='contenuEventAfficherTexte'>";
					echo "<strong>Statut : </strong>";
					if($statut==0){
						echo 'Public';
					}
					else{
						echo 'Privé';
					}
	echo "
				</div>	
			</div>
		</center>
		
		<br>
		<br>
			
				";
