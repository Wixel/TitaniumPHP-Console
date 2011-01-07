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
		define('TITAMIUM_ROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
		define('TICKER'       , 'php@localhost » ');
 	}

    require_once(TITAMIUM_ROOT.'titanium/titanium.php');

	Titanium::init();

   /*-------------------------------------------------
    * DISPATCHER
    *-------------------------------------------------*/

	Output::write(Template::render('introduction.tpl.php'), false, true, 2);
	
	Output::write(TICKER, 'bold');

    do {

       do {
           
           $q = fgets(STDIN);

       } while ( trim($q) == '' );

            $match = false;

            foreach(Titanium::function_patterns() as $regex => $funct) {

                if(preg_match($regex, $q, $matches) > 0) {
                    
                    if(file_exists('functions/'.$funct.'.php')){

                        require_once('functions/'.$funct.'.php');

                        $match = true;

                        call_user_func(str_replace('.','_',$funct), $q, $matches, $_POST);

                        Output::write(TICKER, 'bold');

                    }
                    
                }

            }

            if(!$match){

				Output::write(Template::render('errors/invalid-command.tpl.php'), 'red', TRUE);

                Output::write(TICKER, 'bold');

            }

    } while ( true );