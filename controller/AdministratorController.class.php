<?php
	class AdministratorController extends UserController {
		
		public function __construct($request){
			$this->request = $request;
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
			else if ( strcmp($request->getNameCompte(),'default') != 0 ) {
				if ( UserModel::isLoginUsed($request->getNameCompte()) ){
					$this->executeWithRequest($request);
				}
				else {
					$this->gererCompteAction();
				}
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
			$view = new $this->statutView($this, 'administratorIndex'); 
			$view->setArg('pseudo', $this->user );
			$view ->render();
		}
		
		public function gererCompteAction($changement=NULL) {
			$liste = AdministratorModel::listeCompte();
			$taille = count($liste);
			$view = new $this->statutView($this, 'affichageReduitComptes');
			$view->setArg('changement', $changement );
			$view->setArg('taille', $taille );
			for($i=0; $i<$taille; $i++){
				$compte = $liste[$i]['IDCOMPTE'];
				$view->setArg('pseudo'.$i, UserModel::proprieteUtilisateur('IDCOMPTE', $compte) );
				$view->setArg('password'.$i, UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $compte) );
				$view->setArg('statut'.$i, UserModel::proprieteUtilisateur('STATUTCOMPTE', $compte) );
				$view->setArg('mail'.$i, UserModel::proprieteUtilisateur('ADRESSEMAIL', $compte) );
				$view->setArg('nom'.$i, UserModel::proprieteUtilisateur('NOMCOMPTE', $compte) );
				$view->setArg('prenom'.$i, UserModel::proprieteUtilisateur('PRENOMCOMPTE', $compte) );
				$view->setArg('sexe'.$i, UserModel::proprieteUtilisateur('SEXECOMPTE', $compte) );	
				$view->setArg('dateNaissance'.$i, UserModel::proprieteUtilisateur('DATENAISSANCECOMPTE', $compte) );
				$view->setArg('adresse'.$i, UserModel::proprieteUtilisateur('ADRESSERUECOMPTE', $compte) );	
				$view->setArg('codePostal'.$i, UserModel::proprieteUtilisateur('ADRESSECODECOMPTE', $compte) );
				$view->setArg('ville'.$i, UserModel::proprieteUtilisateur('ADRESSEVILLECOMPTE', $compte) );
				$view->setArg('pays'.$i, UserModel::proprieteUtilisateur('ADRESSEPAYSCOMPTE', $compte) );													
			}
			$view->render();
		}
		
		public function gererComptePlusAction() {
			$liste = AdministratorModel::listeCompte();
			$taille = count($liste);
			$view = new $this->statutView($this, 'affichageCompletComptes');
			$view->setArg('taille', $taille );
			for($i=0; $i<$taille; $i++){
				$compte = $liste[$i]['IDCOMPTE'];
				$view->setArg('pseudo'.$i, UserModel::proprieteUtilisateur('IDCOMPTE', $compte) );
				$view->setArg('password'.$i, UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $compte) );
				$view->setArg('statut'.$i, UserModel::proprieteUtilisateur('STATUTCOMPTE', $compte) );
				$view->setArg('mail'.$i, UserModel::proprieteUtilisateur('ADRESSEMAIL', $compte) );
				$view->setArg('nom'.$i, UserModel::proprieteUtilisateur('NOMCOMPTE', $compte) );
				$view->setArg('prenom'.$i, UserModel::proprieteUtilisateur('PRENOMCOMPTE', $compte) );
				$view->setArg('sexe'.$i, UserModel::proprieteUtilisateur('SEXECOMPTE', $compte) );	
				$view->setArg('dateNaissance'.$i, UserModel::proprieteUtilisateur('DATENAISSANCECOMPTE', $compte) );
				$view->setArg('adresse'.$i, UserModel::proprieteUtilisateur('ADRESSERUECOMPTE', $compte) );	
				$view->setArg('codePostal'.$i, UserModel::proprieteUtilisateur('ADRESSECODECOMPTE', $compte) );
				$view->setArg('ville'.$i, UserModel::proprieteUtilisateur('ADRESSEVILLECOMPTE', $compte) );
				$view->setArg('pays'.$i, UserModel::proprieteUtilisateur('ADRESSEPAYSCOMPTE', $compte) );													
			}
			$view->render();
		}
		
		
		public function voirUnCompteAction($args, $changement=NULL) {
			$compte = $args->getNameCompte();
			$view = new $this->statutView($this, 'unCompte'); 
			$view->setArg('changement', $changement );
			$view->setArg('pseudo', $compte );
			$view->setArg('statut', UserModel::proprieteUtilisateur('STATUTCOMPTE', $compte) );
			$view->setArg('password', UserModel::proprieteUtilisateur('PASSWORDCOMPTE', $compte) );
			$view->setArg('email', UserModel::proprieteUtilisateur('ADRESSEMAIL', $compte) );
			$view->setArg('nom', UserModel::proprieteUtilisateur('NOMCOMPTE', $compte) );
			$view->setArg('prenom', UserModel::proprieteUtilisateur('PRENOMCOMPTE', $compte) );
			$view->setArg('sexe', UserModel::proprieteUtilisateur('SEXECOMPTE', $compte) );
			$view->setArg('dateNaissance', UserModel::proprieteUtilisateur('DATENAISSANCECOMPTE', $compte) );
			$view->setArg('adresse', UserModel::proprieteUtilisateur('ADRESSERUECOMPTE', $compte) );
			$view->setArg('codePostal', UserModel::proprieteUtilisateur('ADRESSECODECOMPTE', $compte) );
			$view->setArg('ville', UserModel::proprieteUtilisateur('ADRESSEVILLECOMPTE', $compte) );
			$view->setArg('pays', UserModel::proprieteUtilisateur('ADRESSEPAYSCOMPTE', $compte) );
			$view ->render();
		}
		
		public function updateParametreCompteAction($args) {
			$compte = $args->getNameCompte();
			$newid = $args->read('login');
			if ( !UserModel::isLoginUsed($newid) || strcmp($compte,$newid) == 0){
				AdministratorModel::updateProprieteUtilisateur($args->read('adresse'), $args->read('codePostal'),
					$args->read('ville'), $args->read('pays'), $args->read('dateNaissance'), $args->read('nom'), $args->read('prenom'),
					$args->read('sexe'), $newid, $args->read('statut'), 
					$args->read('password'), $args->read('email'), $compte );

				$args->writeNameCompte($newid);
				$this->voirUnCompteAction($args, 'Les paramètres ont été modifiés avec succès');
			}
			else {
				AdministratorModel::updateProprieteUtilisateur($args->read('adresse'),$args->read('codePostal'),
					$args->read('ville'),$args->read('pays'),$args->read('dateNaissance'),$args->read('nom'),$args->read('prenom'),
					$args->read('sexe'), $compte, $args->read('statut'), 
					$args->read('password'), $args->read('email'), $compte );
				$this->voirUnCompteAction($args, 'Ce nouveau login est déjà utilisé. Les autres paramètres ont été modifiés avec succès');
			}	
		}
		
		public function supprimerUnCompteAction($args) {
			$compte = $args->getNameCompte();
			AdministratorModel::supprimerUtilisateur($compte);
			$message = "Le compte $compte a été supprimé";
			$this->gererCompteAction($message);
		}
		
	}
		
?>
