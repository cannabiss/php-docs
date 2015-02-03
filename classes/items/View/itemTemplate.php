<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$cap = "<center><h3 style='color: #0088CC'><b>" . $data['item']['name'] . "</b></h3></center>";
$content = $cap;

if (my_object($data['item']['author_id'])) {
    $formEditDelete = Components::addDelEditForm('items', ['item_id' => $data['item']['id']]);
}

$itemInfo = "<table>
        <tr>
        <td style='color: #245269; width: 250px'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата создания: </b></i></td>
        <td style='color: green'><b>". $data['item']['date_create'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата обновления: </b></i></td>
        <td style='color: green'><b>". $data['item']['date_update'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><i class='glyphicon glyphicon-folder-open'>&nbsp<b>Глава: </b></i></td>
        <td style='color: green'><b>". $data['item']['chapter'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><i class='glyphicon glyphicon-user'>&nbsp<b>Автор: </b></i></td>
        <td style='color: green'><b>". $data['item']['author'] ."</b></td>
        </tr>
        </table>";

$description = "<p style='color: #555555'>" . $data['item']['description'] . "</p>";

?>

<table style="width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($cap, $formEditDelete); ?></td>
    </tr>
    <tr>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($itemInfo, "<i class='glyphicon glyphicon-info-sign'>&nbsp<b>Информация:</b></i>", 100, '100%'); ?></td>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($description, 'Описание параграфа:', 100, '100%'); ?></td>
    </tr>
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($data['item']['item_text'], "<i class='glyphicon glyphicon-book'>&nbsp<b>Текст:</b></i>"); ?></td>
    </tr>
</table>