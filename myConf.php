<?php
//set error handler
// set_error_handler("customError");

/** traits/classes **/
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'\dataman\traits\Format.php');
require_once(__ROOT__.'\dataman\traits\View.php');
require_once(__ROOT__.'\dataman\classes\Autoloader.php');

/** Database/__constructor **/
define("DB_HOST", "localhost");
define("DB_NAME", "data_manager");
define("DB_USER", "root");
define("DB_PASS", "");

/** Account/register **/
define('USERS_TABLE', '');
define('USERNAME_KEY', '');
define('EMAIL_KEY', '');
/** Account/login **/
define('PASSWORD_KEY', '');

/** helpers/view **/
define('PRIMARY_COLOR', '#0f5f9a');
define('SECONDARY_COLOR', '#b5bbc7');
define('SUCCESS_COLOR', '#00cc66');
define('DANGER_COLOR', '#c93f38');
define('POLICE_PRIMARY', 'Verdana, sans-serif');

Autoloader::load();
