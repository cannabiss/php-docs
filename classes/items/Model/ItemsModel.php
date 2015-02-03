<?php
class Items extends Model
{

    public static function getItems()
    {
        $query = "SELECT item.id, item.name, chap.name as name_chap, CONCAT(us.name, ' ', us.surname) as autor_name, item.date_create, item.date_update, item.description
                  FROM items as item
                  INNER JOIN chapter as chap
                  ON chap.id = item.chapter_id
                  INNER JOIN users as us
                  ON us.id=item.author_id";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function getItem($item_id)
    {
        $query = "SELECT id, author_id, author, chapter_id, date_create, date_update, name, description, item_text
                  FROM items
                  where id = $item_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function getChapterItem($chapter_id) {
        $query = "SELECT id, name
                  FROM chapter
                  where id = $chapter_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function getItemChapters()
    {
        $query = "SELECT id, name
                  FROM chapter";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function getItemAuthor($author_id)
    {
        $query = "SELECT id, name, surname
                  FROM users
                  where id = $author_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function insertItem($itemData)
    {
        if (Database::insert("items", $itemData)) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateItem($item_id, $itemData)
    {
        if (!$item_id) {
            return null;
        } else {
            if (Database::update("items", $itemData, "id=" . $item_id)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function removeItem($item_id) {
        if (!$item_id)
            return false;

        if (Database::delete('items', "id=$item_id")) {
            return true;
        } else {
            return false;
        }
    }

}