<?php
    require_once("database.php");
    require_once("models/article.php");
    
    echo '<a href="index.php">Return</a>';
    $con = db_connect();
    $article = get_article($con, $_GET['id']);
    include("views/article.php");
?>