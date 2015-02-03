<?php

class UserInfo extends Model
{

    public static function  getUser($id)
    {
        $query = "SELECT id, name, surname, login, password, mail, country, city, date_birth, specialization
                  FROM users
                  where id = $id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function updateUser($id, $userData)
    {
        if (Database::update("users", $userData, "id=" . $id)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getSectionsUser($user_id)
    {
        $query = "SELECT name, date_create, date_update
                  FROM section
                  where user_id=$user_id";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

}