<?php
include 'config.php';
$catid = mysqli_real_escape_string($db,$_POST['cat_id']);
$upcatname = mysqli_real_escape_string($db,$_POST['cat_name']);
$upcatsql= "UPDATE category SET category_name = '{$upcatname}' WHERE category_id = '{$catid}'";
if(mysqli_query($db,$upcatsql)){
    header("location:{$host}admin/category.php");
}else{
    echo 'Update Query Error';
}
mysqli_close($db);



?>