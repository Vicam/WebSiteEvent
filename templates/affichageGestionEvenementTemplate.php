<?php
			if($taille==0){
				echo "<div class=\"contenu\">
							<p class=information>Vous n'avez pas encore créé d'événement !</p>";
				echo "<a href=\"index.php?action=creerEvenement\" class=\"normalButton\" title=\"Creer un evenement\"> Créer un événement</a>
					</div>";
			}
			else{
				for($i=0; $i<"$taille"; $i++){
					
					echo "
						<a href=\"index.php?action=afficherEvenement&event=${'idEvenement'.$i}\">
							<div class='evenement'>
								<div class='contenuEvent'>
									<div>
										<center><img class='imageEvent' src=\"${'image'.$i}\" /></center>
									</div>
									<div class='dateEvent'>";
										if(!isset( ${'dateFermeture'.$i} )){
											echo "Du ${'dateOuverture'.$i} <br>au ${'dateFermeture'.$i}";
										}
										else{
											echo "Le ${'dateOuverture'.$i}";
										}					
					echo "
									</div>
									<div class='nameEvent'>
										${'nomEvenement'.$i}
									</div>
									<div class='placeEvent'>
										${'lieu'.$i}
									</div>
									<div class='typeEvent'>
										<div class='typeEvent'>
											#${'type'.$i}
										</div>
										<div class='statutPublicEvent'>";
												if(${'statut'.$i}==0){
													echo 'Public';
												}
												else{
													echo 'Privé';
												}
					echo "
										</div>
									</div>
								</div>
								<div class=\"gestion\">
									<a href=\"index.php?action=modifierParametreEvenement&event=${'idEvenement'.$i}\" class=\"normalButton\" 
									title=\"Modifier les paramètres de ce compte\"> Modifier</a>
									<a href=\"index.php?action=supprimerUnEvenement&event=${'idEvenement'.$i}\" class=\"normalButton\" 
									id=\"important\" title=\"Supprimer un compte définitivement\"> Supprimer</a>
								</div>
							</div>
						</a>	
				";
			}
		}
