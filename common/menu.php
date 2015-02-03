<?php
class Menu
{

    public static $tabs = array(
        'nameTabs' => array(
            'Board',
            'Sections',
            'Chapters',
            'Items',
            'Authors'
        ),
        'pageTabs' => array(
            'board',
            'sections',
            'chapters',
            'items',
            'authors',
            'settings',
            'user',
            'news',
            'error'
        )
    );

    public static function createBoard()
    {
//        var_dump($_SESSION);
        $page = Route::getCurPage();

        if ($page == 'settings') {
            self::$tabs['nameTabs'][5] = ucfirst($page);
        }
        if ($page == 'user') {
            self::$tabs['nameTabs'][6] = ucfirst($page);
        }
        if (Auth::isAdmin()) {
            self::$tabs['nameTabs'][7] = 'News';
        }

        $contents = "<div class='btn-group btn-group-justified'>";

        foreach (self::$tabs['nameTabs'] as $key => $value) {
            if (self::$tabs['pageTabs'][$key] == $page) {
                $class = "'" . "btn btn-info" . "'";
            } else {
                $class = "'" . "btn btn-default" . "'";
            }
            $contents .= "<div class='btn-group'>
                            <a href = " . ManagerUrl::getUrl() . self::$tabs['pageTabs'][$key] . "><button type='button' class=" . $class . " style='border-color: #0088CC'>" . $value . "</button></a>
                          </div>";
        }

        $contents .= "</div>";

        return $contents;
    }
}