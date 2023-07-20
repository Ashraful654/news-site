<?php
include 'config.php';
$id= $_GET['id'];
$cat_id= $_GET['catid'];
$imgd = "SELECT * FROM post WHERE post_id = {$id}";
$imgdq = mysqli_query($db, $imgd)or die('query Not Found:select');
$imgr = mysqli_fetch_assoc($imgdq);
unlink("../upload/".$imgr['post_img']);//image unlink
$deletesql = "DELETE FROM post WHERE post_id={$id};";
$deletesql.= "UPDATE category SET  post = post-1 WHERE category_id = {$cat_id}";
if(mysqli_multi_query($db,$deletesql)){
    header("location:{$host}/admin/post.php");
}else{
    echo 'Query error';
    
}



?>