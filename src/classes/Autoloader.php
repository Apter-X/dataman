<?php
class Autoloader 
{
    /**
    * Load additional classes
    *
    * @return void
    */
    public function load()
    {
        spl_autoload_register(function ($class) 
        {
            include_once $class . '.php';
        });
    }
}

