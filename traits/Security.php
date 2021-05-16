<?php
trait Security
{
    /**
    * Generate a random string and convert the binary data into hexadecimal representation
    */
    function generateToken($length = 16)
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
    function strSecure($string){

        return trim(htmlspecialchars($string));
    }

    function hmac_sign($message, $key)
    {
        return hash_hmac('sha256', $message, $key) . $message;
    }

    function hmac_verify($bundle, $key)
    {
        $msgMAC = mb_substr($bundle, 0, 64, '8bit');
        $message = mb_substr($bundle, 64, null, '8bit');
        return hash_equals(
            hash_hmac('sha256', $message, $key),
            $msgMAC
        );
    }

    /*
    // At some point, we run this command:
    $key = \Sodium\randombytes_buf(\Sodium\CRYPTO_SECRETBOX_KEYBYTES);
    */

    /**
    * Store ciphertext in a cookie
    * 
    * @param string $name - cookie name
    * @param mixed $cookieData - cookie data
    * @param string $key - crypto key
    */
    function setSafeCookie($name, $cookieData)
    {
        return setcookie(
            $name,
            base64_encode($cookieData),
            time() + 365*24*3600, 
            null, 
            null, 
            false, 
            true);
    }

    /**
    * Decrypt a cookie, expand to array
    * 
    * @param string $name - cookie name
    * @param string $key - crypto key
    */
    function getSafeCookie($name)
    {        
        return base64_decode($_COOKIE[$name]);
    }

    function destroyCookie($name)
    {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]); 
            setcookie($name, null, -1); 
            return true;
        } else {
            return false;
        }
    }
}
