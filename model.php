<?php
require_once 'connectDB.php';
class Model{
    private $conn;
    use Database;

    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function addData($title, $content){
        $sql = "INSERT INTO todos VALUES (default,?,?,default, default)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
    }

    //delete data from database
    public function deleteData($id){
        $sql = "DELETE FROM todos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    //get all the data from database
    public function getData() {
        $sql = "SELECT * FROM todos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    //get data based on id from database
    public function getDataById($id){
        $sql = "SELECT * FROM todos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
    
    //edit the selected data
    public function editData($id, $title, $content){
        $sql = "UPDATE todos SET title = ?, content = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $content, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    // create a method for xss prevention
}

    
?>