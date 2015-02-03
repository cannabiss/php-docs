<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$cap = "<center><h3 style='color: #0088CC'><b>" . $data['chapter']['name'] . "</b></h3></center>
        <table>
        <tr>
        <td style='color: #245269; width: 250px'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата создания: </b></i></td>
        <td style='color: green'><b>". $data['chapter']['date_create'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата обновления: </b></i></td>
        <td style='color: green'><b>". $data['chapter']['date_update'] ."</b></td>
        </tr>
        </table>";
$content = $cap;

if (my_object($data['chapter']['user_id'])) {
    $formEditDelete = Components::addDelEditForm('chapters', ['chapter_id' => $data['chapter']['id']]);
}

if (!empty($data['items'])) {
    $items = "<ol type='I'>";
    foreach ($data['items'] as $item) {
        $items .= "<li style='color: #555555'>" . $item['name'] . "</li>";
    }
    $items .= "</ol>";

    $content .= $items;
}

$description = "<p style='color: #555555'>" . $data['chapter']['description'] . "</p>";

?>

<table style="width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($cap, $formEditDelete); ?></td>
    </tr>
    <tr>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($items, "<i class='glyphicon glyphicon-list'>&nbsp<b>Содержание главы:</b></i>", 100, '100%'); ?></td>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($description, 'Описание главы:', 100, '100%'); ?></td>
    </tr>
</table>
