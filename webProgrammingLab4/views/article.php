<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Article</title>
</head>

<body>
    <h1>Article page</h1>
    <div>
        <div class="article">
            <h2><?=$article['title']?></h2>
            <em>Publication date: <?=$article['created']?></em>
            <p><?=$article['content']?></p>
        </div>
    </div>
</body>

</html>