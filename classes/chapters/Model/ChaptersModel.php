<?php

class Chapters extends Model
{

    public static function getChapters()
    {
        $query = "SELECT chap.id, chap.name, sec.name as namesec, chap.date_create, chap.date_update, chap.description
                  FROM chapter as chap
                  INNER JOIN section as sec
                  ON sec.id = chap.section_id";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function  getItems($chapter_id)
    {
        $query = "SELECT id, chapter_id, name
                  FROM items
                  where chapter_id = $chapter_id";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function getChapter($chapter_id)
    {
        $query = "SELECT id, user_id, date_create, date_update, name, description
                  FROM chapter
                  where id = $chapter_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function deleteChapter($chapter_id)
    {
        if (!$chapter_id)
            return false;

        if (Database::delete('section', "id=$chapter_id")) {
            return true;
        } else {
            return false;
        }
    }

    public static function insertChapter($chapterData)
    {
        if (Database::insert("chapter", $chapterData)) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateChapter($chapter_id, $chapterData)
    {
        if (!$chapter_id) {
            return null;
        } else {
            if (Database::update("chapter", $chapterData, "id=" . $chapter_id)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function getSections()
    {
        $query = "SELECT sec.id, sec.name
                  FROM section as sec";
        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function removeChapter($chapter_id) {
        if (!$chapter_id)
            return false;

        if (Database::delete('chapter', "id=$chapter_id")) {
            return true;
        } else {
            return false;
        }
    }


}