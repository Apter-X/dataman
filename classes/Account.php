<?php
/**
* This PHP class manage account.
*/
class Account extends Time
{
    use Security;

    private $key = $this->genrateToken();

    /**
    * Login
    * @param string $username Username
    * @param string $password Password
    * @return PDOStatement
    */
    function logIn($username, $password)
    {
        $query_password = $this->db->selectValue(PASSWORD_KEY, USERS_TABLE, USERNAME_KEY, $username);

        if($this->hmac_verify($query_password))
        {
            return true;
        } else {
            return false;
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
        $fetch_users = $this->db->selectColumn(USERNAME_KEY, USERS_TABLE);
        $fetch_emails = $this->db->selectColumn(EMAIL_KEY, USERS_TABLE);

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
            $newUser->password = $this->hmac_sign($password);
            $this->db->insertRow('users', ":username, :email, :password", $newUser);
        }
    }
}
