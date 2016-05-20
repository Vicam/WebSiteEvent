<div class="contenu" id="connexionContenu">
	<div class="titre">
		<h2>Connectez-vous</h2>
		<a href="index.php?action=inscription">Ou créez un compte</a>
	</div>
	<div id="erreur"> 
		<?php 
			if(isset($inscErrorText)){ echo $inscErrorText; }
		?>
	</div> 

	<div class="field"> 
		<form action="index.php?action=identification" method="post">
			<fieldset>
				<input type="text" name="connexionLogin" id="username" placeholder="Nom d'utilisateur" /><br>	
				<input type="password" name="connexionPassword" id="password" placeholder="Mot de passe" /><br>
				<input type="submit" class="normalButton" id="submit" value="Connexion" />
			</fieldset>
		</form>
		<a href="index.php?action=passwordOublie">Mot de passe oublié ?</a>
	</div> 
</div>
