<?php
trait Database{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "todoDB";
    private $conn;

    //connecting to the database
    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            echo "Error: " . $this->conn->error;
        }
        return $this->conn;
    }
}