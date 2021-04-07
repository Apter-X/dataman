<?php
class Autoloader
{
    /**
    * Load classes.
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
