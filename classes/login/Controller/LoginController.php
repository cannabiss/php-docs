<?php
class LoginController
{
    private $error;

    public function index()
    {
        if (isset($_POST['log'])) {
            if (empty($_POST['login'])) {
                $this->error .= " Fill login. ";
            }
            if (empty($_POST['password'])) {
                $this->error .= " Fill password. ";
            }
            if (!empty($_POST['login']) and !empty($_POST['password'])) {
                $login = addslashes(htmlspecialchars($_POST['login']));
                $password = md5(addslashes(htmlspecialchars($_POST['password'])));

                $auth = new Auth();
                $auth->setInfo($login, $password);

                if ($auth->checkUserFromDb()) {
                    $auth->login();
                    $back_link = $_POST["back_link"];
                    ManagerUrl::redirect($back_link);
                } else {
                    $this->error = " Not legal user. ";
                }
            }
            if ($this->error) {
                View::loadTemplate('login');
                echo("<div class='alert alert-danger'>$this->error</div>");
            }
        } else {
            View::loadTemplate('login');
        }
    }

}