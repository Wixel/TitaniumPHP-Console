<?php if(!defined('TITANIUM_CLI')) { exit; }

class Titanium
{
	const VERSION 				   = '0.5';
	private static $logger         = NULL;
	private static $is_cli         = FALSE;
	private static $is_windows     = FALSE;
	private static $patterns       = array();
	private static $loaded_classes = array();
	
	/**
	 * Don't allow Titanium to be cloned
	 *
	 * @access public
	 * @return void
	 */		 	 
	 public function __clone()
	 {
	 	throw new Exception('Cloning the Titanium core object is not allowed.');
 	
	 	exit(1);
	 }
	
	/**
	 * Don't allow instances to be created
	 *
	 * @access public
	 * @return void
	 */
  	 public function __construct()
	 {
	 	throw new Exception('Creating Titanium core instances is not allowed.');

	 	exit(1);
	 }
	
	/**
	 * Initialize the Titanium core framework and autoloader
	 *
	 * @access public
	 * @return void
	 */
	public static function init()
	{
		// Register the framework autoloader
		spl_autoload_register(array('Titanium', 'auto_loader'));
		
		// Set the timezone for the date() functions
		date_default_timezone_set('America/Chicago');
		
		// Set internal locale
		setlocale(LC_ALL, 'en_US.utf-8');
		
		// Set internet encoding to utf8
		ini_set('default_charset', 'UTF-8');
		
		// Register the script shurdown handler
		register_shutdown_function(array('Titanium', 'handle_shutdown'));
		
		/*
		set_exception_handler(
			array('Titanium', 'exception_handler')
		);
		
		set_error_handler(
			array('Titanium', 'error_handler')
		);
		*/
		
		if(function_exists('mb_internal_encoding'))
		{
			mb_internal_encoding('UTF-8');
		}		
		
		self::$is_cli     = (PHP_SAPI === 'cli');
		self::$is_windows = (DIRECTORY_SEPARATOR === '\\');
		
		self::load_functions();
	}

	/**
	 * Return all the user defined functions patterns
	 *
	 * @access public
	 * @return array
	 */	
	public static function function_patterns()
	{
		return self::$patterns;
	}
	
	/**
	 * Return all the loaded classes
	 *
	 * @access public
	 * @return array
	 */
	public static function loaded_classes()
	{
		return self::$loaded_classes;
	}
	
	/**
	 * Set the Titanium autoloader
	 *
	 * @access public
	 * @return void
	 */
	public static function auto_loader($classname)
	{
		$filename = TITANIUM_ROOT.'titanium/classes/'.strtolower($classname).'.class.php';

		if(file_exists($filename))
		{
			require $filename;
			
			if(!in_array($filename, self::$loaded_classes))
			{
				self::$loaded_classes[] = $filename;
			}

			return TRUE;
		}
		
		return false;
	}

	/**
	 * Load the user created functions and plugins
	 *
	 * @access public
	 * @return void
	 */	
	private static function load_functions()
	{
		if(!is_dir(TITANIUM_ROOT.'functions'))
		{
			throw new Exception('Functions directory is invalid');
			
			exit;
		}
		
	    $handler  = opendir(TITANIUM_ROOT.'functions');

	    while ($file = readdir($handler)) {

	        if ($file != '.' && $file != '..' && $file[0] != '.') {

	            $function = file_get_contents(TITANIUM_ROOT.'functions/'.$file);

	            preg_match_all('#\/\/p- (%.+%i)\n#', $function, $matches);

	            if(count($matches) > 0){

	                unset($matches[0]);

	            }

	            foreach($matches as $match){

	                foreach($match as $pattern){

	                    self::$patterns[$pattern] = str_replace('.php','',$file);

	                }
	            }
	        }            
	    }

	    closedir($handler);
	}

	/**
	 * Handle the shutdown elegantly & restore error handlers
	 *
	 * @access public
	 * @return void
	 */
	public static function handle_shutdown()
	{
		restore_error_handler();
		
		restore_exception_handler();
		
		spl_autoload_unregister(array('Carbon', 'auto_load_carbon'));
	}
	
	/**
	 * Convert all errors to ErrorExceptions is error_reporting() permits if
	 *
	 * @static
	 * @param  int    $code
	 * @param  string $error
	 * @param  string $file
	 * @param  int 	  $line
	 * @access public
	 * @throws ErrorException
	 * @return bool
	 */		
	public static function error_handler($code, $error, $file = NULL, $line = NULL)
	{
		if (error_reporting() && $code)
		{
			throw new ErrorException($error, $code, 0, $file, $line);
		}

		return TRUE;
	}

	/**
	 * Handle the exception in an elegant way
	 *
	 * @static
	 * @param  int    $code
	 * @param  string $error
	 * @param  string $file
	 * @param  int 	  $line
	 * @access public
	 * @throws ErrorException
	 * @return bool
	 */		
	public static function exception_handler(Exception $e)
	{	
		print_r($e); // @TODO: Implement exception handler
	}
	
} // EOC