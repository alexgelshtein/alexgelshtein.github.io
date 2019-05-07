<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Articles</title>
</head>

<body>
    <h1>All articles</h1>
    <div>
        <?php foreach($articles as $a): ?>
        <div class="article">
            <h2><a href="article.php?id=<?=$a['id']?>"><?=$a['title']?></a></h2>
            <em>Published: <?=$a['created']?></em>
            <p><?=$a['content']?></p>
            <br>
        </div>
        <?php endforeach ?>
    </div>
</body>

</html>