<?php
class BlockNews extends Model
{

    public static function getNews()
    {
        $query = "SELECT id, name, date_create, date_update, description, user_id
                  FROM news";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function insertNew($newData)
    {
        if (Database::insert("news", $newData)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getNew($new_id)
    {
        $query = "SELECT id, user_id, date_create, date_update, name, description
                  FROM news
                  where id = $new_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function updateNew($new_id, $newData)
    {
        if (!$new_id) {
            return null;
        } else {
            if (Database::update("news", $newData, "id=" . $new_id)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function removeNew($new_id)
    {
        if (!$new_id)
            return false;

        if (Database::delete('news', "id=$new_id")) {
            return true;
        } else {
            return false;
        }
    }

}