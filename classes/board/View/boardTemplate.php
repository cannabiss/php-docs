<?php
Components::capHtml();

$content = "<h2 style='text-align: center; color: #0088CC'><b>Система ведения рабочей документации.</b></h2><hr>
<h4><i class='glyphicon glyphicon-fire' style='color: #0088CC'>&nbsp<u><b>Основные возможности:</b> </u></i></h4>
<ul>
    <li>Просмотр и чтение технической документации;</li>
    <li>Ведение собственной документации;</li>
    <li>Управление пользователями;</li>
</ul>
<p style='font-size: 16px'>Все пользователи, зарегистрированные в системе,
               имеют право на просмотр текущей документации,
               ведущейся в системе, а также создание новых документов,
               разделов, параграфов ... Пользователи с правами администратора имеют
               доступ к более широкому списку функций.</p></br>";

if (!empty($data['news'])) {
    $content .= "<h4><i class='glyphicon glyphicon-pushpin' style='color: #0088CC'>&nbsp<u><b>Последние новости:</b> </u></i></h4>";
    foreach ($data['news'] as $new) {
        $content .= "<p style='text-indent: 3em'><i class='glyphicon glyphicon-calendar'>&nbsp<b>" . $new['date_create'] . ": " . $new['name'] . " </b></i>
        (" . $new['description'] . ");</p>";
    }
}

Components::addBlockText($content, 'Библиотека документов', 'auto');
