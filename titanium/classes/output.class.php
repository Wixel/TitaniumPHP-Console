<?php if(!defined('TITANIUM_CLI')) { exit; }

class Output
{
	/**
	 * Write color coded output to the terminal
	 *
	 * @access public
	 * @param string $text
	 * @param string $color
	 * @param false  $newline
	 * @param int    $newlinecount
	 * @return void
	 */
    public static function write($text, $color = "normal", $newline = false, $newlinecount = 1) 
	{
        if($color == '' || is_bool($color))
		{
            $color = 'normal'; 
        }

       $colors = array(
			'light_red'   => "[1;31m",
            'light_green' => "[1;32m",
            'yellow'      => "[1;33m",
            'light_blue'  => "[1;34m",
            'magenta'     => "[1;35m",
            'light_cyan'  => "[1;36m",
            'white'       => "[1;37m",
            'normal'      => "[0m",
            'black'       => "[0;30m",
            'red'         => "[0;31m",
            'green'       => "[0;32m",
            'brown'       => "[0;33m",
            'blue'        => "[0;34m",
            'cyan'        => "[0;36m",
            'bold'        => "[1m",
            'underscore'  => "[4m",
            'reverse'     => "[7m"
       );

       $out = $colors["$color"];
       $ech = chr(27)."$out"."$text".chr(27)."[0m";

       if($newline) 
	   {
           echo $ech . str_repeat("\n", (int)$newlinecount);
       } 
       else 
       {
           echo $ech;
       }
       
    }
	
} // EOC