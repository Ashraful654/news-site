<?php
if(isset($_POST['submit']) && isset($_FILES['fileToUpload'])){
    $errors= array();
    $file_name = $_FILES['fileToUpload'] ['name'];
    $file_size = $_FILES['fileToUpload'] ['size'];
    $tmp_name = $_FILES['fileToUpload'] ['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $ext = strtolower(end(explode('.',$file_name)));
    $extension =array('jpeg','png','jpg','webp');
    if(in_array($ext ,$extension)=== false){
        $errors[]='this extension file not allowed,plz choose a JPG or PNG File. ';
    }
    if($file_size >6291456){
        $errors[]='file size must be 5mb or lower';
    }
    $new_name = time()."-".basename($file_name);
    $file_move = "../upload/".$new_name;
    $img_file = $new_name; 
    if(empty($errors)==true){
        move_uploaded_file($tmp_name,$file_move);
    }else{
        print_r($errors);
        die();
    }
session_start();
include 'config.php';
$posr_titel = mysqli_real_escape_string($db,$_POST['post_title']);
$post_descrip = mysqli_real_escape_string($db,$_POST['postdesc']);
$post_category = mysqli_real_escape_string($db,$_POST['category']);
$posr_date = date("d M,Y");
$author =$_SESSION['userid'];

$post_sql = "INSERT INTO post( title, description, category, post_date, author ,post_img ) 
VALUES('{$posr_titel}','{$post_descrip}','{$post_category}','{$posr_date}','{$author}','{$img_file }');";
$post_sql .="UPDATE category SET post = post+1 WHERE category_id='{$post_category}'";
if(mysqli_multi_query($db,$post_sql)){
    header("location:{$host}admin/post.php");
}else{
    echo "Query Failed";
}


}





?>