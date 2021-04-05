<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'\dataman\_config.php');
require_once(__ROOT__.'\dataman\helpers\functions.php');
require_once(__ROOT__.'\dataman\helpers\error_handler.php');
require_once(__ROOT__.'\dataman\helpers\array_view.php');
require_once(__ROOT__.'\dataman\classes\Autoloader.php');

Autoloader::load();
