<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

if ($data['refresh'] == 'yes')
    ManagerUrl::redirect('news');


$tableNews = TableManager::setTableData(
    $data['news'],
    ['№', 'Наименование', 'Дата создания', 'Дата обновления', 'Описание'],
    ['id', 'user_id']
);

$action_column = TableManager::addColumnAction("<i class='glyphicon glyphicon-list-alt'></i>", 'glyphicon glyphicon-arrow-right', 'id');

$news = TableManager::createTable('table table-bordered');

$news .= "<form action='news' method='post'>
          <input type='hidden' name='action' value='add' class='form-control'/>";

if (Auth::isAdmin())
    $news .= Components::addButton(
        'btn btn-info',
        ['margin-left' => '93%'],
        'Add',
        'glyphicon glyphicon-plus-sign',
        $href = 'news',
        'submit'
    );
$news .= "</form>";

?>

<table style="margin-top: 0px; width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($news, 'Новости'); ?></td>
    </tr>
</table>