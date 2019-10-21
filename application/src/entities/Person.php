<?php

class Person extends AbstractEntity
{
    private $fname;

    private $lname;

    public function __construct(mysqli $db)
    {
        parent::__construct($db);

        $this->table = 'person';
        $this->pk = $this->table . '_id';
    }

    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    public function getLname()
    {
        return $this->lname;
    }
}
