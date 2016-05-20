<?php
	// Load my root class
	require_once(__ROOT_DIR . '/classes/MyObject.class.php');

	class AutoLoader extends MyObject {
		public function __construct() {
			spl_autoload_register(array($this, 'load'));
		}
		// This method will be automatically executed by PHP whenever it encounters
		// an unknown class name in the source code

		private function load($className) {
			$folders = array('classes', 'controller', 'model', 'view');
			foreach ($folders as $folder) {
				if (is_readable(__ROOT_DIR . '/' . $folder . '/' . ucfirst($className) . '.class.php')){
					require_once(__ROOT_DIR . '/' . $folder . '/' . ucfirst($className) . '.class.php');
					//example: require_once(__ROOT_DIR . '/classes/Request.class.php';)
				}
			}
		}
	}
	$__LOADER = new AutoLoader();
?>
