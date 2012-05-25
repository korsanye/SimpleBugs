<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| The name of your site
|--------------------------------------------------------------------------
|
| This is used for outgoing mails to your users.
*/

$config['site_name'] = 'Faboulus Site';

/*
|--------------------------------------------------------------------------
| The mail address of your site
|--------------------------------------------------------------------------
|
| This is used for outgoing mails to your users.
| You should set this to an existing e-mail address.
*/

$config['site_email'] = 'no-reply@example.com';

/*
|--------------------------------------------------------------------------
| Login with username or e-mail address
|--------------------------------------------------------------------------
|
| Tells the system whether to use either username or e-mail to login with.
| 
|
| Possible values:
| username
| email
*/

$config['user_login'] = 'username';

/*
|--------------------------------------------------------------------------
| RANDOM.ORG Random Generation configuration
|--------------------------------------------------------------------------
|
| This setting enables you to decide whether or not you want to use
| random.org as the random generator for creating salts.
| Enabling this will make salt generation slower (as this is done over HTTP).
| Please refer to http://www.random.org for elaboration of true randomness.
|
| To use this, make sure that allow_url_fopen is enabled:
| http://www.php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen
|
*/

$config['random_org'] = FALSE;