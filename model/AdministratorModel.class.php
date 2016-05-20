<?php
	class AdministratorModel extends Model {
		
		public static function listeCompte() {
			$array = array();
			$query = Model::query('SELECT IDCOMPTE FROM COMPTE');
			Model::executeQuery($query, $array);
			$table = $query->fetchAll();
			return $table;
		}
		
		public static function updateProprieteUtilisateur ($rue, $codePostal, $ville, $pays, $dateNaissance, $nom, $prenom, $sexe, $idnew, $statut, $password, $email, $idcurrent) {
			$array = array($rue, $codePostal, $ville, $pays, $dateNaissance, $nom, $prenom, $sexe, $idnew, $statut, $password, $email, $idcurrent);
			$query = Model::query('UPDATE COMPTE SET ADRESSERUECOMPTE = ?, ADRESSECODECOMPTE = ?, ADRESSEVILLECOMPTE = ?, 
				ADRESSEPAYSCOMPTE = ?, DATENAISSANCECOMPTE = ?, NOMCOMPTE = ?, PRENOMCOMPTE = ?, SEXECOMPTE = ?, IDCOMPTE = ?, 
				STATUTCOMPTE = ?, PASSWORDCOMPTE = ?, ADRESSEMAIL = ? WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
		}
		
		public static function supprimerUtilisateur ($id){
			$array = array($id);
			$query = Model::query('UPDATE GERER SET IDCOMPTE = \'SuperAdmin\' WHERE IDCOMPTE = ?');
			Model::executeQuery($query, $array);
			
			$query2 = Model::query('DELETE FROM COMPTE WHERE IDCOMPTE= ?');
			Model::executeQuery($query2, $array);
		}
	}
?>
