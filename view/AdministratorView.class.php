<?php

	class AdministratorView extends View {
		
		public function __construct($controller,$templateName, $args=array()) {
			parent::__construct($controller,$templateName,$args);
			$this->templateNames['head'] = 'userHead';
			$this->templateNames['menu'] = 'administratorMenu';
		}
	}
?>
