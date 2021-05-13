<?php
/**
* Where all the data flow passes.
*/
class Pact extends Time
{
    use Format;
    use Toolbox;

    private $pact;

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

    protected function checkPact()
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
}
