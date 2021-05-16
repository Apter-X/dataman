<?php
/**
* This PHP class manage account.
*/
class Account extends Time
{
    use Security;
    use View;

    private $key = '123';

    function auth($id)
    {
        $user = $this->selectRow(USERS_TABLE, USER_ID_KEY, $id);
        $cookieToken = $this->getSafeCookie('auth');

        var_dump($cookieToken, $user[TOKEN_KEY]);
        
        if($cookieToken === $user[TOKEN_KEY])
        {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Login
    * @param string $username Username
    * @param string $password Password
    * @return PDOStatement
    */
    function logIn($email, $password)
    {
        $query_password = $this->selectValue(PASSWORD_KEY, USERS_TABLE, EMAIL_KEY, $email);

        if($this->hmac_verify($query_password, $this->key))
        {
            $id = $this->selectValue(USER_ID_KEY, USERS_TABLE, EMAIL_KEY, $email);
            $token = $this->generateToken();
            
            $this->updateValue(USERS_TABLE, TOKEN_KEY, $token, USER_ID_KEY, $id);
            $this->setSafeCookie('auth', $token);

            return $id;
        } else {
            return 'Email or password are incorrect !';
        }
    }

    function logOut()
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
    * Register
    * @param array $newUser Associative array
    * @return PDOStatement
    */
    function registerUser($newUser, $password)
    {
        $fetch_users = $this->selectColumn(USERNAME_KEY, USERS_TABLE);
        $fetch_emails = $this->selectColumn(EMAIL_KEY, USERS_TABLE);

        $search_user = array_search($newUser[USERNAME_KEY], $fetch_users);
        $search_email = array_search($newUser[EMAIL_KEY], $fetch_emails);

        if(is_int($search_user))
        {
            return "Username already exist !";
        } 
        elseif (is_int($search_email))
        {
            return "E-mail already exist !";
        } 
        else 
        {
            $cryptedPwd = $this->hmac_sign($password, $this->key);
            $newUser += array(PASSWORD_KEY=>$cryptedPwd);

            $this->insertRow(USERS_TABLE, $newUser);
        }
    }
}
