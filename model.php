<?php
require_once 'connectDB.php';
class Model{
    private $conn;
    use Database;

    public function __construct(){
        $this->conn = $this->getConnection();
    }

    //delete data from database
    public function deleteData($todoId){
        $sql = "DELETE FROM toDoTable WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $todoId);
        $stmt->execute();
    }

    //display all the data from database
    public function getData() {
        $sql = "SELECT * FROM toDoTable";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
}

    
?>