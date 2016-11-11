<?php

/**
 * @param $email
 * @param int $size
 * @return string
 */
function gravatar($email, $size = 20)
{
    return "https://www.gravatar.com/avatar/" . md5($email) ."?s=".$size."&d=mm";
}

/**
 * Stolen from https://laracasts.com/lessons/active-states
 *
 * @param $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active')
{

    return Request::is($path) ? $active : '';
}

/**
 * @param $input String that allows for spaceseparated human readable time units (1w 2d 6h 12m)
 * @return int Time converted to seconds
 */
function toTime($input)
{
    $estimate = 0;
    $data = explode(" ", $input);
    $available_units = [
        //"m" => (60 * 60 * 24 * 30), // 30 days
        "w" => (60 * 60 * 24 * 7), // 1 week
        "d" => (60 * 60 * 24), // 1 day
        "h" => (60 * 60), // 1 hour
        "m" => 60, // 1 minute
        "s" => 1, // 1 second
    ];

    foreach($data as $value)
    {
        $unit = mb_strtolower(substr($value, -1));
        $time = (int)substr($value, 0, -1);

        if(!isset($available_units[$unit]))
            continue;

        $estimate += $time * $available_units[$unit];
    }

    return $estimate;
}


/**
 * @param int $time Seconds to convert into human readable time units
 * @return string e.g. 1w 2d 6h 12m
 */
function fromTime($time)
{

    $data['w'] = floor($time / (60 * 60 * 24 * 7));
    $data['d'] = floor(($time % (60 * 60 * 24 * 7)) / (60 * 60 * 24));
    $data['h'] = floor(($time % (60 * 60 * 24)) / (60 * 60));
    $data['m'] = floor(($time % (60 * 60)) / (60));
    $data['s'] = floor($time % 60);

    $string = "";
    foreach($data as $key => $value)
    {
        if( $value == 0)
            continue;

        $string .= $value.$key." ";
    }

    return trim($string);

}
