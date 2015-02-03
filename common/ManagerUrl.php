<?php
class ManagerUrl
{
    public static function getUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }

    public static function getPath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/';
    }

    public static function redirect($back_link = null)
    {
        if ($back_link) {
            header("location:" . ManagerUrl::getUrl() . $back_link);
        } else {
            header("location:" . ManagerUrl::getUrl() . Route::$pageDefault);

        }
    }
}