<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Random Generation configuration
|--------------------------------------------------------------------------
|
| This setting enables you to decide whether or not you want to use
| random.org as the random generator for creating salts.
| Using random.org enables you to use TRUE random generation.
| Please refer to http://www.random.org for elaboration of true randomness.
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