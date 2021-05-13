<?php
/** traits/classes **/
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'\dataman\traits\Format.php');
require_once(__ROOT__.'\dataman\traits\View.php');
require_once(__ROOT__.'\dataman\traits\Toolbox.php');
require_once(__ROOT__.'\dataman\traits\Asset.php');
require_once(__ROOT__.'\dataman\classes\Autoloader.php');

/** Database/__constructor **/
define("DB_HOST", "localhost");
define("DB_NAME", "gcm");
define("DB_USER", "root");
define("DB_PASS", "");

/** Account/register **/
define('USERS_TABLE', 'users');
define('USERNAME_KEY', 'username');
define('EMAIL_KEY', 'email');
/** Account/login **/
define('PASSWORD_KEY', 'password');

/** helpers/view **/
define('PRIMARY_COLOR', '#0f5f9a');
define('SECONDARY_COLOR', '#b5bbc7');
define('SUCCESS_COLOR', '#00cc66');
define('DANGER_COLOR', '#c93f38');
define('POLICE_PRIMARY', 'Helvetica');

Autoloader::load();
