<?php
class Verifier extends Account
{
    /**
    * Securisation d'une chaine de caractere
    * @param [type] $string
    * @return string
    */
    private function str_secure($string){

        return trim(htmlspecialchars($string));
    }
}
