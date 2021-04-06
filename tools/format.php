<?php
/**
 * Securisation d'une chaine de caractere
 * @param [type] $string
 * @return string
 */

function str_secure($string){

    return trim(htmlspecialchars($string));
}


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
