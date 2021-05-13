<?php
/**
* This PHP class manage account.
*/
class Account extends Shield
{
    /**
    * Login
    * @param string $username Username
    * @param string $password Password
    * @return PDOStatement
    */
    protected function login($username, $password)
    {
        $query_password = $this->db->selectValue(PASSWORD_KEY, USERS_TABLE, USERNAME_KEY, $username);

        if( $password == $query_password )
        {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Register
    * @param array $newUser Associative array
    * @return PDOStatement
    */
    protected function register($newUser)
    {
        $query_users = $this->db->selectColumn(USERNAME_KEY, USERS_TABLE);
        $query_emails = $this->db->selectColumn(EMAIL_KEY, USERS_TABLE);

        $search_user = array_search($newUser[USERNAME_KEY], $query_users);
        $search_email = array_search($newUser[EMAIL_KEY], $query_emails);

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
            $this->db->insertRow('users', ':username, :email, :password', $newUser);
            return true;
        }
    }
}
