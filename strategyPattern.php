<?php

interface ViewStrategy{
    public function getData();
}

class AscendByCreated implements ViewStrategy{

    use ConnectDatabase;
    // ascending order based on created_at
    public function getData(){
        $sql = "SELECT * FROM todos order by created_at asc";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

}

class AscendtByUpdated implements ViewStrategy{

    use ConnectDatabase;

    //ascending order based on updated_at
    public function getData(){
        $sql = "SELECT * FROM todos order by updated_at asc";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

class Sort{
    private $sortStrategy;

    public function __construct(ViewStrategy $sortStrategy){
        $this->sortStrategy = $sortStrategy;
    }

    public function getData(){
        return $this->sortStrategy->getData();
    }
}

?>