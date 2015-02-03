<?php
Components::capHtml();

if ($data['refresh'] == 'yes')
    ManagerUrl::redirect('sections');

$tableSections = TableManager::setTableData(
    $data['sections'],
    ['№', 'Наименование', 'Дата создания', 'Дата обновления', 'Описание'],
    ['id']
);

//$column_test = tableManager::addColumnData(
//    [2, 7, 8],
//    'test'
//);

$action_column = TableManager::addColumnAction("<i class='glyphicon glyphicon-list-alt'></i>", 'glyphicon glyphicon-arrow-right', 'id');

$sections = TableManager::createTable('table table-bordered');


$sections .= "<form action='sections' method='post'>
               <input type='hidden' name='action' value='add' class='form-control'/>";

if (Auth::isAdmin())
    $sections .= Components::addButton(
        'btn btn-info',
        ['margin-left' => '93%'],
        'Add',
        'glyphicon glyphicon-plus-sign',
        $href = 'sections',
        'submit'
    );

$sections .= "</form>";
?>

<table style="margin-top: 0px; width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($sections, 'Разделы'); ?></td>
    </tr>
</table>

