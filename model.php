<?php
require_once 'connectDB.php';
class Model{
    use ConnectDatabase;
    private $viewStrategy;

    public function __construct(){
        $this->getConnection();
    }

    public function addData($title, $content){
        
        $sql = "INSERT INTO todos VALUES (default,?,?,default, default)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
    }

    //delete data from database
    public function deleteData($id){
        $sql = "DELETE FROM todos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    //get all the data from database
    public function getData() {
        $sql = "SELECT * FROM todos";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    //ascending order based on created_at
    public function ascByCreatedAt(){
        $sql = "SELECT * FROM todos ORDER BY created_at asc";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    //ascending order based on updated_at
    public function ascByUpdatedAt(){
        $sql = "SELECT * FROM todos ORDER BY updated_at asc";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
        
    }

    //get data based on id from database
    public function getDataById($id){
        $sql = "SELECT title, content FROM todos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row;
    }
    
    //edit the selected data
    public function editData($id, $title, $content){

        $sql = "UPDATE todos SET title = ?, content = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssi", $title, $content, $id);
        $stmt->execute();
        $row = $stmt->get_result();

        return $row;
    }

    public function strValidation($title, $content){
        $title = xssPrevention($title);
        $content = xssPrevention($content);

        if(empty($title) || empty($content)){
            throw new Exception("タイトルと内容は入力必須です");
        }else if(mb_strlen($title) > 30){
            throw new Exception("タイトル30文字以内で入力してください");
        }
    }
}
