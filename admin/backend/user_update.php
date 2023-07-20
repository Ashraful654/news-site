<?php
include 'config.php';
$upid = mysqli_real_escape_string($db,$_POST['user_id']);
$upfname = mysqli_real_escape_string($db,$_POST['f_name']);
$uplname = mysqli_real_escape_string($db,$_POST['l_name']);
$upusername = mysqli_real_escape_string($db,$_POST['username']);
$uprole = mysqli_real_escape_string($db,$_POST['role']);

$upsql = "UPDATE user SET first_name = '{$upfname}',last_name='{$uplname}',username='{$upusername}',role='{$uprole}'
WHERE user_id ='{$upid}'";
if(mysqli_query($db,$upsql)){
    header("location:{$host}admin/users.php");
    
}else{
    echo("Con't Update The User Record");
}

mysqli_close($db);
?>