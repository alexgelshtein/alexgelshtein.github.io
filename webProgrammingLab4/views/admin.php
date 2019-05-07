<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>

<body>
    <h1>Article editor</h1>
    <a href="index.php">Main</a>
    <br><br>
    <div>
        <form method="post" action="admin.php?action=add">
            <input type="text" name="title" value="" placeholder="Header"><br>
            <textarea name="content" cols="30" rows="5"></textarea><br>
            <input type="submit" value="Add"><br>
        </form>
    </div>
    <br>
    <div>
        <table border="1">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>date</th>
                <th></th>
            </tr>
            <?php foreach($articles as $a): ?>
            <tr>
                <td><?=$a['id']?></td>
                <td><?=$a['title']?></td>
                <td><?=$a['created']?></td>
                <td><a href="admin.php?action=delete&id=<?=$a['id']?>">Delete</a></td>
            </tr>
            <?php endforeach ?>
        </table>
        <br>
    </div>
</body>

</html>