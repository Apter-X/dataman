<?php
/**
* Where all the data flow passes.
*/
class Pact extends Time
{
    use Format;
    use Toolbox;

    private $pact = NULL;

    private function getPact($id)
    {
        $serializedPact = $this->selectValue(PACT_KEY, USERS_TABLE, USER_ID_KEY, $id);
        $this->pact = unserialize($serializedPact);
    }

    private function putPact($id)
    {
        $this->updateValue(USERS_TABLE, PACT_KEY, USER_ID_KEY, $id);
        $this->pact = unserialize($serializedPact);
    }

    protected function madePact($userId, $userRole)
    {
        $token = generateToken(16);

        $this->pact = array('token'=>$token, 
                            'userId'=>$userId,
                            'role'=>$userRole,
                            'timestamp'=>date('Y-m-d'));

        $_SESSION['is_login'] = 1;
        $_SESSION['token'] = $token;
        $_SESSION['user_id'] = $userId;
        $_SESSION['role'] = $userRole;

        $serializedPact = serialize($this->pact);

        return $serializedPact;
    }

    protected function checkPact($serializedPact)
    {
        return ($this->pact->token === $_SESSION['token']) ? true : false;
    }

    protected function endPact()
    {
        // Initialisation de la session.
        // Si vous utilisez un autre nom
        // session_name("autrenom")
        session_start();
        
        // Détruit toutes les variables de session
        $_SESSION = array();
        
        // Si vous voulez détruire complètement la session, effacez également
        // le cookie de session.
        // Note : cela détruira la session et pas seulement les données de session !
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalement, on détruit la session.
        session_destroy();
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

    private function hmac_sign($message, $key)
    {
        return hash_hmac('sha256', $message, $key) . $message;
    }

    private function hmac_verify($bundle, $key)
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
    private function setSafeCookie($name, $cookieData, $key)
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
    private function getSafeCookie($name, $key)
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
