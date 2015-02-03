<?php
Components::capHtml();
echo(Components::addButton('btn btn-info', ['margin-top' => '10px', 'margin-bottom' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'news'));

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$newInfo .= "<form action='news' method='post'>
    <div class='form-group'>
    <input type='hidden' name='action' value='addNewNew' class='form-control'/>
        <label>Наименование:</label>
        <input type='text' class='form-control' id='name' name='name'/>
    </div>
    <div class='form-group'>
        <label>Содержание:</label>
       <textarea class='form-control' rows='3' id='description' name='description'></textarea>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 94%'>Create</button>
</form>";

Components::addBlockText($newInfo, $data['title'], 'auto');