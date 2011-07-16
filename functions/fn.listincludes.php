<?php if(!defined('TITANIUM_CLI')) { exit; }

//p- %^list includes$%i

/**
 * Display a list of the base class includes
 *
 * @param string $q
 * @param array $matches
 * @param array $params
 */
 function fn_listincludes($q, $matches, $params) 
 {
	Logger::write("Running: ".__FUNCTION__);											
	
	$data = array(
		'includes' => Titanium::loaded_classes()
	);
	
	Output::write(Template::render('functions/listincludes.tpl.php', $data), false, true);
 }