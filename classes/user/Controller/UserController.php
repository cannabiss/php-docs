<?php

class UserController
{
    public function index()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $user_info['name'] = addslashes($_POST['name']);
            $user_info['surname'] = addslashes($_POST['surname']);
            $user_info['login'] = addslashes($_POST['login']);
            $user_info['date_birth'] = addslashes($_POST['date_birth']);
            $user_info['country'] = addslashes($_POST['country']);
            $user_info['city'] = addslashes($_POST['city']);
            $user_info['mail'] = addslashes($_POST['mail']);
            $user_info['specialization'] = addslashes($_POST['specialization']);

            if (UserInfo::updateUser($id, $user_info)) {
                $data['status']['success'] = 'Data saved successfully!';
            } elseif (!UserInfo::updateUser($id, $user_info)) {
                $data['status']['error'] = 'Error saving data!';
            }
        }

        $user = UserInfo::getUser($_SESSION['user_id']);
        $data['user'] = $user;
        $sections = UserInfo::getSectionsUser($data['user']['id']);
        $data['sections'] = $sections;

        View::loadTemplate('user', $data);

    }
}