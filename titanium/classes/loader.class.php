<?php if(!defined('TITANIUM_CLI')) { exit; }

class Loader
{	
	/**
	 * Load a class from the vendors directory
	 *
	 * @access public
	 * @param  string $filename
	 * @return void
	 */
	public static function load($filename)
	{	
		if(!$filename)
		{
			throw new Exception('A valid file name is required to load from.');
			
			exit;
		}	

		$file = TITAMIUM_ROOT.'vendors/'.$filename;

		if(file_exists($file))
		{
			require_once($file);
			
			Titanium::add_loaded_class($file);
		}
	}
	
} // EOC