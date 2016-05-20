<?php
	class UserController extends Controller {
		protected $user = NULL;
		protected $statutView = NULL;
		
		public function __construct($request){
			parent::__construct($request);
			$this->user = $request->getNameUser();
			$this->statutView = $request->getNameController()."View";
			if ( $request->getNameActionRequest() == 'updateParametre' ){
				$this->updateParametre($request);
			}
			else if ( strcmp($request->read('currentPassword'),'default') != 0 ) {
				$this->updateMotDePasse($request);
			}
			else if ( strcmp($request->read('newLogin'),'default') != 0 ) {
				$this->updateLogin($request);
			}
			else if ( strcmp($request->read('newEmail'),'default') != 0 ) {
				$this->updateEmail($request);
			}
			else if ( strcmp($request->getNameEvent(),'default') != 0 ) {
				if ( UserModel::isEventCreated($request->getNameEvent()) ){
					$this->executeWithRequest($request);
				}
				else {
					$this->evenementsAction();
				}
			}
			else {
				$this->execute();
			}
		}
		
		public function defaultAction() {
			$view = new $this->statutView($this, 'userIndex'); //renderCurrentViewWith('index', array('user' => $this->user))
			$view->setArg('pseudo', $this->user );
			$view ->render();
			
		}
		
		public function monCompteAction() {
			$login = $this->user; 
			$view = new $this->statutView($this,'votreCompte');
			$view->setArg('pseudo', $login );
			$view->setArg('nom', UserModel::proprieteUtilisateur('NOMCOMPTE', $login) );
			$view->setArg('prenom', UserModel::proprieteUtilisateur('PRENOMCOMPTE', $login) );
			$view->setArg('mail', UserModel::proprieteUtilisateur('ADRESSEMAIL', $login) );
			$view->setArg('sexe', UserModel::proprieteUtilisateur('SEXECOMPTE', $login) );
			$view->setArg('dateNaissance', UserModel::proprieteUtilisateur('DATENAISSANCECOMPTE', $login) );
			$view->setArg('adresse', UserModel::proprieteUtilisateur('ADRESSERUECOMPTE', $login) );
			$view->setArg('codePostal', UserModel::proprieteUtilisateur('ADRESSECODECOMPTE', $login) );
			$view->setArg('ville', UserModel::proprieteUtilisateur('ADRESSEVILLECOMPTE', $login) );
			$view->setArg('pays', UserModel::proprieteUtilisateur('ADRESSEPAYSCOMPTE', $login) );
			$view->render();
		}
		
		public function gererEvenementAction() {
			$view = new $this->statutView($this, 'userGererEvenements');
			$view->render();
			$user = $this->user;
			$liste = array();		
			if($this->statutView=='UserView'){
				$liste = UserModel::listeEvenementsUser($user);
			}
			else if($this->statutView=='AdministratorView') {
				$liste = UserModel::listeEvenementGestion();
			}
			$taille = count($liste);
			$view = new $this->statutView($this, 'affichageGestionEvenement');
			$view->setArg('taille', $taille );
			for($i=0; $i<$taille; $i++){
				$event = $liste[$i]['IDEVENEMENT'];
				$view->setArg('image'.$i, UserModel::proprieteEvenement('LIEN_IMAGE', $event) );
				$view->setArg('nomEvenement'.$i, UserModel::proprieteEvenement('NOM_EVENEMENT', $event) );
				$view->setArg('dateOuverture'.$i, UserModel::proprieteEvenement('DATE_OUVERTURE_EVENEMENT', $event) );
				$view->setArg('dateFermeture'.$i, UserModel::proprieteEvenement('DATE_FERMETURE_EVENEMENT', $event) );
				$view->setArg('lieu'.$i, UserModel::proprieteEvenement('ID_LIEU', $event) );
				$view->setArg('type'.$i, UserModel::proprieteEvenement('TYPE_EVENEMENT', $event) );
				$view->setArg('statut'.$i, UserModel::proprieteEvenement('STATUT_PRIVE', $event) );	
				$view->setArg('idEvenement'.$i, UserModel::proprieteEvenement('IDEVENEMENT', $event) );					
			}
			$view->render();
		}
		
		public function afficherEvenementsParticiper() {
			$user = $this->user; 
			$liste = UserModel::listeEvenementsParticiperUser($user);
			$taille = count($liste);
			$view = new $this->statutView($this, 'affichageEvenement');
			$view->setArg('taille', $taille );
			for($i=0; $i<$taille; $i++){
				$event = $liste[$i];
				$view->setArg('image'.$i, UserModel::proprieteEvenement('LIEN_IMAGE', $event) );
				$view->setArg('nomEvenement'.$i, UserModel::proprieteEvenement('NOM_EVENEMENT', $event) );
				$view->setArg('dateOuverture'.$i, UserModel::proprieteEvenement('DATE_OUVERTURE_EVENEMENT', $event) );
				$view->setArg('dateFermeture'.$i, UserModel::proprieteEvenement('DATE_FERMETURE_EVENEMENT', $event) );
				$view->setArg('lieu'.$i, UserModel::proprieteEvenement('ID_LIEU', $event) );
				$view->setArg('type'.$i, UserModel::proprieteEvenement('TYPE_EVENEMENT', $event) );
				$view->setArg('statut'.$i, UserModel::proprieteEvenement('STATUT_PRIVE', $event) );	
				$view->setArg('idEvenement'.$i, UserModel::proprieteEvenement('IDEVENEMENT', $event) );					
			}
			$view->render();
		}
		
		public function evenementsAction() {
			$view = new $this->statutView($this, 'evenements');
			$view->render();
			$liste = UserModel::listeEvenement();
			$taille = count($liste);
			$view = new $this->statutView($this, 'affichageEvenement');
			$view->setArg('taille', $taille );
			for($i=0; $i<$taille; $i++){
				$event = $liste[$i]['IDEVENEMENT'];
				$view->setArg('nomEvenement'.$i, UserModel::proprieteEvenement('NOM_EVENEMENT', $event) );
				$view->setArg('image'.$i, UserModel::proprieteEvenement('LIEN_IMAGE', $event) );
				$view->setArg('dateOuverture'.$i, UserModel::proprieteEvenement('DATE_OUVERTURE_EVENEMENT', $event) );
				$view->setArg('dateFermeture'.$i, UserModel::proprieteEvenement('DATE_FERMETURE_EVENEMENT', $event) );
				$view->setArg('lieu'.$i, UserModel::proprieteEvenement('ID_LIEU', $event) );
				$view->setArg('type'.$i, UserModel::proprieteEvenement('TYPE_EVENEMENT', $event) );
				$view->setArg('statut'.$i, UserModel::proprieteEvenement('STATUT_PRIVE', $event) );	
				$view->setArg('idEvenement'.$i, UserModel::proprieteEvenement('IDEVENEMENT', $event) );
			}
			$view->render();
		}
		
		public function creerEvenementAction() {
			$view = new $this->statutView($this, 'userCreerEvenement');
			$view->render();
		}
		
		public function evenementCreeAction() {
			$login = $this->user;
			$args = Request::getCurrentRequest();
			$idLieu = $args->read('lieu');
			$idEvent = $args->read('nom');
			if(!UserModel::isEventCreated($idEvent)) {
				if(!UserModel::isLieuKnown($idLieu)) {
					$lieu = UserModel::createLieu( '', $args->read('lieu'), $args->read('lieu'), '');
				}
				$event = UserModel::createEvent( $args->read('dateDeFin'), $args->read('dateDeDebut'), $args->read('lien'), $args->read('nom'), 
								$args->read('statutPrive'), $args->read('nom'), $args->read('lieu'), $args->read('type'), $args->read('nomOrganisateur'),
								$args->read('descriptionOrganisateur'), $args->read('theme'), $args->read('description'), $args->read('image'), $args->read('nombrePlaces'), $login);
				UserModel::creerElementAChoisirEvenement($args->read('nom'));
				
				if(!isset($event)) {
					$view = new $this->statutView($this,'evenementCree');
					$view->setArg('inscErrorText', 'Cannot complete creation');
					$view->render();
				}
				else{
					$view = new $this->statutView($this,'evenementCree');
					$view->render();
				}	
			}
			else{
				$view = new $this->statutView($this,'evenementAlreadyCreated');
				$view->render();
				$view = new $this->statutView($this,'userCreerEvenement');
				$view->render();
			}
		}	

		public function supprimerUnEvenementAction(){
			$args = Request::getCurrentRequest();
			$event = $args->getNameEvent();
			UserModel::supprimerEvenement($event);
			$this->gererEvenementAction();
		}	

		public function participerAction(){
			$user = $this->user; 
			if(!UserModel::participeAUnEvenement($user)){
				$view = new $this->statutView($this,'afficherAucunEvenementsInscrit');
				$view->render();
			}
			else{
				$view = new $this->statutView($this,'afficherEvenementsInscrit');
				$view->render();
				$this->afficherEvenementsParticiper();
			}			
		}
		
		public function seRetirerEvenementAction(){
			$user = $this->user;
			$args = Request::getCurrentRequest();
			$event = $args->getNameEvent();
			UserModel::seRetirerEvenement($user, $event);
			$this->evenementsAction();		
		}
		
		public function participerEvenementAction(){
			$user = $this->user; 
			$request = Request::getCurrentRequest();		
			$event = $request->getNameEvent();	
			UserModel::inscriptionEvenement($user, $event);			
			$this->afficherEvenementAction();	
		}
		
		public function afficherEvenementAction() {	
			$user = $this->user; 
			$request = Request::getCurrentRequest();		
			$event = $request->getNameEvent();	
			$view = new $this->statutView($this,'affichageEvenementAfficher');			
			$view->setArg('nomEvenement', UserModel::proprieteEvenement('NOM_EVENEMENT', $event) );
			$view->setArg('image', UserModel::proprieteEvenement('LIEN_IMAGE', $event) );
			$view->setArg('dateOuverture', UserModel::proprieteEvenement('DATE_OUVERTURE_EVENEMENT', $event) );
			$view->setArg('dateFermeture', UserModel::proprieteEvenement('DATE_FERMETURE_EVENEMENT', $event) );
			$view->setArg('lieu', UserModel::proprieteEvenement('ID_LIEU', $event) );
			$view->setArg('type', UserModel::proprieteEvenement('TYPE_EVENEMENT', $event) );
			$view->setArg('statut', UserModel::proprieteEvenement('STATUT_PRIVE', $event) );	
			$view->setArg('lien', UserModel::proprieteEvenement('LIEN_EVENEMENT', $event) );
			$view->setArg('nomOrganisateur', UserModel::proprieteEvenement('NOM_ORGANISATEUR', $event) );
			$view->setArg('descriptionOrganisateur', UserModel::proprieteEvenement('DESCRIPTION_ORGANISATEUR', $event) );	
			$view->setArg('theme', UserModel::proprieteEvenement('THEME_EVENEMENT', $event) );
			$view->setArg('description', UserModel::proprieteEvenement('DESCRIPTION_EVENEMENT', $event) );
			$view->setArg('place', UserModel::proprieteEvenement('NOMBRE_PLACES', $event) );					
			$view->render();
			
			$view = new $this->statutView($this,'actionEvenement');
			$userInscrit = userModel::isUserInscrit($user, $event);				
			$view->setArg('userInscrit', $userInscrit); 
			$view->setArg('idEvenement', $event);
			$view->render();
		}
		
		public function modifierParametreEvenementAction() {
			$request = Request::getCurrentRequest();		
			$event = $request->getNameEvent();	
			$view = new $this->statutView($this,'modifierParametreEvenement');			
			$view->setArg('nomEvenement', UserModel::proprieteEvenement('NOM_EVENEMENT', $event) );
			$view->setArg('image', UserModel::proprieteEvenement('LIEN_IMAGE', $event) );
			$view->setArg('dateOuverture', UserModel::proprieteEvenement('DATE_OUVERTURE_EVENEMENT', $event) );
			$view->setArg('dateFermeture', UserModel::proprieteEvenement('DATE_FERMETURE_EVENEMENT', $event) );
			$view->setArg('lieu', UserModel::proprieteEvenement('ID_LIEU', $event) );
			$view->setArg('type', UserModel::proprieteEvenement('TYPE_EVENEMENT', $event) );
			$view->setArg('statut', UserModel::proprieteEvenement('STATUT_PRIVE', $event) );	
			$view->setArg('lien', UserModel::proprieteEvenement('LIEN_EVENEMENT', $event) );
			$view->setArg('nomOrganisateur', UserModel::proprieteEvenement('NOM_ORGANISATEUR', $event) );
			$view->setArg('descriptionOrganisateur', UserModel::proprieteEvenement('DESCRIPTION_ORGANISATEUR', $event) );	
			$view->setArg('theme', UserModel::proprieteEvenement('THEME_EVENEMENT', $event) );
			$view->setArg('description', UserModel::proprieteEvenement('DESCRIPTION_EVENEMENT', $event) );
			$view->setArg('place', UserModel::proprieteEvenement('NOMBRE_PLACES', $event) );				
			$view->render();
		}
		
		public function modifierParametreCompteAction() {
			$login = $this->user; 
			$view = new $this->statutView($this,'modifierParametreCompte');
			$view->setArg('pseudo', $login );
			$view->setArg('nom', UserModel::proprieteUtilisateur('NOMCOMPTE', $login) );
			$view->setArg('prenom', UserModel::proprieteUtilisateur('PRENOMCOMPTE', $login) );
			$view->setArg('mail', UserModel::proprieteUtilisateur('ADRESSEMAIL', $login) );
			$view->setArg('sexe', UserModel::proprieteUtilisateur('SEXECOMPTE', $login) );
			$view->setArg('dateNaissance', UserModel::proprieteUtilisateur('DATENAISSANCECOMPTE', $login) );
			$view->setArg('adresse', UserModel::proprieteUtilisateur('ADRESSERUECOMPTE', $login) );
			$view->setArg('codePostal', UserModel::proprieteUtilisateur('ADRESSECODECOMPTE', $login) );
			$view->setArg('ville', UserModel::proprieteUtilisateur('ADRESSEVILLECOMPTE', $login) );
			$view->setArg('pays', UserModel::proprieteUtilisateur('ADRESSEPAYSCOMPTE', $login) );
			$view->render();
		}

		public function changePasswordAction() {
			$view = new $this->statutView($this, 'modifierMotDePasse');
			$view->render();
		}
		
		public function changeEmailAction() {
			$view = new $this->statutView($this,'modifierEmail');
			$view->render();
		}
		
		public function changeLoginAction() {
			$view = new $this->statutView($this,'modifierLogin');
			$view->render();
		}
				
		public function updateParametre($args) {
			UserModel::updateProprieteUtilisateur($args->read('adresse'),$args->read('codePostal'),$args->read('ville'),
							$args->read('pays'),$args->read('dateNaissance'),$args->read('nom'),$args->read('prenom'),
							$args->read('sexe'), $this->user);
			$this->monCompteAction();
		}
		
		
		public function updateMotDePasse($args) {
			$realCurrentPassword = UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $this->user);
			if ( strcmp($args->read('currentPassword'),$realCurrentPassword) != 0 ) {
				$view = new $this->statutView($this,'modifierMotDePasse');
				$view->setArg('ChangePasswordText', 'Le mot de passe que vous avez saisi ne correspond pas à celui qui est enregistré. Votre mot de passe n\'a pas été modifié. ');
				$view->render();
			}
			else {
				if ( strcmp($args->read('newPassword'),$args->read('verifiedPassword')) != 0 ) {
					$view = new $this->statutView($this,'modifierMotDePasse');
					$view->setArg('ChangePasswordText', 'La valeur du champ Répéter le mot de passe ne correspond pas à celle du champ Nouveau mot de passe. Votre mot de passe n\'a pas été modifié. ');
					$view->render();
				}
				else {
					UserModel::updatePasswordUtilisateur($args->read('newPassword'), $this->user);
					$view = new $this->statutView($this,'modifierMotDePasse');
					$view->setArg('ChangePasswordText', 'Votre mot de passe  a été modifié avec succès.');
					$view->render();
				}
			}
			
		}
		
		public function updateLogin($args) {
			$login = $args->read('newLogin');
			if(UserModel::isLoginUsed($login)) {
				$view = new $this->statutView($this,'modifierLogin');
				$view->setArg('ChangeText', 'Ce login existe déjà, veuillez choisir un autre login.');
				$view->render();
			}
			else { 
				$realCurrentPassword = UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $this->user);
				if ( strcmp($args->read('currentPasswordLogin'),$realCurrentPassword) != 0 ) {
					$view = new $this->statutView($this,'modifierLogin');
					$view->setArg('ChangeText', 'Le mot de passe que vous avez saisi ne correspond pas à celui qui est enregistré. Votre login n\'a pas été modifié. ');
					$view->render();
				}
				else {
					UserModel::updateLoginUtilisateur($args->read('newLogin'), $this->user);
					$args->write('user',$login);
					$view = new $this->statutView($this,'modifierLogin');
					$view->setArg('ChangeText', 'Votre login  a été modifié avec succès.');
					$view->render();
				}
			}		
		}
		
		public function updateEmail($args) {
			$realCurrentPassword = UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $this->user);
			if ( strcmp($args->read('currentPasswordEmail'),$realCurrentPassword) != 0 ) {
				$view = new $this->statutView($this,'modifierEmail');
				$view->setArg('ChangeText', 'Le mot de passe que vous avez saisi ne correspond pas à celui qui est enregistré. Votre e-mail n\'a pas été modifié. ');
				$view->render();
			}
			else {
				UserModel::updateEmailUtilisateur($args->read('newEmail'), $this->user);
				$view = new $this->statutView($this,'modifierEmail');
				$view->setArg('ChangeText', 'Votre e-mail  a été modifié avec succès.');
				$view->render();
			}
		}
		
		public function updateEvenementAction(){
			$args = Request::getCurrentRequest();		
			$event = $args->getNameEvent();	
			UserModel::updateEvenement($args->read('dateDeFin'),$args->read('dateDeDebut'),$args->read('lien'),
							$args->read('statutPrive'),$args->read('lieu'),$args->read('type'),$args->read('nomOrganisateur'),
							$args->read('descriptionOrganisateur'), $args->read('theme'), $args->read('description'), 
							$args->read('lienImage'), $args->read('nombrePlaces'), $event);
			$this->gererEvenementAction();	
		}

		public function deconnexionAction() {
			session_unset();
			session_destroy();
			header('Location: index.php');
		}
		
	}
		
?>
