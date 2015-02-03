<?php
Components::capHtml();

if ($data['refresh'] == 'yes')
    ManagerUrl::redirect('items');

$table_items = TableManager::setTableData(
    $data['items'],
    ['№', 'Наименование', 'Глава', 'Автор', 'Дата создания', 'Дата обновления', 'Описание'],
    ['id']
);

$action_column = TableManager::addColumnAction("<i class='glyphicon glyphicon-list-alt'></i>", 'glyphicon glyphicon-arrow-right', 'id');

$items = TableManager::createTable('table table-bordered');

$items .= "<form action='items' method='post'>
               <input type='hidden' name='action' value='add' class='form-control'/>";

if (Auth::isAdmin())
    $items .= Components::addButton(
        'btn btn-info',
        ['margin-left' => '93%'],
        'Add',
        'glyphicon glyphicon-plus-sign',
        $href = 'items',
        'submit'
    );

$items .= "</form>";
?>

<table style="margin-top: 0px; width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($items, 'Параграфы'); ?></td>
    </tr>
</table>


