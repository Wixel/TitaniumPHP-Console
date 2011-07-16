<?php if(!defined('TITANIUM_CLI')) { exit; }

class Logger
{	
	/**
	 * Write an entry to the log file
	 *
	 * @access public
	 * @param  mixed $o
	 * @param  string $type
	 * @return void
	 */
	public static function write($o, $type = NULL)
	{
		$file = TITAMIUM_ROOT.'logs/'.date('Y-m-d').'.txt';
		
		if($type == 'error')
		{
			$line_item = '['.date("F j, Y, g:i a").'] - ';			
		}
		else
		{
			$line_item = '['.date("F j, Y, g:i a").'] - ';	
		}

		switch(gettype($o))
		{
			case 'array':
			case 'object':
				ob_start();
				print_r($o);
				$buffer = ob_get_contents();
				ob_end_clean();
				$line_item .= "\n" . $buffer ."\n";							
				break;
			case 'string':
				$line_item .= $o;
				break;
		}
		
		if(!file_exists($file))
		{
			file_put_contents($file, $line_item);
		}
		else
		{
			$fhandle = fopen($file, 'a');	
			
			fwrite($fhandle, $line_item."\n");
			
 			fclose($fhandle);
		}
	}
	
} // EOC