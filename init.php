<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'\dataman\src\_config.php');
require_once(__ROOT__.'\dataman\helpers\tools.php');
// require_once(__ROOT__.'\dataman\helpers\error_handler.php');
require_once(__ROOT__.'\dataman\helpers\view.php');
require_once(__ROOT__.'\dataman\src\classes\Autoloader.php');

$auto = new Autoloader();
$auto->load();
