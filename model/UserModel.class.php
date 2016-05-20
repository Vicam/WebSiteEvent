<?php
	class UserModel extends Model {
		
		public static function isLoginUsed($login){
			$query = Model::query ('SELECT IDCOMPTE FROM COMPTE  WHERE IDCOMPTE = ?');	
			$array = array($login);
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			if ($table) {
					return true;
				}
			else {
				return false;
			}
		}
		
		public static function isEventCreated($idEvent){
			$query = Model::query ('SELECT IDEVENEMENT FROM EVENEMENT  WHERE IDEVENEMENT = ?');	
			$array = array($idEvent);
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			if ($table) {
					return true;
				}
			else {
				return false;
			}
		}
		
		public static function isLieuKnown($idLieu){
			$query = Model::query ('SELECT ID_LIEU FROM LIEU WHERE ID_LIEU = ?');	
			$array = array($idLieu);
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			if ($table) {
					return true;
				}
			else {
				return false;
			}
		}
		
		public static function isUserInscrit($user, $event){
			$result=array();
			$query = Model::query('SELECT IDINSCRIPTION FROM INSCRIPTION WHERE IDCOMPTE = ?');
			$array = array($user);
			Model::executeQuery($query, $array);
			$idInscriptions = $query->fetchAll();
			
			$nombreInscriptions = count($idInscriptions);
			for($i=0; $i<$nombreInscriptions; $i++){
				$idInscription = $idInscriptions[$i]['IDINSCRIPTION'];
				$array = array($idInscription);
				$query = Model::query('SELECT IDELEMENTACHOISIR FROM DEMANDE WHERE IDINSCRIPTION = ?');
				Model::executeQuery($query, $array);
				$table = $query->fetch();
				$idElementAChoisir = $table['IDELEMENTACHOISIR'];
				$array = array($idElementAChoisir, $event);
				$query = Model::query('SELECT IDEVENEMENT FROM ELEMENT_A_CHOISIR_EVENEMENT WHERE IDELEMENTACHOISIR = ? AND IDEVENEMENT = ?');
				Model::executeQuery($query, $array);
				$table2 = $query->fetch();
				$idEvent = $table2['IDEVENEMENT'];
				if(isset($idEvent)){
					array_push($result, $idEvent);
				}				
			}		
			$table = Array ();
			if ($result!=$table) {
					return true;
				}
			else {
				return false;
			}	
		}
		
		public static function participeAUnEvenement($id){
			$query = Model::query ('SELECT IDINSCRIPTION FROM INSCRIPTION WHERE IDCOMPTE = ?');	
			$array = array($id);
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			if ($table) {
					return true;
				}
			else {
				return false;
			}	
		}
		
		public static function  createAccount($rue, $codePostal, $ville, $pays, $dateNaissance, $nom, $prenom, $sexe, $id ,$statut, $mail, $password){
			$query = Model::query('INSERT  INTO COMPTE '.PARAM_COMPTE.'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$array = array( $rue, $codePostal, $ville, $pays, $dateNaissance,$nom, $prenom, $sexe, $id, $statut, $mail, $password);
			Model::executeQuery($query, $array);
			
			$query2 = Model::query ('SELECT IDCOMPTE FROM COMPTE  WHERE IDCOMPTE = ?');	
			$array2 = array($id);
			Model::executeQuery($query2, $array2);
			$table = $query2->fetchAll (databasePDO::FETCH_CLASS, 'UserModel');
			return $table;
		}
		
		public static function creerElementAChoisirEvenement($idEvent){	
			$query = Model::query('INSERT  INTO ELEMENT_A_CHOISIR_EVENEMENT '.ELEMENT_A_CHOISIR_EVENEMENT.' VALUES (?)');
			$array = array($idEvent);
			Model::executeQuery($query, $array);
		}
		
		public static function  createEvent($dateDeFin, $dateDeDebut, $lien, $nom, $statutPrive, $idEvent, $lieu, $type, $nomOrganisateur, $descriptionOrganisateur, $theme, $description, $lienImage, $nombrePlaces, $id){
			$query = Model::query('INSERT  INTO EVENEMENT '.PARAM_EVENT.' VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$array = array($dateDeFin, $dateDeDebut, $lien, $nom, $statutPrive, $idEvent, $lieu, $type, $nomOrganisateur, $descriptionOrganisateur, $theme, $description, $lienImage, $nombrePlaces);
			Model::executeQuery($query, $array);
			
			$query3 = Model::query('INSERT  INTO GERER (IDCOMPTE, IDEVENEMENT) VALUES (?, ?)');
			$array3 = array($id, $idEvent);
			Model::executeQuery($query3, $array3);
			
			$query2 = Model::query ('SELECT IDEVENEMENT FROM EVENEMENT WHERE IDEVENEMENT = ?');	
			$array2 = array($idEvent);
			Model::executeQuery($query2, $array2);
			$table = $query2->fetchAll (databasePDO::FETCH_CLASS, 'UserModel');
			return $table;
		}
		
		public static function  createLieu( $accessible_handicapes, $ID_lieu, $adresse, $description_lieu){
			$query = Model::query('INSERT  INTO LIEU '.PARAM_LIEU.' VALUES (?, ?, ?, ?)');
			$array = array( $accessible_handicapes, $ID_lieu, $adresse, $description_lieu);
			Model::executeQuery($query, $array);
			
			$query2 = Model::query ('SELECT ID_LIEU FROM LIEU WHERE ID_LIEU = ?');	
			$array2 = array($ID_lieu);
			Model::executeQuery($query2, $array2);
			$table = $query2->fetchAll (databasePDO::FETCH_CLASS, 'UserModel');
			return $table;
		}
		
		public static function updateProprieteUtilisateur ($rue, $codePostal, $ville, $pays, $dateNaissance, $nom, $prenom, $sexe,$id) {
			$array = array($rue, $codePostal, $ville, $pays, $dateNaissance, $nom, $prenom, $sexe, $id);
			$query = Model::query('UPDATE COMPTE SET ADRESSERUECOMPTE = ?, ADRESSECODECOMPTE = ?, ADRESSEVILLECOMPTE = ?, 
				ADRESSEPAYSCOMPTE = ?, DATENAISSANCECOMPTE = ?, NOMCOMPTE = ?, PRENOMCOMPTE = ?, SEXECOMPTE = ? WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
		}
		
		public static function updatePasswordUtilisateur ($value, $utilisateur) {
			$array = array($value, $utilisateur);
			$query = Model::query('UPDATE COMPTE SET PASSWORDCOMPTE = ? WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
		}
		
		public static function updateLoginUtilisateur ($value, $utilisateur) {
			$array = array($value, $utilisateur);
			$query = Model::query('UPDATE COMPTE SET IDCOMPTE = ? WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
		}
		
		public static function updateEmailUtilisateur ($value, $utilisateur) {
			$array = array($value, $utilisateur);
			$query = Model::query('UPDATE COMPTE SET ADRESSEMAIL = ? WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
		}
		public static function proprieteUtilisateur($propriete, $utilisateur) {
			$array = array($utilisateur);
			$query = Model::query('SELECT * FROM COMPTE WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			return $table[$propriete];
		}
		
		public static function proprieteEvenement($propriete, $evenement) {
			$array = array($evenement);
			$query = Model::query('SELECT * FROM EVENEMENT WHERE IDEVENEMENT = ?');
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			return $table[$propriete];
		}
		
		public static function listeEvenementGestion (){
			$array = array();
			$query = Model::query('SELECT IDEVENEMENT FROM EVENEMENT');
			Model::executeQuery($query, $array);
			$table = $query->fetchAll();
			return $table;
		}
		
		public static function listeEvenement() {
			$array = array();
			$query = Model::query('SELECT IDEVENEMENT FROM EVENEMENT WHERE DATE_OUVERTURE_EVENEMENT > NOW() ORDER BY DATE_OUVERTURE_EVENEMENT ASC');
			Model::executeQuery($query, $array);
			$table = $query->fetchAll();
			return $table;
		}
		
		public static function listeEvenementsUser($user) {
			$array = array($user);
			$query = Model::query('SELECT IDEVENEMENT FROM GERER WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
			$table = $query->fetchAll();
			return $table;
		}
		
		public static function listeEvenementPublic() {
			$array = array();
			$query = Model::query('SELECT IDEVENEMENT FROM EVENEMENT WHERE STATUT_PRIVE = 0 AND DATE_OUVERTURE_EVENEMENT > NOW() ORDER BY DATE_OUVERTURE_EVENEMENT ASC');
			Model::executeQuery($query, $array);
			$table = $query->fetchAll();
			return $table;
		}
		
		public static function  updateEvenement($dateDeFin, $dateDeDebut, $lien, $statutPrive, $lieu, $type, $nomOrganisateur, $descriptionOrganisateur, $theme, $description, $lienImage, $nombrePlaces, $id){
			$query = Model::query('UPDATE EVENEMENT SET DATE_FERMETURE_EVENEMENT = ?, DATE_OUVERTURE_EVENEMENT = ?, LIEN_EVENEMENT = ?,
						STATUT_PRIVE = ?, ID_LIEU = ?, TYPE_EVENEMENT = ?, NOM_ORGANISATEUR = ?, 
						DESCRIPTION_ORGANISATEUR = ?, THEME_EVENEMENT = ?, DESCRIPTION_EVENEMENT = ?, LIEN_IMAGE = ?, NOMBRE_PLACES = ? WHERE IDEVENEMENT = ?');
			$array = array($dateDeFin, $dateDeDebut, $lien, $statutPrive, $lieu, $type, $nomOrganisateur, $descriptionOrganisateur, $theme, $description, $lienImage, $nombrePlaces, $id);
			Model::executeQuery($query, $array);
		}
		
		public static function supprimerEvenement ($idEvent){
			
			
			$array = array($idEvent);
			$query = Model::query('SELECT IDELEMENTACHOISIR FROM ELEMENT_A_CHOISIR_EVENEMENT WHERE IDEVENEMENT = ?');
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			$idElementAChoisir = $table['IDELEMENTACHOISIR'];
			
			$array2 = array($idElementAChoisir);
			$query2 = Model::query('SELECT IDINSCRIPTION FROM DEMANDE WHERE IDELEMENTACHOISIR = ?');
			Model::executeQuery($query2, $array2);
			$table = $query2->fetch();
			$idinscription = $table['IDINSCRIPTION'];
			
			$array3 = array($idinscription);
			$query12 = Model::query('DELETE FROM INSCRIPTION WHERE IDINSCRIPTION = ?');
			Model::executeQuery($query12, $array3);
			
			$query13 = Model::query('DELETE FROM DEMANDE WHERE IDINSCRIPTION = ?');
			Model::executeQuery($query13, $array3);
						
			$array11 = array($idEvent);
			
			$query11 = Model::query('DELETE FROM ELEMENT_A_CHOISIR_EVENEMENT WHERE IDEVENEMENT = ?');
			Model::executeQuery($query11, $array11);
			
			$query12 = Model::query('DELETE FROM GERER WHERE IDEVENEMENT = ?');
			Model::executeQuery($query12, $array11);
			
			$query13 = Model::query('DELETE FROM EVENEMENT WHERE IDEVENEMENT= ?');
			Model::executeQuery($query13, $array11);
		}
		
		public static function seRetirerEvenement($id, $event){
			$array = array($event);
			$query = Model::query('SELECT IDELEMENTACHOISIR FROM ELEMENT_A_CHOISIR_EVENEMENT WHERE IDEVENEMENT = ?');
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			$idElementAChoisir = $table['IDELEMENTACHOISIR'];
			
			$array2 = array($idElementAChoisir);
			$query2 = Model::query('SELECT IDINSCRIPTION FROM DEMANDE WHERE IDELEMENTACHOISIR = ?');
			Model::executeQuery($query2, $array2);
			$table = $query2->fetch();
			$idinscription = $table['IDINSCRIPTION'];
			
			$array3 = array($idinscription);
			$query12 = Model::query('DELETE FROM INSCRIPTION WHERE IDINSCRIPTION = ?');
			Model::executeQuery($query12, $array3);
			
			$query13 = Model::query('DELETE FROM DEMANDE WHERE IDINSCRIPTION = ?');
			Model::executeQuery($query13, $array3);
						
		}

		public static function creerInscription($id){	
			$query = Model::query('INSERT  INTO INSCRIPTION '.PARAM_INSCRIPTION.' VALUES (?)');
			$array = array($id);
			Model::executeQuery($query, $array);
			
			$query = Model::query('SELECT MAX(IDINSCRIPTION) FROM INSCRIPTION WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			return $table['MAX(IDINSCRIPTION)'];
		}
		
		public static function creerDemande($id, $idElementAChoisir,  $idInscription){	
			$query = Model::query('INSERT  INTO DEMANDE '.PARAM_DEMANDE.' VALUES (?, ?)');
			$array2 = array($idInscription, $idElementAChoisir);
			Model::executeQuery($query, $array2);			
		}
		
		public static function inscriptionEvenement($id, $event){	
			$idInscription = UserModel::creerInscription($id);			
			$query = Model::query('SELECT IDELEMENTACHOISIR FROM ELEMENT_A_CHOISIR_EVENEMENT WHERE IDEVENEMENT = ?');
			$array = array($event);
			Model::executeQuery($query, $array);
			$table = $query->fetch();
			$idElementAChoisir = $table['IDELEMENTACHOISIR'];
			
			UserModel::creerDemande($id, $idElementAChoisir, $idInscription);
		}
		
		public static function listeEvenementsParticiperUser($user){	
			$result = array();
			$query = Model::query('SELECT IDINSCRIPTION FROM INSCRIPTION WHERE IDCOMPTE = ?');
			$array = array($user);
			Model::executeQuery($query, $array);
			$idInscriptions = $query->fetchAll();
			
			$nombreInscriptions = count($idInscriptions);
			for($i=0; $i<$nombreInscriptions; $i++){
				$idInscription = $idInscriptions[$i]['IDINSCRIPTION'];
				$array = array($idInscription);
				$query = Model::query('SELECT IDELEMENTACHOISIR FROM DEMANDE WHERE IDINSCRIPTION = ?');
				Model::executeQuery($query, $array);
				$table = $query->fetch();
				$idElementAChoisir = $table['IDELEMENTACHOISIR'];
				$array = array($idElementAChoisir);
				$query = Model::query('SELECT IDEVENEMENT FROM ELEMENT_A_CHOISIR_EVENEMENT WHERE IDELEMENTACHOISIR = ?');
				Model::executeQuery($query, $array);
				$table2 = $query->fetch();
				$idEvent = $table2['IDEVENEMENT'];
				array_push($result, $idEvent);
			}			
			return $result;			
		}
	}
		
?>
