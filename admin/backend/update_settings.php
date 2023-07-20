<?php
include 'config.php';
if(empty($_FILES['logo'] ['name'])){
    $logo_name = $_POST['old_logo'];
}else{
    $errors = array();
    $logo_name = $_FILES['logo'] ['name'];
    $logo_size = $_FILES['logo'] ['size'];
    $logo_tmpname = $_FILES['logo'] ['tmp_name'];
    $logo_type = $_FILES['logo'] ['type'];
    $ext = strtolower(end(explode('.',$logo_name)));
    $extension =array('jpeg','png','jpg','webp');
    if(in_array($ext ,$extension)=== false){
        $errors[]='this extension file not allowed,plz choose a JPG or PNG File. ';
    }
    if($logo_size >6291456){
        $errors[]='file size must be 5mb or lower';
    }
    if(empty($errors)==true){
        move_uploaded_file($logo_tmpname,"../images/".$logo_name);
    }else{
        print_r($errors);
        die();
    }

}
$uplode = "UPDATE settings SET web_name = '{$_POST['website_name']}', logo = '{$logo_name}', footer_des = '{$_POST['footer_desc']}'";
$upq = mysqli_query($db,$uplode);
if($upq){
    header("location:{$host}/admin/settings.php");
}else{
    echo 'Data not found';
}







?>