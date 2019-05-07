<?php
    require_once("database.php");
    require_once("models/article.php");
    
    $con = db_connect();
    $articles = get_all_articles($con);
    if(isset($_GET['action']))
        $action = $_GET['action'];
    else
        $action = "";
    if($action == "add") {
        if(!empty($_POST)) {
            add_article($con, $_POST['title'], $_POST['content']);
            header("Location: admin.php");
        }
    } else if ($action == "delete") {
        $id = $_GET['id'];
        delete_article($con, $id);
        header("Location: admin.php");
    }
    include("views/admin.php");
?>