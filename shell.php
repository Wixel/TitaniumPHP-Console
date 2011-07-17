#!/usr/bin/php -q
<?php

	/**
	 * Titanium PHP Console Framework
	 *
	 * @author Sean Nieuwoudt
	 * @copyright Wixel.net
	 * @license GPL
	 * @link http://github.com/Wixel/TitaniumPHP-Console
	 * @link git@github.com:Wixel/TitaniumPHP-Console.git
	 */
	
	if(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR'])) 
	{
		define('TITANIUM_CLI' , TRUE);         
		define('TITANIUM_ROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
		define('TICKER'       , 'php@localhost » ');
 	}
	else
	{
		exit;
	}

   /*-------------------------------------------------
    * SETUP CORE
    *-------------------------------------------------*/

    require_once(TITANIUM_ROOT.'titanium/titanium.php');
    require_once(TITANIUM_ROOT.'bridge.inc.php');

	Titanium::init();
	
   /*-------------------------------------------------
    * CMD LISTENER
    *-------------------------------------------------*/
	if($argc > 1)
	{
		if(!defined('RUN_MODE'))
		{
			define('RUN_MODE', 'CLI');
		}
		
		exec_cmd($argv[1], array_slice($argv, 2, count($argv) - 1));
	}
	else
	{
		if(!defined('RUN_MODE'))
		{
			define('RUN_MODE', 'INTERACTIVE');
		}
		
		Output::write(Template::render('introduction.tpl.php'), false, true, 2);

		print_ticker();
		
	    do {

	       do {

	           $q = fgets(STDIN);

	       } while ( trim($q) == '' );

			exec_cmd($q);

	    } while ( true );		
	}

   /*-------------------------------------------------
    * DISPATCHER
    *-------------------------------------------------*/
	function exec_cmd($q, $params = NULL)
	{
        $match = false;

        foreach(Titanium::function_patterns() as $regex => $funct) {

            if(preg_match($regex, $q, $matches) > 0) {
                
                if(file_exists('functions/'.$funct.'.php')) {

                    require_once('functions/'.$funct.'.php');

                    $match = true;

                    call_user_func(str_replace('.','_',$funct), $q, $matches, $params);

					print_ticker();

                }
                
            }

        }

        if(!$match) {
	
			Output::write(Template::render('errors/invalid-command.tpl.php'), 'red', TRUE);

            print_ticker();
        }
	}
	
	function print_ticker()
	{
		if(RUN_MODE == 'INTERACTIVE')
		{
        	Output::write(TICKER, 'bold');
		}
	}