<?php if(!defined('TITANIUM_CLI')) { exit; }

//p- %^help$%i

/**
 * Display the help page
 *
 * @param string $q
 * @param array $matches
 * @param array $post
 */
 function fn_help($q, $matches, $post) 
 {
	Output::write(Template::render('functions/help.tpl.php', $data), false, true);
 }