<?php
class View
{
    public function loadTemplate($templateName, $data = null, $className = null)
    {
        if (!$className)
            $className = $templateName;
        if ($templateName) {
            $dir = 'classes/' . $className . '/View';
            $files = $templateName . 'Template';
            require_once $_SERVER["DOCUMENT_ROOT"] . '/' . $dir . '/' . $files . '.php';
        } else {
            die ('Шаблон не найден!');
        }
    }

    public function loadStaticBlock($blockName = array())
    {
        $lib = new IncFiles();
        $dir = 'classes/staticBlock';

        $file = $lib->requireFilesPhp($dir, $blockName);
    }

}