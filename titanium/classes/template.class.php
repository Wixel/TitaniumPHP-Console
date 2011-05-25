<?php if(!defined('TITANIUM_CLI')) { exit; }

require_once(TITAMIUM_ROOT.'titanium/utils/Savant/Savant3.php');

class Template
{	
	public static function render($filename, $data = NULL)
	{	
		if(!$filename)
		{
			throw new Exception('A valid template filename is required for the template to be rendered.');
			
			exit;
		}	

		$tpl 	      	   = new Savant3();
		$tpl->date    	   = date('Y');
		$tpl->version	   = Titanium::VERSION;
		//$tpl->memory_limit = ini_get('memory_limit');
		
		if(is_array($data))
		{
			foreach($data as $k => $v)
			{
				$tpl->$k = $v;
			}
		} 
		
	 	return $tpl->fetch('templates/'.$filename);
	}
	
} // EOC