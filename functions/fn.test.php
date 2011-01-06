<?php if(!defined('TITANIUM_CLI')) { exit; }

//p- %^test$%i

/**
 * Display the help page
 *
 * @param string $q
 * @param array $matches
 * @param array $post
 */
 function fn_test($q, $matches, $post) 
 {
	$ci = &get_instance();
	
	$ci->load->model('User_model');
	
	$ci->User_model->insert_person();
	
	//$ci->load->helper('user');
 }