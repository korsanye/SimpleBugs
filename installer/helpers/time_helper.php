<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Takes a UNIX timestamp and converts to days, hours and minutes
*
* @param	integer	UNIX timestamp
* @return	object
*/
function convert_from_unix_time($input)
{
    $obj = new stdClass();
    $obj->days = 0;
    $obj->hours = 0;
    $obj->minutes = 0;

    // extract days
    $days = floor($minutes/(1440)); # Divide on the daily minutes 60 min * 24 hours
    # echo "Days: " . $days;

    // extract hours
    $hours = floor(($minutes-($days*1440))/60);
    # echo " Hours: " . $hours;

    // extract left minutes
    $minutes = ($minutes-($days*24*60)-($hours*60));
    # echo " Minutes: " . $minutes;

    if ($days > 0)
    {
         $obj->days = $days;
    }
    if ($hours > 0)
    {
        $obj->hours = $hours . "h ";
    }
    if ($minutes >= 0)
    {
        $obj->minutes .= $minutes . "m ";
    }

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
		if( $abbr != "h" || $abbr != "m" )
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
