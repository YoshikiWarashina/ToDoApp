<?php
require_once 'model.php';

$model = new Model();
$action = $_POST['request'] ?? $_GET['request']?? null;


if ($action === 'delete') {

    $id = $_POST['id'];
    $model->deleteData($id);
    header("Location: index.php");

}else if ($action === 'create') {

    $title = $_POST['title'];
    $content = $_POST['content'];

    //validation check
    try{
        // just returns bool (not sanitized yet)
        $model->strValidation($title, $content);
        $model->addData(xssPrevention($title), xssPrevention($content));
    
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
        $model->strValidation($title, $content);
        $model->editData($id, xssPrevention($title), xssPrevention($content));

        header("Location: index.php");
    }catch(Exception $e){
        echo "エラーが発生しました：" . $e->getMessage();
    }

}else if ($action === 'edit_id'){

    $id = $_POST['edit_id'];

    $value = $model->getDataById($id);
    
    header("Location: edit.php");
}


function xssPrevention($data){
    return htmlspecialchars($data, ENT_QUOTES, 'utf-8');
}


//call a function that make an order 

    
?>
