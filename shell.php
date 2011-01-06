#!/usr/bin/php -q
<?php

	/**
	 * Titanium PHP Testing Framework
	 *
	 * @author Sean Nieuwoudt
	 * @copyright Sean Nieuwoudt
	 * @license LGPL
	 * @link https://github.com/Wixel/TitaniumPHP-Console
	 * @link git@github.com:Wixel/TitaniumPHP-Console.git
	 */
	
	if(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR'])) 
	{
		define('TITANIUM_CLI' , TRUE);         
		define('TITAMIUM_ROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
		define('TICKER'       , 'php@localhost » ');
 	}

    require_once(TITAMIUM_ROOT.'titanium/titanium.php');
    require_once(TITAMIUM_ROOT.'bridge.inc.php');

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

   /*-------------------------------------------------
    * DISPATCHER FUNCTIONS
    *-------------------------------------------------*/


	 /*
        // Build sqlite check methods to check version etc.
		help                                               - done
		help <command>                                     - done : needs command pages
        check setup                                        -
		add test mango                                     -
		delete test mango                                  -
		run test mango                                     -
		run test mango * 2                                 -
		version|about                                      -
		shell <command>                                    - 
		fetch url <url>                                    -
		fetch file <file>                                  -
		cleanup                                            -
		show test results | <test name>                    -
		show test results | 10                             -
		set <name> <value>                                 -
		globals                                            -
		global <name>                                      -
		eval                                               -
		echo <string>                                      -
		add include <file>                                 -
		import test <name>                                 -
		exec <code>                                        - 
		phpinfo                                            -
		deploy <script>                                    -
		exists ? $_SERVER                                  -
		type ? $_SERVER                                    -
		empty ? $_SERVER                                   -
        show includes                                      -
        inspect <variable>                                 - Does some kind of breakdown of variable
        through <table> | grep <term>                      - search
        testdb <type> <host> <db> <user> <password> <port> - test database connection
        ping                                               - ping remote host
        curl -d                                            - perform curl request & download page
        curl -s                                            - check request time and stats
        fgc -d                                             - perform file_get_contents request & download page
        fgc -s                                             - check request time and stats
        install <package>                                  - Install libraries like phpQuery and Simple Test and auto include
        remove <package>                                   - Uninstall libraries and un-include
        q select * from users;                             - perform sql query on the sqlite database
        show packages                                      - show installed packages
        discover packages                                  - fetch list of packages available
        inspect package phpquery                           - fetch information about package in question
        upgrade package phpquery                           - upgrade specific package
        upgrade packages                                   - upgrade all packages

      $test->hasError()
      $test->result();

      $test->outPutContains(array('login', 'password'));

	  */

	/*
	 * Reflection abilities
	 * Display of memory usage etc.
	 * Ability to look into running php code
	 * have acive output for the framework, log certain events and print etc.
	 *
	 * A basic FTP deployment script
     *
     * something to try help determine code coverage per scope. Using some sort of
     * basic syntax
	 *
	 *
	 */