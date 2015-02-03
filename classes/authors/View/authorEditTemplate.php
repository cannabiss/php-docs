<?php
Components::capHtml();
echo(Components::addButton('btn btn-info', ['margin-top' => '10px', 'margin-bottom' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'authors'));

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$authorInfo = "<form action='authors' method='post'>
    <div class='form-group'>
        <input type='hidden' name='action' value='editsave' class='form-control'/>
        <input type='hidden' name='author_id' value='" . $data['author']['id'] . "' class='form-control'/>
        <div class='form-group'>
        <label>Имя</label>
        <input type='text' class='form-control' id='name' name='name' value='" . $data['author']['name'] . "'/>
    </div>
    <div class='form-group'>
        <label>Фамилия</label>
        <input type='text' class='form-control' id='surname' name='surname' value='" . $data['author']['surname'] . "'/>
    </div>
    <div class='form-group'>
        <label>Логин</label>
        <input type='text' class='form-control' id='login' name='login' value='" . $data['author']['login'] . "'/>
    </div>
    <div class='form-group'>
        <label for='exampleInputPassword1'>Пароль</label>
        <input type='password' class='form-control' id='exampleInputPassword1' name='password' value='" . $data['author']['password'] . "'/>
    </div>
    <div class='form-group'>
        <label>Дата рождения</label>
        <input type='text' class='form-control' id='date_birth' name='date_birth' value='" . $data['author']['date_birth'] . "'/>
    </div>
    <div class='form-group'>
        <label>Страна</label>
        <input type='text' class='form-control' id='country' name='country' value='" . $data['author']['country'] . "'/>
    </div>
    <div class='form-group'>
        <label>Город</label>
        <input type='text' class='form-control' id='city' name='city' value='" . $data['author']['city'] . "'/>
    </div>
    <div class='form-group'>
        <label>Специализация</label>
        <input type='text' class='form-control' id='specialization' name='specialization' value='" . $data['author']['specialization'] . "'/>
    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Email</label>
        <input type='email' class='form-control' id='exampleInputEmail1' name='mail' value='" . $data['author']['mail'] . "'/>
    </div>
    <div class='form-group'>
        <table>
            <tr>";

if ($data['author']['is_admin'] == 1)
    $authorInfo .= "<td><input type='checkbox' checked='true' class='form-control' id='is_admin' name='is_admin'/></td>";
else
    $authorInfo .= "<td><input type='checkbox' class='form-control' id='is_admin' name='is_admin'/></td>";

$authorInfo .= "<td>&nbsp</td>
                <td><label>Администратор</label></td>
            </tr>
        </table>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 94%'>Save</button>
</form>";

Components::addBlockText($authorInfo, $data['title'], 'auto');