<?php
Components::capHtml();

echo(Components::addButton('btn btn-info', ['margin-top' => '10px', 'margin-bottom' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'items'));

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$itemInfo .= "<form action='items' method='post'>
    <div class='form-group'>
        <input type='hidden' name='action' value='addNewItem' class='form-control'/>
        <label>Наименование:</label>
        <input type='text' class='form-control' id='name' name='name'/>
    </div>
    <div class='form-group'>
        <label>Глава:</label>
        <select type='text' class='form-control' id='chapter_name' name='chapter_name'>";

if (!empty($data['chapters'])) {
    foreach ($data['chapters'] as $chapter) {
        $itemInfo .= "<option>" . $chapter['id'] . ") " . $chapter['name'] . "</option>";
    }
}

$itemInfo .= "</select>
    </div>
    <div class='form-group'>
        <label>Описание:</label>
       <textarea class='form-control' rows='3' id='description' name='description'></textarea>
    </div>
    <div class='form-group'>
        <label>Текст:</label>
       <textarea class='form-control' rows='12' id='item_text' name='item_text'></textarea>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 94%'>Create</button>
</form>";

Components::addBlockText($itemInfo, $data['item']['title'], 'auto');