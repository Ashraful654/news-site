<?php
if(isset($_POST['save'])){
    include 'config.php';
    $category = mysqli_real_escape_string($db,$_POST['cat']);
    $catsql = "INSERT INTO category(category_name)VALUES('{$category}')";
    if(mysqli_query($db,$catsql)){
        header("location:{$host}admin/category.php");

    }else{
        echo 'category add Query Error';
    }


}





?>