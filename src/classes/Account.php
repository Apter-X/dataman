<?php
/**
* dataman v1.0
*
* https://github.com/Apter-X/dataman
*
* This PHP class manage account
*/
class Account extends Query
{
    /**
    * Login
    * @param string $username Username
    * @param string $password Password
    * @return PDOStatement
    */
    public function login($username, $password)
    {
        $query_password = $db->selectValue('password', 'users', 'username', $username);

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
    public function register($newUser)
    {
        $query_users = $db->selectColumn('username', 'users');
        $query_emails = $db->selectColumn('email', 'users');

        $search_user = array_search($newUser['username'], $query_users);
        $search_email = array_search($newUser['email'], $query_emails);

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
            $db->insertRow('users', ':username, :email, :password', $newUser);
            return true;
        }
    }
}
