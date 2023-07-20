<?php
include 'config.php';
if(empty($_FILES['new-image']['name'])){
$img_file = $_POST['old-image'];
}else{
    $errors= array();
    $file_name = $_FILES['new-image'] ['name'];
    $file_size = $_FILES['new-image'] ['size'];
    $tmp_name = $_FILES['new-image'] ['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $ext = strtolower(end(explode('.',$file_name)));
    $extension =array('jpeg','png','jpg','webp');
    if(in_array($ext ,$extension)=== false){
        $errors[]='this extension file not allowed,plz choose a JPG or PNG File. ';
    }
    if($file_size >6291456){
        $errors[]='file size must be 5mb or lower';
    }
    //=======================
    $new_name = time()."-".basename($file_name);
    $file_move = "../upload/".$new_name;
    $img_file = $new_name; 

    //======================
    if(empty($errors)==true){
        unlink("../upload/".$_POST['old-image']);//image unlink
        move_uploaded_file($tmp_name,$file_move);
    }else{
        print_r($errors);
        die();
    }
}
$upsql = "UPDATE post SET title ='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',
category={$_POST['category']},post_img='{$img_file}' WHERE post_id = {$_POST["post_id"]};";
if($_POST['old_category']!=$_POST['category']){
    $upsql .= "UPDATE category SET post = post+1 WHERE category_id = {$_POST['category']};";
    $upsql .= "UPDATE category SET post = post-1 WHERE category_id = {$_POST['old_category']};";
   

}
$upqur = mysqli_multi_query($db,$upsql);
if($upqur){
    header("location:{$host}/admin/post.php");


}else{
    echo 'Update Query Error';

}


?>