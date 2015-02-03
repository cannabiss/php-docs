<?php
Components::capHtml();

$user = $_SESSION['name'] . ' ' . $_SESSION['surname'];

echo(Components::addButton('btn btn-info', ['margin-top' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'board'));

$userInfo = "<p style='color: #0088CC'><b>Edit user: <i style='color: black'>" . $user . "</i></b></p>";
$userInfo .= "<form action='user' method='post'>
    <input type='hidden' class='form-control' id='id' name='id' value='" . $data['user']['id'] . "'/>
    <div class='form-group'>
        <label>Name</label>
        <input type='text' class='form-control' id='name' name='name' value='" . $data['user']['name'] . "'/>
    </div>
    <div class='form-group'>
        <label>Surname</label>
        <input type='text' class='form-control' id='surname' name='surname' value='" . $data['user']['surname'] . "'/>
    </div>
    <div class='form-group'>
        <label>Login</label>
        <input type='text' class='form-control' id='login' name='login' value='" . $data['user']['login'] . "'/>
    </div>
    <div class='form-group'>
        <label>Date of birth</label>
        <input type='text' class='form-control' id='date_birth' name='date_birth' value='" . $data['user']['date_birth'] . "'/>
    </div>
    <div class='form-group'>
        <label>Country</label>
        <input type='text' class='form-control' id='country' name='country' value='" . $data['user']['country'] . "'/>
    </div>
    <div class='form-group'>
        <label>City</label>
        <input type='text' class='form-control' id='city' name='city' value='" . $data['user']['city'] . "'/>
    </div>
    <div class='form-group'>
        <label>Specialization</label>
        <input type='text' class='form-control' id='specialization' name='specialization' value='" . $data['user']['specialization'] . "'/>
    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Email</label>
        <input type='email' class='form-control' id='exampleInputEmail1' name='mail' value='" . $data['user']['mail'] . "'/>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 93%'>Save</button>
</form>";

if (isset($data['status']['success']))
    Components::addBlockAlert('alert alert-success', $data['status']['success']);
if (isset($data['status']['error']))
    Components::addBlockAlert('alert alert-danger', $data['status']['error']);

$table_sections = TableManager::setTableData(
    $data['sections'],
    ['№', 'Наименование', 'Дата создания', 'Дата обновления']
);

$sections = TableManager::createTable('table table-striped');
?>

<table style="margin-top: 10px; width: 100%; height: auto">
    <!--    <tr>-->
    <!--        <td style="height: 100%" colspan="3">-->
    <?//Components::addBlockText($userInfo, 'User info');?><!--</td>-->
    <!--    </tr>-->
    <tr>
        <td style="height: 100%"><? Components::addBlockText($userInfo, 'User info', 95, '100%'); ?></td>
        <td style="width: 10px">&nbsp</td>
        <td style="height: 100%"><? Components::addBlockText($sections, 'Sections user', 95, '400px'); ?></td>
    </tr>
    <tr>
        <td style="height: 100%" colspan="3"><? Components::addBlockText('List files', 'Files user'); ?></td>
    </tr>
</table>

