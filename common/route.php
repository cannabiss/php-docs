<?php

class Route
{
    public static $pageDefault = 'board';

    public static function start()
    {
        $pages = Menu::$tabs['pageTabs'];

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        $page = self::getCurPage();

        $auth = new Auth;
        $auth->setSessionInfo();

        if ($auth->checkLogged() === true) {
            if ($page == '') {
                $page = self::$pageDefault;
            } elseif (!in_array($page, $pages)) {
                $page = 'error';
            }
        } elseif ($page != 'login') {
            $auth->toLogin();
        }

        get_model($page);
        get_controller($page);
    }

    public static function  getCurPage()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($routes[1])) {
            $page = strtolower($routes[1]);
        } else {
            self::$pageDefault;
        }

        return $page;
    }
}