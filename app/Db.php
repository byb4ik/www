<?php

class Db
{
    /**
     * @var PDO
     */
    protected $dbh;

    /**
     * Db constructor.
     */
    public function __construct()
    {
        $this->dbh = new \PDO('mysql:host=localhost;dbname=parser', 'user', 'user');
    }

    /**
     * @param $sql
     * @param array $data
     * @return bool
     */
    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':title', $data['title']);
        $sth->bindParam(':text', $data['text']);
        $sth->bindParam(':imgsrc', $data['imgsrc']);

        return $sth->execute();
    }

}