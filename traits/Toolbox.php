<?php
/**
 * Utilities
 */
trait Toolbox
{
    /**
    * Check if is set and not empty
    */
    function exist($input)
    {
        return (isset($input) && !empty($input)) ? true : false;
    }
}