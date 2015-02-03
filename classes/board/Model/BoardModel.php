<?php
class Board extends Model
{

    public static function getlastNews()
    {
        $query = "SELECT id, name, date_create, date_update, description, user_id
                  FROM news
                  ORDER BY date_create DESC
                  LIMIT 10";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

}