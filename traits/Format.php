<?php
trait Format {
    /**
    *  function formattage de la date
    *
    * @param  $date
    * @return date 
    */
    function formatDate($date)
    {
        $date = date("F j, Y, g:i a", strtotime($date));
        return $date;
    }
}
