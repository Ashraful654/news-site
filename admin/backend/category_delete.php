<?php
$upcat_id = $_GET['catid'];
include 'config.php';
$delcat_sql = "DELETE FROM category WHERE category_id = '{$upcat_id}'";
if(mysqli_query($db,$delcat_sql)){
    header("location:{$host}admin/category.php");
}else{
    echo "Con't Delete The User Record";
}

mysqli_close($db);




?>