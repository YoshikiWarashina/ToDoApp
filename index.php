<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page</title>
</head>
<body>
        <h1>
            ToDo List Page
        </h1>
<?php
    //connect to database
    require_once 'controller.php';
    $model = new Model();
?>

<form method = "post" action="create.php">
    <button type="submit" style="padding: 10px;font-size: 16px;margin-bottom: 10px">New Todo</button>
</form>
<form style = "margin-bottom: 10px" method="post" action="controller.php">
    <select name="category">
        <option value="">並び替えオプション</option>
        <option value="1">作成日時昇順</option>
        <option value="2">編集日時昇順</option>
    </select>
    <button type="submit">決定</button>
</form>
<table border="1">
    <colgroup span="4"></colgroup>
    <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>内容</th>
        <th>作成日時</th>
        <th>更新日時</th>
        <th>編集</th>
        <th>削除</th>
    </tr>

<?php
    foreach ($model->getData() as $value) {
?>
    <tr>
        <td><?php echo $value['id'];?></td>
        <td><?php echo $value['title']?></td>
        <td><?php echo $value['content']?></td>
        <td><?php echo $value['created_at']?></td>
        <td><?php echo $value['updated_at']?></td>
        <td>
            <form method="post" action="edit.php">
                <button type="submit" style="padding: 10px;font-size: 16px;">編集する</button>
                <input name="id" type="hidden" value="<?php print $value['id'];?>">
                <input name="request" type="hidden" value="edit_id">
            </form>
        </td>
        <!--Delete Data-->
        <td>
            <form method="post" action = "controller.php" onsubmit="return confirm('本当に削除しますか？');">
                <button type="submit" style="padding: 10px;font-size: 16px;">削除する</button>
                <input name="id" type="hidden" value="<?php print $value['id'];?>">
                <input name="request" type="hidden" value="delete">
            </form>
        </td>
    </tr>
<?php
    }
?>
</table>
</body>
</html>