<?php
if(!$userInscrit){
	echo "
		<center>
			<a href=\"index.php?action=participerEvenement&event=$idEvenement\" class=\"normalButton\">Je participe !</a>
		</center>";		
}
else{
	echo "
	
		<center><p>Vous êtes inscrits à cet événement</p></center>
		<center>
			<a href=\"index.php?action=seRetirerEvenement&event=$idEvenement\" class=\"normalButton\">Annuler l'inscription</a>
		</center>";	
}

	?>

<br>
<br>
<br>