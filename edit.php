<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Page</title>
</head>

<body>
<h1>
    Edit Todo Page
</h1>
<?php
//connect to the database
    require_once 'controller.php';
    $model = new Model();

    $id = $_POST['id'];
    $value = $model->getDataById($id);
?>

<form method="post" action = "controller.php" onsubmit="return confirm('上書きしますか？');">
    <div style="margin: 10px">
        <label for="title">タイトル：</label>
        <input id="title" type="text" name="title" value="<?php echo $value['title']?>">
    </div>
    <div style="margin: 10px">
        <label for="content">内容：</label>
        <textarea id="content" name="content" rows="8" cols="40"><?php echo $value['content']?></textarea>
    </div>
    <input name="id" type="hidden" value="<?php echo $id ?>">
    <input name="request" type="hidden" value="edit">
    <input type="submit" name="post" value="編集する">
</form>
<form action="index.php">
    <button type="submit" name="back">戻る</button>
</form>
</body>
</html>