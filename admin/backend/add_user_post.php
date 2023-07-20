<?php
if(isset($_POST['save'])){
    include "config.php";
    $fname = mysqli_real_escape_string($db,$_POST['fname']);
    $lname = mysqli_real_escape_string($db,$_POST['lname']);
    $user = mysqli_real_escape_string($db,$_POST['user']);
    $password = mysqli_real_escape_string($db,sha1($_POST['password']));
    $roll = mysqli_real_escape_string($db,$_POST['role']);
    
    $usereql="SELECT username FROM user WHERE username = '{$user}'";
    $eqlqur = mysqli_query($db,$usereql)or die('Query Error');


    if(mysqli_num_rows($eqlqur)>0){
        echo "<p style='color:red;text-aline:center;margin: 10px 0;' >User Name Already Exists</p>";
    }else{
        $adduser = "INSERT INTO user (first_name , last_name , username , password , role) VALUES('{$fname}','{$lname}','{$user}','{$password}','{$roll}')";
        if(mysqli_query($db ,$adduser)){
            header("location:{$host}admin/users.php");
        }else{
            echo("Con't Add The User Record");
        }

        
    }
    mysqli_close($db);
}

  


?>