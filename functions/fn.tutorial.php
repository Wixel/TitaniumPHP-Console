<?php if(!defined('TITANIUM_CLI')) { exit; }

//p- %^tutorial$%i

/**
 * Display the tutorial page
 *
 * @param string $q
 * @param array $matches
 * @param array $params
 */
 function fn_tutorial($q, $matches, $params) 
 {
	Logger::write("Running: ".__FUNCTION__);											
	
	Output::write(Template::render('functions/tutorial.tpl.php'), false, true);
 }