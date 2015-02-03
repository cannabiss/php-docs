<?php
class Auth
{

    private $login;
    private $password;
    private $logged;

    public function isAdmin()
    {
        if (!empty($_SESSION['is_admin']))
            $is_admin = $_SESSION['is_admin'];
        if ($is_admin == 1)
            return true;
        else
            return false;
    }

    public function setSessionInfo()
    {
        $this->login = $_SESSION['login'];
        $this->password = $_SESSION['password'];
    }

    public function setInfo($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function checkLogged()
    {
        if ($this->login == null || $this->password == null) {
            $this->logged = false;
        } else {
            if ($this->checkUserFromDb()) {
                $this->logged = true;
            } else {
                $this->logged = false;
            }
        }
        return $this->logged;
    }

    public function checkUserFromDb()
    {

        $query = "SELECT * FROM users WHERE password='" . $this->password . "' AND login='" . $this->login . "'";
        Database::query($query);

        if (Database::GetColRows() != 0) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    public function getUserFromDb()
    {
        $query = "SELECT * FROM users WHERE password = '" . $this->password . "' AND login='" . $this->login . "'";

        Database::query($query);

        return Database::$res_list[0];
    }

    public function login()
    {

        $data = $this->getUserFromDb();

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['login'] = $data['login'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['surname'] = $data['surname'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['is_admin'] = $data['is_admin'];

    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['is_admin']);
        unset($_SESSION['login']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['password']);

    }

    public function toLogin()
    {
        Header('Location:' . 'http://' . $_SERVER['HTTP_HOST'] . '/login');
    }

}