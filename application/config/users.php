<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

/*
|--------------------------------------------------------------------------
| Secret hash key
|--------------------------------------------------------------------------
|
| Improves the security by adding a secret hash to your hashed passwords.
|
| Giving this key a value is required.
*/

$config['secret_hash_key'] = '';