<?php
Components::capHtml();

if ($data['refresh'] == 'yes')
    ManagerUrl::redirect('chapters');

$table_chapters = TableManager::setTableData(
    $data['chapters'],
    ['№', 'Наименование', 'Раздел', 'Дата создания', 'Дата обновления', 'Описание'],
    ['id']
);

$action_column = TableManager::addColumnAction("<i class='glyphicon glyphicon-list-alt'></i>", 'glyphicon glyphicon-arrow-right', 'id');

$chapters = TableManager::createTable('table table-bordered');

$chapters .= "<form action='chapters' method='post'>
               <input type='hidden' name='action' value='add' class='form-control'>";

if (Auth::isAdmin())
    $chapters .= Components::addButton(
        'btn btn-info',
        ['margin-left' => '93%'],
        'Add',
        'glyphicon glyphicon-plus-sign',
        $href = 'chapters',
        'submit'
    );

$chapters .= "</form>";
?>

<table style="margin-top: 0px; width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($chapters, 'Главы'); ?></td>
    </tr>
</table>