<?php
trait Database{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "todoDB";
    private $connection;

    //connecting to the database
    public function getConnection() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->connection->connect_error) {
            echo "Error: " . $this->connection->error;
        }
        return $this->connection;
    }
}