<?php
function get_all_articles($con) {
    $query = "SELECT * FROM article ORDER BY id DESC";
    $result = mysqli_query($con, $query);
    
    
    if (!$result) {
        die(mysqli_error($con));
    }
    
    $n = mysqli_num_rows($result);
    $articles = array();
    
    
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $articles[] = $row;
    }
    
    return $articles;
}
function get_article($con, $article_id) {
    $query = sprintf("SELECT * FROM article WHERE id=%d", (int)$article_id);
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die(mysqli_error($con));
    }
    
    $article = mysqli_fetch_assoc($result);
    return $article;
}
function add_article($con, $title, $content) {
    $title = trim($title);
    $content = trim($content);
    
    if ($title == "")
        return false;
    
    $date = date("y-m-d H:i:s");
    $query = sprintf("INSERT INTO article (title, created, content) VALUES ('%s', '%s', '%s')", 
                    mysqli_real_escape_string($con, $title), $date, mysqli_real_escape_string($con, $content));
    
    $result = mysqli_query($con, $query);
    
    if (!$result)
        die(mysqli_error($con));
    
    return true;
}
function delete_article($con, $id) {
    $id = (int)$id;
    if ($id == 0)
        return false;
    
    $query = sprintf("DELETE FROM article WHERE id=%d", $id);
    $result = mysqli_query($con, $query);
    
    if (!$result)
        die(mysqli_error($con));
}
function article_preview($content) {
    return substr($content, 0, 200)."...";
}
?>