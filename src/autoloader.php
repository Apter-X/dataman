<?php
function load()
{
    spl_autoload_register(function ($class) 
    {
        include_once __ROOT__ . '.\src\Dataman\Classes\\' . $class . '.php';
    });
}

spl_autoload_register('load');
