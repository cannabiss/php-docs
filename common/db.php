<?php

class Database
{

    static $last_sql;

    static $res_list;

    static function get_db($host, $database, $user, $password)
    {
        if ($dbconnect = mysql_connect($host, $user, $password)) {
            if ($dbconnect) {
                mysql_query('SET NAMES "utf8"');
                $db = mysql_select_db($database);
                if ($db)
                    return true;
            }
        } else
            return false;
    }

    static function query($sql)
    {
        if (!$sql) {
            return false;
        }

        if (!$res = mysql_query($sql)) {
            return false;
        }

        Database::$last_sql = $sql;
        Database::$res_list = array();

        while ($row = mysql_fetch_assoc($res)) {

            $row_array = array();
            foreach ($row as $key => $val)
                $row_array[$key] = stripslashes($val);
            Database::$res_list[] = $row_array;
        }

        return true;
    }

    static function update($table_name, $data_array, $where)
    {
        if (!$data_array || !$where || !$table_name) return null;

        $sql = "update {$table_name} set ";

        $val_table = array();
        foreach ($data_array as $key => $val) {
            $val = addslashes($val);
            $val_table[] = "$key = '$val'";

        }
        $sql .= implode(",", $val_table) . " where $where;";
        Database::$last_sql = $sql;
        Database::$res_list = array();
        $res = mysql_query($sql);

        if (!$res) {
            return false;
        }

        if ($res) {
            while ($row = mysql_fetch_assoc($res)) {
                $row_array = array();
                foreach ($row as $key => $val)
                    $row_array[$key] = stripslashes($val);
                Database::$res_list[] = $row_array;
            }
            return true;
        }

    }

    static function delete($table_name, $where = null)
    {

        $sql = "delete from {$table_name}";

        if ($where)
            $sql .= " where $where;";

        Database::$last_sql = $sql;
        Database::$res_list = array();
        $res = mysql_query($sql);

        if (!$res) {
            return false;
        }

        if ($res) {
            while ($row = mysql_fetch_assoc($res)) {
                $row_array = array();
                foreach ($row as $key => $val)
                    $row_array[$key] = stripslashes($val);
                Database::$res_list[] = $row_array;
            }
            return true;
        }

    }

    static function insert($table_name, $data_array)
    {

        $sql = "insert into {$table_name} ";

        $val_table = array();
        foreach ($data_array as $key => $val) {
            $val = addslashes($val);
            $field_table[] = "$key";
            $val_table[] = "'$val'";

        }

        $sql .= "(" . implode(",", $field_table) . ") values (" . implode(",", $val_table) . ")";

        Database::$last_sql = $sql;
        Database::$res_list = array();
        $res = mysql_query($sql);

        if ($res) {
            while ($row = mysql_fetch_assoc($res)) {
                $row_array = array();
                foreach ($row as $key => $val)
                    $row_array[$key] = stripslashes($val);
                Database::$res_list[] = $row_array;
            }
            return true;
        }

    }

    static function GetColRows()
    {
        if (empty(self::$res_list))
            return 0;
        else
            return count(self::$res_list);
    }

}