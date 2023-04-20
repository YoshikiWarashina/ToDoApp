<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Page</title>
</head>
<body>
<h1>
    Post New ToDo Page
</h1>
<?php
//connect to the database
    require_once 'model.php';
    $model = new Model();
?>
<form method="post" action = "create.php" onsubmit="return confirm('追加しますか？');">
    <input type="hidden" name="request" value="create">
    <div style="margin: 10px">
        <label for="title">タイトル：</label>
        <input id="title" type="text" name="title">
    </div>
    <div style="margin: 10px">
        <label for="content">内容：</label>
        <textarea id="content" name="content" rows="8" cols="40"></textarea>
    </div>
    <input name="request" type="hidden" value="create">
    <input type="submit" name="post" value="投稿する">
</form>
<form action="index.php">
    <button type="submit" name="back">戻る</button>
</form>

<?php
// post request is sent and request is create -> add data to the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['request'] === 'create') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $model->addData($title, $content);
    
        header("Location: index.php");
        exit();
    }
?>
</body>
</html>