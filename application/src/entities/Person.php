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

    public function insert()
    {
        $insert = 'INSERT INTO ' . $this->table . ' (name_first, name_last)';
        $values = 'VALUES ("' . $this->db->real_escape_string($this->fname) . '","' . $this->db->real_escape_string($this->lname) . '")';
        $query = $insert . ' ' . $values;

        $result = $this->db->query($query);

        if ($result !== false) {
            return $this->db->affected_rows;
        } else {
            return $this->db->error;
        }
    }

    public function update($id)
    {
        $update = 'UPDATE ' . $this->table;
        $set = 'SET name_first = "' .$this->fname . '"';
        $set2 = 'name_last = "' . $this->lname . '"';
        $condition = 'WHERE ' . $this->pk . ' = ' .$id;
        $query = $update . ' ' . $set . ', ' . $set2 . ' ' . $condition;

        $result = $this->db->query($query);

        if ($result !== false) {
            return 1;
        } else {
            return $this->db->error;
        }
    }

    public function queryAllbyDesc()
    {
        $select = 'SELECT * FROM ' . $this->table;
        $condition = 'ORDER BY ' . $this->pk . ' DESC';
        $query = $select . ' ' . $condition;

        $result = $this->db->query($query);

        if ($result !== false) {
            return $result->fetch_all(MYSQLI_ASSOC);

        } else {
            return $this->db->error;
        }
    }

    public function getData($offset, $no_of_records_per_page)
    {
        $select = 'SELECT * FROM ' . $this->table;
        $limit = 'LIMIT ' . $offset . ', ' . $no_of_records_per_page;
        $condition = 'ORDER BY ' . $this->pk . ' DESC';
        $query = $select . ' ' . $condition . ' ' . $limit;

        $result = $this->db->query($query);

        if ($result !== false) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $this->db->error;
        }
    }

}
