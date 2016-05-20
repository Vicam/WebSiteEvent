<?php
	class DatabasePDO extends PDO {
		
		protected $db_connection = NULL;
		protected static $singletonPDO = NULL;
		
		
		public function __construct(){

			$DB_HOST = 'localhost';
			$DB_NAME = 'web01';
			$DB_USER = 'root';
			$DB_PWD = 'root';
					

			try{
				$this->db_connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, 
				DB_USER, 
				DB_PWD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
			catch(Exception $e){
				die('Error while connecting to MySQL.\n');
			}
		
		}
		
		public static function getCurrentDatabasePDO(){
			if (is_null(static::$singletonPDO)) {
				static::$singletonPDO = new static();
			}
			return static::$singletonPDO;
		}
		
		public function getConnection() {
			return $this->db_connection;
		}

		
	}
?>
