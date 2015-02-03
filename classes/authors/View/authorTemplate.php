<?php
Components::capHtml();

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$cap = "<center><h3 style='color: #0088CC'><b>" . $data['author']['name']. ' ' . $data['author']['surname'] . '.' . "</b></h3></center>";
$content = $cap;

if (Auth::isAdmin()) {
    $formEditDelete = Components::addDelEditForm('authors', ['author_id' => $data['author']['id']]);
}

$authorInfo = "<table>
        <tr>
        <td style='color: #245269; width: 250px'><i class='glyphicon glyphicon-calendar'>&nbsp<b>Дата рождения: </b></i></td>
        <td style='color: green'><b>". $data['author']['date_birth'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><b>Страна: </b></td>
        <td style='color: green'><b>". $data['author']['country'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><b>Город: </b></td>
        <td style='color: green'><b>". $data['author']['city'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><b>Mail: </b></td>
        <td style='color: green'><b>". $data['author']['mail'] ."</b></td>
        </tr>
        <tr>
        <td style='color: #245269'><b>Специализация: </b></td>
        <td style='color: green'><b>". $data['author']['specialization'] ."</b></td>
        </tr>
        </table>";

$cap .= $authorInfo;

?>

<table style="width: 100%; height: auto">
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText($cap, $formEditDelete); ?></td>
    </tr>
</table>
