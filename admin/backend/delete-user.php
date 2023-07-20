<?php
session_start();

$did = $_GET['id'];
include 'config.php';
$dsql = "DELETE FROM user WHERE user_id = '{$did}'";
if(mysqli_query($db,$dsql)){
    header("location:{$host}admin/users.php");
    $_SESSION['user_del']="<div class='alert alert-success' >Users Delete Success.</div>";

}else{
    echo "Con't Delete The User Record";
}

mysqli_close($db);


?>