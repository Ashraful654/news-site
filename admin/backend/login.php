<?php
session_start();
if(isset($_POST['login'])){
    include 'config.php';
     if(empty($_POST['username'])||empty($_POST['password'])){
        echo '<div class="alert alert-danger" > Plz Submit Username and Password.</div>';
        
        $_SESSION['notsubmit']= "<div class='alert alert-danger' >Plz Submit Username and Password..</div>";
        header("location:{$host}/admin/index.php");
        die();
     }else{
    $user_name = mysqli_real_escape_string($db,$_POST['username']);
    $user_pass = mysqli_real_escape_string($db ,sha1($_POST['password']));
    $logsql = "SELECT user_id ,username , role FROM user WHERE username = '{$user_name}' AND password = '{$user_pass}'";
    $logqur = mysqli_query($db , $logsql)or die('mysqli_query error');
    if(mysqli_num_rows($logqur)>0){
        while($log = mysqli_fetch_assoc($logqur)){
            session_start();
         $_SESSION['userid']= $log['user_id'];
         $_SESSION['username']=$log['username'];
         $_SESSION['userrool']=$log['role'];
         header("location:{$host}/admin/users.php");


        }


    }else{
        // echo '<div class="alert alert-danger" >Username and Password are not matched.</div>';
        header("location:{$host}/admin/index.php");
        $_SESSION['notmetch']= "<div class='alert alert-danger' >Username and Password are not matched.</div>";

    }
 }



}







?>