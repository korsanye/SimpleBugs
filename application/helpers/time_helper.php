<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Takes a UNIX timestamp and converts to days, hours and minutes
*
* @param	integer	UNIX timestamp
* @return	object
*/
function convert_from_unix_time($secs)
{
    $obj = new stdClass();
    
	$obj->weeks = (int) ($secs / 86400 / 7);
	$obj->days = $secs / 86400 % 7;
	$obj->hours = $secs / 3600 % 24;
	$obj->minutes = $secs / 60 % 60;
	$obj->seconds = $secs % 60;
									 
    return $obj;        	
}

/**
* Takes a string and converts it to a integer representing time
*
* @param	string	Like '2h 30m' for 2 hours and 30 minutes
* @return	integer
*/
function convert_to_unix_time($input)
{
	$parts = explode(" ", $input);
	$time = 0;
	foreach($parts as $value)
	{		
		$abbr = strtolower(substr($value, -1, 1));
		if( $abbr != "h" && $abbr != "m" )
		{
			continue;	
		}
		
		$value = str_replace(array("h", "m"), array(" hours", " minutes"), $value);
		
		$tmp_time = strtotime($value, 0);
		if($tmp_time < 1)
		{
			continue;	
		}
		
		$time += $tmp_time;
	}
	
	return $time;
}
