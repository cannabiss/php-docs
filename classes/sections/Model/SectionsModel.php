<?php

class Sections extends Model
{

    public static function getSections()
    {
        $query = "SELECT sec.id, sec.name, sec.date_create, sec.date_update, sec.description
                  FROM section as sec";

        Database::query($query);
        $result = Database::$res_list;

        return $result;
    }

    public static function  getSection($section_id)
    {
        $query = "SELECT id, user_id, name, description
                  FROM section
                  where id = $section_id";

        Database::query($query);
        $result = Database::$res_list[0];

        return $result;
    }

    public static function  getChapters($section_id)
    {
        $query = "SELECT id, section_id, name
                  FROM chapter
                  where section_id = $section_id";

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

    public static function insertSection($sectionData)
    {
        if (Database::insert("section", $sectionData)) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteSection($section_id)
    {
        if (!$section_id)
            return false;

        if (Database::delete('section', "id=$section_id")) {
            return true;
        } else {
            return false;
        }
    }

    public static function  updateSection($section_id, $sectionData) {
        if (!$section_id) {
            return null;
        } else {
            if (Database::update("section", $sectionData, "id=" . $section_id)) {
                return true;
            } else {
                return false;
            }
        }

    }

}