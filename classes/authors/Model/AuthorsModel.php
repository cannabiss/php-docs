<?php
class Authors extends Model
{

    public static function getAuthors()
    {
        $query = "SELECT id, name, surname, date_birth, country, city, specialization
        FROM users";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function insertAuthor($authorData) {
        if (Database::insert("users", $authorData)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAuthor($author_id)
    {
        $query = "SELECT * FROM users where id = $author_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function updateAuthor($author_id, $authorData)
    {
        if (!$author_id) {
            return null;
        } else {
            if (Database::update("users", $authorData, "id=" . $author_id)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function removeAuthor($author_id)
    {
        if (!$author_id)
            return false;

        if (Database::delete('users', "id=$author_id")) {
            return true;
        } else {
            return false;
        }
    }

}