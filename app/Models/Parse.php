<?php

namespace App\Models;

class Parse  {
	public static function check_command($name_of_command){
		$name_of_commands = [
			'command_img',
			'command_page_link',
			'command_get_tiles'
        ];
		return array_search($name_of_command, $name_of_commands);
	}

	public static function parse($text) {
		$macro = new Macro();
		$parts = explode("~~", $text);
	
		for($i = 1; $i < count($parts); $i += 2){ 		
			$start = strpos($parts[$i], '(');
			$len = strpos($parts[$i], ')') - $start - 1;

			$params_text = substr($parts[$i], $start + 1, $len); 
            $name_of_command = substr($parts[$i], 0, $start);
			$params = explode(',', $params_text);
			switch (self::check_command($name_of_command)) {
                case 0:
				  $parts[$i] = $macro->command_img($params[0],$params[1]);
				  break;
                case 1:
				  $parts[$i] = $macro->command_page_link($params[0],$params[1],$params[2]);
				  break;
				case 2:
				  $parts[$i] = $macro->command_page_tiles($params[0],$params[1]);
				  break;  
			  }		
		}
		$parsed_text = implode($parts);
		return $parsed_text;
	}
}