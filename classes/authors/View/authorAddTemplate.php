<?php
Components::capHtml();
echo(Components::addButton('btn btn-info', ['margin-top' => '10px', 'margin-bottom' => '10px'], 'Back', 'glyphicon glyphicon-arrow-left', ManagerUrl::getUrl() . 'authors'));

if (isset($data['error']))
    Components::addBlockAlert('alert alert-danger', $data['error']);
if (isset($data['success']))
    Components::addBlockAlert('alert alert-success', $data['success']);

$authorInfo .= "<form action='authors' method='post'>
    <input type='hidden' name='action' value='addNewAuthor' class='form-control'/>
    <input type='hidden' class='form-control' id='id' name='id'/>
    <div class='form-group'>
        <label>Имя</label>
        <input type='text' class='form-control' id='name' name='name'/>
    </div>
    <div class='form-group'>
        <label>Фамилия</label>
        <input type='text' class='form-control' id='surname' name='surname'/>
    </div>
    <div class='form-group'>
        <label>Логин</label>
        <input type='text' class='form-control' id='login' name='login'/>
    </div>
    <div class='form-group'>
        <label>Пароль</label>
        <input type='text' class='form-control' id='login' name='password'/>
    </div>
    <div class='form-group'>
        <label>Дата рождения</label>
        <input type='text' class='form-control' id='date_birth' name='date_birth'/>
    </div>
    <div class='form-group'>
        <label>Страна</label>
        <input type='text' class='form-control' id='country' name='country'/>
    </div>
    <div class='form-group'>
        <label>Город</label>
        <input type='text' class='form-control' id='city' name='city'/>
    </div>
    <div class='form-group'>
        <label>Специализация</label>
        <input type='text' class='form-control' id='specialization' name='specialization'/>
    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Email</label>
        <input type='email' class='form-control' id='exampleInputEmail1' name='mail'/>
    </div>
    <div class='form-group'>
        <table>
            <tr>
                <td><input type='checkbox' class='form-control' id='is_admin' name='is_admin'/></td>
                <td>&nbsp</td>
                <td><label>Администратор</label></td>
            </tr>
        </table>
    </div>
    <button type='submit' class='btn btn-info' style='margin-left: 94%'>Create</button>
</form>";

Components::addBlockText($authorInfo, $data['author']['title'], 'auto');