<?php
	
	class Request extends MyObject {
		
		protected static $singleton = NULL;
		
		public static function getCurrentRequest(){
			if (is_null(static::$singleton)) {
				static::$singleton = new static();
			}
			return static::$singleton;
		}
		
		public static function getNameController(){
			if(isset($_SESSION['controller'])){
				return ucfirst($_SESSION['controller']);
			}
			else {
				return 'Anonymous';
			}
		}
		
		public static function getNameActionRequest(){
			if(isset($_GET['action'])){
				return $_GET['action'];
			}
			else {
				return 'default';
			}			
		}
		
		public static function getNameUser(){
			if(isset($_SESSION['user'])){
				return ucfirst($_SESSION['user']);
			}
			else {
				return 'Anonymous';
			}
		}	
		
		public static function getNameCompte(){
			if(isset($_GET['compte'])){
				return ucfirst($_GET['compte']);
			}
			else {
				return 'default';
			}
		}
		
		public static function getNameEvent(){
			if(isset($_GET['event'])){
				return ucfirst($_GET['event']);
			}
			else {
				return 'default';
			}
		}
		
		public static function writeNameCompte($newCompte){
			$_GET['compte'] = $newCompte;
		}
		
		public function read($string){
			if(isset($_POST[$string])){
				return $_POST[$string];
			}
			else {
				return 'default';
			}			
		}
		
		// à modifier
		public function write($var, $value){ 
			$_SESSION[$var] = $value;		
		}

	
		
	}
		
		
?>
