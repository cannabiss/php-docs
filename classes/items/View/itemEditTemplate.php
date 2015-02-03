<?php
Components::capHtml();
echo(Components::addButton('btn btn-info', ['margin-top' => '10px', 'margin-bottom' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'items'));

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$newInfo = "<form action='items' method='post'>
    <div class='form-group'>
        <input type='hidden' name='action' value='editsave' class='form-control'/>
        <input type='hidden' name='new_id' value='" . $data['new']['id'] . "' class='form-control'/>
         <input type='hidden' name='date_update' value='" . date('Y-m-d') . "' class='form-control'/>
        <label>Наименование:</label>
        <input type='text' class='form-control' name='name' value='" . $data['new']['name'] . "'/>
    </div>
    <div class='form-group'>
        <label>Описание:</label>
       <textarea class='form-control' rows='3' name='description'>" . $data['new']['description'] . "</textarea>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 94%'>Save</button>
</form>";

Components::addBlockText($newInfo, $data['title'], 'auto');