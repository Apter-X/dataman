<?php
class Loader 
{
    /**
    * Load Dataman
    *
    * @return void
    */
    public static function load()
    {
        define('__ROOT__', dirname(dirname(__FILE__)));
        require_once(__ROOT__.'\dataman\_config.php');
        require_once(__ROOT__.'\dataman\tools\view.php');
        require_once(__ROOT__.'\dataman\tools\lang.php');
        
        spl_autoload_register(function ($class) 
        {
            include_once 'classes/' . $class . '.php';
        });
    }
}
