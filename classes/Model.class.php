<?php
	define("PARAM_COMPTE", "(ADRESSERUECOMPTE, ADRESSECODECOMPTE, ADRESSEVILLECOMPTE, ADRESSEPAYSCOMPTE,
						DATENAISSANCECOMPTE, NOMCOMPTE, PRENOMCOMPTE, SEXECOMPTE, IDCOMPTE, STATUTCOMPTE, ADRESSEMAIL, PASSWORDCOMPTE)"); 
	
	define("PARAM_EVENT", "(DATE_FERMETURE_EVENEMENT, DATE_OUVERTURE_EVENEMENT, LIEN_EVENEMENT, NOM_EVENEMENT, STATUT_PRIVE, IDEVENEMENT, 
					ID_LIEU, TYPE_EVENEMENT, NOM_ORGANISATEUR, DESCRIPTION_ORGANISATEUR, THEME_EVENEMENT, DESCRIPTION_EVENEMENT, LIEN_IMAGE, NOMBRE_PLACES)"); 
					
	define("PARAM_LIEU", "(accessible_handicapes, ID_lieu, adresse, description_lieu )"); 

	define("PARAM_GERER", "(IDCOMPTE, IDEVENEMENT)");
	
	define("PARAM_INSCRIPTION", "(IDCOMPTE)");
	
	define("PARAM_DEMANDE", "(IDINSCRIPTION, IDELEMENTACHOISIR)");
	
	define("ELEMENT_A_CHOISIR_EVENEMENT", "(IDEVENEMENT)");
	
	
	class Model extends MyObject {

		public static function query($sql) {
			$query = null;
			$singletonPDO = DatabasePDO::getCurrentDatabasePDO();
			if( ! is_null($singletonPDO) ){
				$query = $singletonPDO->getConnection()->prepare($sql);
			}
			return $query;	
		}
		
		public static function executeQuery($query, $values) {
				$query->execute($values);
		}
			
	}
		
?>

