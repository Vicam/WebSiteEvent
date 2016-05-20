<?php
	class AnonymousController extends Controller {
		
		public function __construct($request){
			parent::__construct($request);
			if (strcmp($request->read('inscLogin'),'default') != 0) {
				$this->validateInscription($request);
			}
			else if (strcmp($request->read('connexionLogin'),'default') != 0) {
				$this->connexion($request);
			}
			else {
				$this->execute();
			}
			
		}
		
		public function defaultAction() {
			$view = new AnonymousView($this, 'index'); //renderCurrentViewWith('index', array('user' => $this->user))
			$view ->render();
		}
		
		public function inscriptionAction() {
			$view = new AnonymousView($this, 'inscription');
			$view ->render();
		}
		
		public function identificationAction() {
			$view = new AnonymousView($this, 'identification');
			$view ->render();
		}
		
		public function evenementsAction() {
			$view = new AnonymousView($this, 'evenements');
			$view->render();
			$view = new AnonymousView($this, 'evenementsAnonymous');
			$view->render();
			$liste = UserModel::listeEvenementPublic();
			$taille = count($liste);
			$view = new AnonymousView($this, 'affichageEvenement');
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
		
		public function participerEvenementAction() {
			$view = new AnonymousView($this, 'participerEvenement');
			$view->render();
			$view = new AnonymousView($this, 'identification');
			$view ->render();
		}
		
		public function connexion($args) {
			$login = $args->read('connexionLogin');	
			$password = $args->read('connexionPassword');
			if(UserModel::isLoginUsed($login)) {
				$realpassword = UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $login);
				if (strcmp($password,$realpassword) != 0) {
					$view = new AnonymousView($this,'identification');
					$view->setArg('inscErrorText', 'Votre login ou mot de passe est incorrect');
					$view->render();
				}
				else {
					$statutCompte = UserModel::proprieteUtilisateur('STATUTCOMPTE', $login);
					$newRequest = Request::getCurrentRequest();
					$newRequest->write('controller', $statutCompte);
					$newRequest->write('user',$login);
					$controller = Dispatcher::getCurrentDispatcher()->dispatch($newRequest);
				}
			}
			else {
				$view = new AnonymousView($this,'identification');
				$view->setArg('inscErrorText', 'Votre login ou mot de passe est incorrect');
				$view->render();
			}	
		}
		
		public function afficherEvenementAction() {	
			$request = Request::getCurrentRequest();		
			$event = $request->getNameEvent();	
			$view = new AnonymousView($this,'affichageEvenementAfficher');			
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
			$view->setArg('idEvenement', UserModel::proprieteEvenement('IDEVENEMENT', $event) );	
			$view->render();
		}
		
		public function validateInscription($args) {
			$login = $args->read('inscLogin');
			if(UserModel::isLoginUsed($login)) {
				$view = new AnonymousView($this,'inscription');
				$view->setArg('inscErrorText','Ce login est déjà utilisé');
				$view->render();
			} 
			else {
				$user = UserModel::createAccount($args->read('adresse'),$args->read('codePostal'),$args->read('ville'),
							$args->read('pays'),$args->read('dateNaissance'),$args->read('nom'),$args->read('prenom'),
							$args->read('sexe'), $args->read('inscLogin'), "user", $args->read('mail'), $args->read('inscPassword'));

			}
			if(!isset($user)) {
				$view = new AnonymousView($this,'inscription');
				$view->setArg('inscErrorText', 'Impossible de compléter l\'inscription');
				$view->render();
			} 
			else {
				$newRequest = Request::getCurrentRequest();
				$newRequest->write('controller','user');
				$newRequest->write('user',$login);
				$controller = Dispatcher::getCurrentDispatcher()->dispatch($newRequest);
			}
		}
		
		public function evenement (){
			$view = new AnonymousView($this, 'evenement');
			$view ->render();	
		}
		
		public function passwordOublieAction() {
			$contact = 'victor.ambonati@minesdedouai.fr ou alexandre.vidal@minesdedouai.fr'; //prendre dans la bd plus tard 
			$view = new AnonymousView($this,'passwordOublie');
			$view->setArg('contact', $contact);
			$view->render();
		}	
	}
		
?>
