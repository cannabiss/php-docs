<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$cap = "<center><h3 style='color: #0088CC'><b>" . $data['new']['name'] . "</b></h3></center>";
$content = $cap;

if (my_object($data['new']['user_id'])) {
    $formEditDelete = Components::addDelEditForm('news', ['new_id' => $data['new']['id']]);
}

$newInfo = "<table>
        <tr>
        <td style='color: #245269; width: 250px'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата создания: </b></i></td>
        <td style='color: green'><b>". $data['new']['date_create'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата обновления: </b></i></td>
        <td style='color: green'><b>". $data['new']['date_update'] ."</b></td>
        </tr>
        </table>";

$description = "<p style='color: #555555'>" . $data['new']['description'] . "</p>";

?>

<table style="width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($cap, $formEditDelete); ?></td>
    </tr>
    <tr>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($newInfo, "<i class='glyphicon glyphicon-info-sign'>&nbsp<b>Информация:</b></i>", 100, '100%'); ?></td>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($description, 'Описание главы:', 100, '100%'); ?></td>
    </tr>
</table>
