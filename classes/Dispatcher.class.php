<?php
	class Dispatcher extends MyObject {
		
		protected static $singletonDispatcher = NULL;
		
		public static function getCurrentDispatcher(){
			if (is_null(static::$singletonDispatcher)) {
				static::$singletonDispatcher = new static();
			}
			return static::$singletonDispatcher;
		}
		
		public function dispatch ($request) {
			$name = null;
			$name = $request->getNameController()."Controller"; 			
			if (class_exists($name)){
				$controller = new $name($request);
			}
			else {
				$controller = new AnonymousController($request);
			}
			return $controller;
		}

		
	}
		
?>
