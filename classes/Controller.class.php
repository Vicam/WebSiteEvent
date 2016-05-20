<?php
	abstract class Controller extends MyObject {
		protected $request = NULL;
		
		public function __construct($request){
			$this->request = $request;
			// $this->viewClassName = $this->defaultViewController;
		}
		public abstract function defaultAction();
			
		public function execute(){
			$name = $this->request->getNameActionRequest()."Action";
			if (method_exists($this, $name)){
				$this->$name();
			}
			else {
				$this->defaultAction();
			}
		}
		
		public function executeWithRequest($request) {
			$name = $this->request->getNameActionRequest()."Action";
			if (method_exists($this, $name)){
				$this->$name($request);
			}
			else {
				$this->defaultAction();
			}
		}
	}
?>
