<?php
/**
* Where all the data flow passes.
*/
class Shield extends Time
{
    use Format;
    use Toolbox;

    protected $pact;

    protected function endPact()
    {
        
    }

    protected function madePact($userId, $userRole)
    {
        $this->pact = array('Token'=>generateToken(16), 
                            'userId'=>$userId,
                            'role'=>$userRole);
    }

    protected function checkPact()
    {
        
    }

    /**
    * Generate a random string and convert the binary data into hexadecimal representation
    */
    private function generateToken($length)
    {
        $token = openssl_random_pseudo_bytes($length);

        $token = bin2hex($token);

        return $token;
    }

    /**
    * Securisation d'une chaine de caractere
    * @param [type] $string
    * @return string
    */
    private function strSecure($string){

        return trim(htmlspecialchars($string));
    }
}
