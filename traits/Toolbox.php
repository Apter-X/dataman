<?php
/**
 * Utilities
 */
trait Toolbox
{
    /**
    * Check if is set and not empty
    */
    protected function toBe($input)
    {
        return (isset($input) && !empty($input)) ? true : false;
    }
}