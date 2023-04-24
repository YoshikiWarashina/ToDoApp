<?php
//classを使って書き換え

require_once 'model.php';

class Controller extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function handleRequest(){
        $action = $_POST['request']?? null;

        if ($action === 'delete') {

            $id = $_POST['id'];
            $this->deleteData($id);
            header("Location: index.php");
        
        }else if ($action === 'create') {
        
            $title = $_POST['title'];
            $content = $_POST['content'];
        
            //validation check
            try{
                // just returns bool (not sanitized yet)
                $this->strValidation($title, $content);
                $this->addData(xssPrevention($title), xssPrevention($content));
            
                header("Location: index.php");
            }catch(Exception $e){
                echo "エラーが発生しました：" . $e->getMessage();
            }
        
        }else if ($action === 'edit'){
        
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
        
            //validation check
            try{
                //just returns bool (not sanitized yet)
                $this->strValidation($title, $content);
                $this->editData($id, xssPrevention($title), xssPrevention($content));
        
                header("Location: index.php");
            }catch(Exception $e){
                echo "エラーが発生しました：" . $e->getMessage();
            }
        
        }


        //call a function that make an order
        if($action === 'ascCreate'){
            $ascCreate = new Sort(new AscendByCreated());
            $ascCreate->getData();
            header('Location: index.php');
        }

        if($action === 'ascUpdate'){
            $ascUpdate = new Sort(new AscendtByUpdated());
            $ascUpdate->getData();
            header('Location: index.php');
        }

        function xssPrevention($data){
            return htmlspecialchars($data, ENT_QUOTES, 'utf-8');
        }

    }
}

    
?>