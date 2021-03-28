<?php

class Db
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('mysql:host=localhost;dbname=parser', 'user', 'user');
    }

    public function query($sql, $class = \stdClass::class, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);

        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':title', $data['title']);
        $sth->bindParam(':text', $data['text']);
        $sth->bindParam(':imgsrc', $data['imgsrc']);

        return $sth->execute();
    }

}