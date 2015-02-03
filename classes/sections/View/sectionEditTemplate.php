<?php
Components::capHtml();
echo(Components::addButton('btn btn-info', ['margin-top' => '10px', 'margin-bottom' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'sections'));

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$sectionInfo .= "<form action='sections' method='post'>
    <div class='form-group'>
        <input type='hidden' name='action' value='editsave' class='form-control'/>
        <input type='hidden' name='section_id' value='" . $data['section']['id'] . "' class='form-control'/>
         <input type='hidden' name='date_update' value='" . date('Y-m-d') . "' class='form-control'/>
        <label>Наименование:</label>
        <input type='text' class='form-control' name='name' value='" . $data['section']['name'] . "'/>
    </div>
    <div class='form-group'>
        <label>Описание:</label>
       <textarea class='form-control' rows='3' name='description'>" . $data['section']['description'] . "</textarea>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 94%'>Save</button>
</form>";

Components::addBlockText($sectionInfo, $data['title'], 'auto');