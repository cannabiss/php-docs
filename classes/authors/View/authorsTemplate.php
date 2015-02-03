<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

if ($data['refresh'] == 'yes')
    ManagerUrl::redirect('authors');

$table_authors = TableManager::setTableData(
    $data['authors'],
    ['№', 'Имя', 'Фамилия', 'Дата рождения', 'Страна', 'Город', 'Специализация'],
    ['id']
);

$action_column = TableManager::addColumnAction("<i class='glyphicon glyphicon-list-alt'></i>", 'glyphicon glyphicon-arrow-right', 'id');

$authors = TableManager::createTable('table table-bordered');

$authors .= "<form action='authors' method='post'>
               <input type='hidden' name='action' value='add' class='form-control'/>";

if (Auth::isAdmin())
    $authors .= Components::addButton(
        'btn btn-info',
        ['margin-left' => '93%'],
        'Add',
        'glyphicon glyphicon-plus-sign',
        $href = 'authors',
        'submit'
    );

$authors .= "</form>";
?>

<table style="margin-top: 0px; width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($authors, 'Авторы'); ?></td>
    </tr>
</table>
