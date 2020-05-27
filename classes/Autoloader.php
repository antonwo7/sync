<?php
Class Autoloader{
	public static function register(){
		
		spl_autoload_register(function($class){
			$directory = 'classes/';
			$file = $directory.$class.'.php';
			if(file_exists($file)){
				require $file;
				return true;
			}
			return false;
		});
	}
}
?>