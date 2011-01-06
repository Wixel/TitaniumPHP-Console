<?php if(!defined('TITANIUM_CLI')) { exit; }

//p- %^tutorial$%i

/**
 * Display the tutorial page
 *
 * @param string $q
 * @param array $matches
 * @param array $post
 */
 function fn_tutorial($q, $matches, $post) 
 {
	Output::write(Template::render('functions/tutorial.tpl.php', $data), false, true);
 }