<?php

class Model
{
    protected static $table = null;

    public $id;

    /**
     * @param $value
     * @return bool
     */
    public function insert($value)
    {
        $sql = "INSERT INTO `news` (title, text, imgsrc) VALUES (:title, :text, :imgsrc)";
        $db = new Db();
        $db->execute($sql, $value);

        return true;
    }


}