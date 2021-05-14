<?php
/** traits/classes */
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'\dataman\traits\Format.php');
require_once(__ROOT__.'\dataman\traits\View.php');
require_once(__ROOT__.'\dataman\traits\Toolbox.php');
require_once(__ROOT__.'\dataman\traits\Asset.php');
require_once(__ROOT__.'\dataman\classes\Autoloader.php');

/** Database/__constructor */
define("DB_HOST", "localhost");
define("DB_NAME", "agendar");
define("DB_USER", "root");
define("DB_PASS", "");

/** PACT/getPact */
define('USER_ID_KEY', 'user_id');
/** PACT/ */
define('PACT_KEY', 'pact');

/** Account/register */
define('USERS_TABLE', 'users');
define('USERNAME_KEY', 'username');
define('EMAIL_KEY', 'email');
/** Account/login */
define('PASSWORD_KEY', 'password');

/** Time/getEvents */
define('EVENTS_TABLE', 'events');
define('YEAR_DATE_KEY', 'YEAR(date)');

/** View/alert */
define('PRIMARY_COLOR', '#0f5f9a');
define('SECONDARY_COLOR', '#b5bbc7');
define('SUCCESS_COLOR', '#00cc66');
define('DANGER_COLOR', '#c93f38');
/** Asset/dropStyle */
define('POLICE_PRIMARY', 'Helvetica');

Autoloader::load();
