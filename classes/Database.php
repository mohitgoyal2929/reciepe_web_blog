<?php
/*
 * Database Class
 */

class Database {
    private $db = null;
    private $host = '';
    private $dbname = '';
    private $user = '';
    private $pass = '';

    public function __construct() {
        global $config;
        $this->host = $config['db']['hostname'];
        $this->dbname = $config['db']['dbname'];
        $this->user = $config['db']['user'];
        $this->pass = $config['db']['pass'];
        $this->connect();
    }

    public function getConnection() {
      return $this->db;
    }

    public function connect() {
        $connect_query = sprintf('mysql:host=%s;dbname=%s', $this->host, $this->dbname);
        try{
            $conn = new PDO($connect_query, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->db = $conn;
        } catch(PDOException $e){
            die('Database failed : ' . $e->getMessage());
        }
    }

    public function insert($query, $values = array()) 
    {
        $stmt = $this->db->prepare($query);
        
        if(!empty($values)) 
        {
            $status = $stmt->execute($values);
        } 
        else 
        {
            $status = $stmt->execute();
        }
        
        return $status;
    }

    public function update($query, $values) {
        $stmt= $this->db->prepare($query);
        $stmt->execute($values);
    }

    public function delete($table, $id) {
        $stmt = ($this->getConnection())->prepare('DELETE FROM '. $table .' WHERE id = ?');
        $stmt->execute([$id]);
        // $deleted = $stmt->rowCount();
    }
}
