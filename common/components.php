<?php
class Components
{
    //add Block text
    public static function  addBlockText($content = null, $title = 'Title', $height = 100, $width = 'auto')
    {
        $data = "<div class='panel panel-info' style='height: " . $height . "%; width: " . $width . "'>
    <div class='panel-title alert-info' style='height: 30px'><b>" . $title . "</b></div>
    <div class='panel-body'>" . $content . "</div>
    </div>";
        echo($data);
    }

    //add title page
    public static function addTitle()
    {
        $page = Route::getCurPage();
        echo('<title>Page ' . ucfirst($page) . '</title>');
    }

    //body style
    public static function bodyColor($color = '#e0e0e0')
    {
        $background = "<body style='background: " . $color . "'/>";
        echo($background);
    }

    //encoding html
    public static function encodingHtml($code = 'utf-8')
    {
        $encoding = "<meta http-equiv='Content-Type' content='text/html; charset=" . $code . "'/>";
        echo($encoding);
    }

    //add button
    public static function addButton($class = 'btn btn-primary', $style = array(), $title = 'button', $icon = null, $href = '#', $type = 'button', $buttonClick = null)
    {
        $content = "<a href='" . $href . "'><button type=" . $type . " class='" . $class . "'";

        if (!empty($style)) {
            foreach ($style as $key => $val) {
                $strStyle .= $key . ": " . $val . ";";
            }
        }

        if ($strStyle)
            $content .= " style = '" . $strStyle . "'";

        if ($buttonClick)
            $content .= " onclick = '" . $buttonClick . "'";
        $content .= ">";

        if ($icon)
            $content .= "<i class= '" . $icon . "'>&nbsp";
        $content .= "<b>" . $title . "</b></i></button></a>";
        return $content;
    }

    //add alerts
    public static function addBlockAlert($class = 'alert alert-success', $message_alert = null)
    {
        $text_alert = "<div class='" . $class . "' style='text-align: center; margin-top: 10px; margin-bottom: 0px'>" . $message_alert . "</div>";
        echo($text_alert);
    }

    //cap documents
    public static function capHtml()
    {
        self::encodingHtml();
        self::addTitle();
        self::bodyColor();
        $filesJs = ['bootstrap.min'];
        $fileCss = ['bootstrap.min', 'bootstrap-theme.min'];
        incFiles::requireFilesJsCss('bootstrap/js', $filesJs, 'js');
        incFiles::requireFilesJsCss('bootstrap/css', $fileCss, 'css');

        View::loadStaticBlock(['userInfo',]);
        echo(Menu::createBoard());
    }

    //add Edit-Delete Form
    public static function addDelEditForm($formAction, $postValue = array())
    {
        if (!$formAction)
            return null;

        $form = "<form action='" . $formAction . "' method='post' style='margin-left: 89%'>";

        if (!empty($postValue)) {
            foreach ($postValue as $name => $value) {
                $form .= "<input type='hidden' class='form-control' name='" . $name . "' value='" . $value . "'/>";
            }
        }

        $form .= "<input type='submit' name='action' value=edit class='btn btn-info btn-sm' style='width: 60px; border-color: #ffffff'/>
               <input type='submit' name='action' value='delete' class='btn btn-info btn-sm' style='width: 60px; border-color: #ffffff'/>
               </form>";

        return $form;
    }
}