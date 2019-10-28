<?php

abstract class AbstractEntity
{
    protected $db;

    protected $table;

    protected $pk;

    protected $id;

    protected $isActive;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function setDb(mysqli $db)
    {
        $this->db = $db;

        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    protected function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    protected function getTable()
    {
        return $this->table;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    // generic query usage
    public function getById($id)
    {
        $select = 'SELECT * FROM ' . $this->table;
        $condition = 'WHERE ' . $this->pk . ' = ' . $id;

        $query = $select . ' ' . $condition;

        $result = $this->db->query($query);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }

    abstract public function queryAllbyDesc();

    public function parseData()
    {
        $data = array();

        foreach($this->columns() as $column => $value) {
            array_push(
                $data, 
                '`' . $column . '` = "' . $this->db->escape_string($value) . '"'
            );
        }
        return implode(", ", $data);
    }

    public function insert()
    {
        $insert = 'INSERT INTO ' . $this->table;
        $set = 'SET ' . $this->parseData();
        $query = $insert . ' ' . $set;

        $result = $this->db->query($query);

        if ($result !== false) {
            return $this->db->affected_rows;
        } else {
            // echo $this->db->error;
            return;
        }
    }
    
    public function update($id)
    {        
        $update = 'UPDATE ' . $this->table;
        $set = 'SET ' . $this->parseData();
        $condition = 'WHERE ' . $this->pk . ' = ' .$id;
        $query = $update . ' ' . $set . ' ' . $condition;

        $result = $this->db->query($query);

        if ($result !== false) {
            return 1;
        } else {
            // echo $this->db->error;
            return;
        }
    }
    

    public function delete($id)
    {
        $delete = 'DELETE FROM '.$this->table;
        $condition = 'WHERE ' . $this->pk . '= ' . $id;
        $query = $delete . ' ' . $condition;

        $result = $this->db->query($query);

        if ($result !== false) {
            return $this->db->affected_rows;
        }else{
            return $this->db->error;
        }

    }

    public function getTotalCount(){
        $query = 'SELECT COUNT(*) FROM '.$this->table;
        $result = $this->db->query($query);

        if ($result !== false) {
            return $result->fetch_array()[0];
        } else{
            $this->db->error;
        }
    }

    abstract public function columnData();
    
    // prepared statement usage sample
    /*public function getById($id)
    {
        $select = 'SELECT * FROM ' . $this->table;
        $condition = 'WHERE ' . $this->pk . ' = ?';

        $query = $select . ' ' . $condition;

        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }*/
}
