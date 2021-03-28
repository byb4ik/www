<?php

class Model
{
    protected static $table = null;

    public $id;

    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new Db();

        return $db->query($sql, static::class);
    }

    public static function findById($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $db = new Db();
        $param = [':id' => $id];
        $result = $db->query($sql, static::class, $param);
        if (!empty($result)) {
            return $result[0];
        }

        return false;
    }

    public function insert($value)
    {
        $sql = "INSERT INTO `news` (title, text, imgsrc) VALUES (:title, :text, :imgsrc)";
        $db = new Db();

        $db->execute($sql, $value);
        return true;
    }


}