<?php
class IncFiles
{

    public static function requireFilesPhp($folder = null, $files = null, $filetype = 'php')
    {
        if (!$folder) {
            $folder = $_SERVER["DOCUMENT_ROOT"] . '/';
        } else {
            $folder = $_SERVER["DOCUMENT_ROOT"] . '/' . $folder . '/';
        }
        if ($files) {
            foreach ($files as $file) {
                if (file_exists($folder . $file . '.' . $filetype))
                    require_once($folder . $file . '.' . $filetype);
            }
        } else {
            $filedir = scandir($folder);
            for ($i = 1; $i <= 3; $i++) {
                array_shift($filedir);
            }
            if (!empty($filedir)) {
                foreach ($filedir as $file) {
                    $point = strripos($file, '.');
                    if ($point)
                        require_once($folder . $file);
                }
            } else throw new Exception ('В указанном каталоге нет PHP файлов для подключения!');
        }
    }

    public static function requireFilesJsCss($folder = null, $files = null, $filetype = 'js')
    {
        if ($filetype == 'js') {
            if (!$folder) {
                $folder = '/libs/js/';
            } else {
                $folder = '/libs/' . $folder . '/';
            }
        } elseif ($filetype == 'css') {
            if (!$folder) {
                $folder = '/libs/css/';
            } else {
                $folder = '/libs/' . $folder . '/';
            }
        }
        if ($files) {
            foreach ($files as $file) {
                $lib = $folder . $file . '.' . $filetype;
                echo("<link rel='stylesheet' href='{$lib}'>");
            }
        } else {
            $filedir = scandir($folder);
            for ($i = 1; $i <= 3; $i++) {
                array_shift($filedir);
            }
            if (!empty($filedir)) {
                foreach ($filedir as $file) {
                    $point = strripos($file, '.');
                    if ($point) {
                        $lib = $folder . $file;
                        echo("<link rel='stylesheet' href='{$lib}'>");
                    }
                }
            } else throw new Exception ('В указанном каталоге нет JS/CSS файлов для подключения!');
        }
    }


}