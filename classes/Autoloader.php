<?php
class Autoloader
{
    /**
    * Load Dataman requirements.
    *
    * @return void
    */
    public static function load()
    {
        spl_autoload_register(function ($class) 
        {
            include_once $class . '.php';
        });
    }
}
