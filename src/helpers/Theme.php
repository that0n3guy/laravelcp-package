<?php namespace Gcphost\Laravelcp\Helpers;

use  View, Config, Setting, Filesystem;

class Theme {
	static private $tables=array();
	static private $actions=array();
	static private $path;
	

	private function getTemplates(){
		$fileSystem = new Filesystem;
		$files=$fileSystem->allFiles($path[0]);
		return $files;
	}

	static public function path($file){
		return self::exists($file) ? : $file;
	}

	static private function exists($file){
		$ext = pathinfo($file);

		$theme=self::getTheme();

		$check_file=!isset($ext['extension']) ? $file.'.blade.php': $file;
		$check=self::view_path().DIRECTORY_SEPARATOR.$theme.DIRECTORY_SEPARATOR.$check_file;
		return is_file($check) ?$theme.DIRECTORY_SEPARATOR.$file : self::checkPackage(self::theme().DIRECTORY_SEPARATOR.$file);
	}

	static public function make($file, $data=array()){
		return Api::make($data) ? : View::make(self::path($file), $data);
	}
	
	static public function checkPackage($file){
		return View::exists('Laravelcp::'.$file) ? 'Laravelcp::'.$file : false;
	}

	static public function getTheme(){
		return is_dir(self::view_path().DIRECTORY_SEPARATOR.self::theme()) ? self::theme() : false;
	}

	static public function theme(){
		return Setting::get('site.theme');
	}

	static private function view_path(){
		$path=Config::get('view.paths');
		return $path[0];
	}

	static private function package_path(){
		return 'packages'.DIRECTORY_SEPARATOR.'gcphost'.DIRECTORY_SEPARATOR.'laravelcp';
	}

}