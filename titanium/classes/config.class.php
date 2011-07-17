<?php if(!defined('TITANIUM_CLI')) { exit; }

class Config
{
	protected static $configs = array();
	
	/**
	 * Load a specified config file
	 *
	 * @access public
	 * @param string $config_file
	 * @return void
	 */
	public static function load($config_file)
	{
		if(!$config_file)
		{
			throw new Exception('A valid config file name is required to load from.');
			
			exit;
		}
		
		$file = TITANIUM_ROOT.'config/'.$config_file.'.php';		
		
		if(file_exists($file))
		{
			$configs = require($file);
			
			foreach($configs as $k => $v)
			{
				self::add_config($k, $v);
			}
		}
	}
	
	/**
	 * Add an item to the config array
	 *
	 * @access public
	 * @param string $k
	 * @param mixed $v
	 * @return void
	 */
	public function add_config($k, $v)
	{
		self::$configs[$k] = $v;
	}
	
	/**
	 * Retrieve a config item
	 *
	 * @access public
	 * @param string $k
	 * @param mixed $default
	 * @return mixed
	 */
	public function item($k, $default = FALSE)
	{
		if(isset(self::$configs[$k]))
		{
			return self::$configs[$k];
		}
		else
		{
			return $default;
		}
	}
	
} // EOC