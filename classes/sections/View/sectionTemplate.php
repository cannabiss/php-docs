<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$cap = "<center><h3 style='color: #0088CC'><b>" . $data['section']['content']['name'] . "</b></h3></center>";
$content = $cap;

if (my_object($data['section']['content']['user_id'])) {
    $formEditDelete = Components::addDelEditForm('sections', ['section_id' => $data['section']['content']['id']]);
}

if (!empty($data['chapters'])) {
    $chapters = "<ol type='I'>";
    foreach ($data['chapters'] as $chapter) {
        $chapters .= "<li style='color: #555555'>" . $chapter['name'] . "</li>";
        if (!empty($chapter['items'])) {
            $items = "<ol>";
            foreach ($chapter['items'] as $item) {
                $items .= "<li style='color: #555555'><i>" . $item['name'] . ".</i></li>";
            }
            $items .= "</ol></br>";
            $chapters .= $items;
        }
    }
    $chapters .= "</ol>";

    $content .= $chapters;
}

$description = "<p style='color: #555555'>" . $data['section']['content']['description'] . "</p>";

?>

<table style="width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($cap, $formEditDelete); ?></td>
    </tr>
    <tr>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($chapters, "<i class='glyphicon glyphicon-list'>&nbsp<b>Содержание раздела:</b></i>", 100, '100%'); ?></td>
        <td style="height: 100%; width: 50%"><? Components::addBlockText($description, 'Описание раздела:', 100, '100%'); ?></td>
    </tr>
</table>