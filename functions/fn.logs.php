<?php if(!defined('TITANIUM_CLI')) { exit; }

//p- %^logs$%i

/**
 * Display the log file contents for today
 *
 * @param string $q
 * @param array $matches
 * @param array $params
 */
 function fn_logs($q, $matches, $params) 
 {	
	$log_file = TITANIUM_ROOT.'logs/'.date('Y-m-d').'.txt';
	
	Logger::write("Reading log file: $log_file");											
	
	if(file_exists($log_file))
	{
		Output::write(file_get_contents($log_file), false, true);		
	}
	else
	{
		Output::write("$log_file does not exist.", 'red', true);		
	}
 }