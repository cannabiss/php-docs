<?php

//Выбор конфига
function get_conf($name = null)
{
    static $conf;
    if (!$conf) {
        $conf = require $_SERVER["DOCUMENT_ROOT"] . '/configs' . DIRECTORY_SEPARATOR . 'config.inc';
    }
    if ($name) {
        return isset($conf[$name]) ? $conf[$name] : null;
    } else {
        return $conf;
    }
}

//get Controller
function get_controller($controllerName, $action = null, $param = null)
{
    if ($controllerName) {
        $directory = 'classes/' . $controllerName . '/Controller';
        $files = [ucfirst($controllerName) . 'Controller'];
        IncFiles::requireFilesPhp($directory, $files);
        $controller_name = ucfirst($controllerName) . 'Controller';
        $controller = new $controller_name;
        if (empty($action)) {
            if (empty($param))
                $controller->index();
            else
                $controller->index($param);
        } else {
            if (empty($params)) {
                $action .= "()";
                $controller->$action;
            } else {
                $action .= "($param)";
                $controller->$action;
            }
        }

    } else {
        echo('Контроллер не найден.');
    }

}

//my Object
function my_object($object_user_id)
{
    if (!$object_user_id)
        return null;

    if ($object_user_id == $_SESSION['user_id'])
        return true;
    else
        return false;
}

//action Post
function action_post($value_action)
{
    if ($value_action)
        $_POST['action'] = $value_action;
}

//get Model
function get_model($modelName)
{
    if ($modelName) {
        $directory = 'classes/' . $modelName . '/Model';
        $files = [ucfirst($modelName) . 'Model'];
        IncFiles::requireFilesPhp($directory, $files);
    } else {
        echo('Модель не найдена.');
    }

}



