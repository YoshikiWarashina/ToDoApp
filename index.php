<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Index Page</title>
</head>
<body>
    <div class = "container">
        <div class = "mt-5">
        <h1>
            ToDo List Page
        </h1>

        <form method = "post" action="create.php">
            <button class="btn btn-primary" type="submit" style="padding: 10px;font-size: 16px;margin-bottom: 10px">New Todo</button>
        </form>

        <form style = "margin-bottom: 10px" method="post" action="index.php">
            <select name="request">
                <option value="ascCreate">作成日時昇順</option>
                <option value="ascUpdate">更新日時昇順</option>
            </select>
            <button type="submit">決定</button>
        </form>
        <?php
        //connect to database
        require_once 'controller.php';
        $model = new Model();

        //最悪このプログラムで提出
        if(isset($_POST['request']) && $_POST['request'] === 'ascCreate'){
            $rows = $model->ascByCreatedAt();
        } else if(isset($_POST['request']) && $_POST['request'] === 'ascUpdate'){
            $rows = $model->ascByUpdatedAt();
        } else {
            $rows = $model->getData();
        }
        ?>

        <table border="1" class = "table-hover">
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
            foreach ($rows as $value) {
        ?>
            <tr>
                <td><?php echo $value['id'];?></td>
                <td><?php echo $value['title']?></td>
                <td><?php echo $value['content']?></td>
                <td><?php echo $value['created_at']?></td>
                <td><?php echo $value['updated_at']?></td>
                <td>
                    <form method="post" action="edit.php">
                        <button class = "btn btn-outline-primary" type="submit" style="padding: 10px;font-size: 16px;">編集する</button>
                        <input name="id" type="hidden" value="<?php print $value['id'];?>">
                    </form>
                </td>
                <!--Delete Data-->
                <td>
                    <form method="post" action = "controller.php" onsubmit="return confirm('本当に削除しますか？');">
                        <button class = "btn btn-outline-warning" type="submit" style="padding: 10px;font-size: 16px;">削除する</button>
                        <input name="id" type="hidden" value="<?php print $value['id'];?>">
                        <input name="request" type="hidden" value="delete">
                    </form>
                </td>
            </tr>
        <?php
            }
        ?>
        </table>
        </div>
    </div>
</body>
</html>