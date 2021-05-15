<?php
/**
* 
*/
trait Security
{
    /**
    * Generate a random string and convert the binary data into hexadecimal representation
    */
    function generateToken($length)
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
    function setSafeCookie($name, $cookieData, $key)
    {
        $nonce = \Sodium\randombytes_buf(\Sodium\CRYPTO_SECRETBOX_NONCEBYTES);
        
        return setcookie(
            $name,
            base64_encode(
                $nonce.
                \Sodium\crypto_secretbox(
                    json_encode($cookieData),
                    $nonce,
                    $key
                )
            )
        );
    }

    /**
    * Decrypt a cookie, expand to array
    * 
    * @param string $name - cookie name
    * @param string $key - crypto key
    */
    function getSafeCookie($name, $key)
    {
        if (!isset($_COOKIE[$name])) {
            return array();
        }
        
        $decoded = base64_decode($_COOKIE[$name]);
        $nonce = mb_substr($decoded, 0, \Sodium\CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, \Sodium\CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
        
        $decrypted = \Sodium\crypto_secretbox_open(
            $ciphertext,
            $nonce,
            $key
        );
        if (empty($decrypted)) {
            return array();
        }        
        return json_decode($decrypted, true);
    }

}
