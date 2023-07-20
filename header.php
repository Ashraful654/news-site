<?php
include './admin/backend/config.php';
$tab = basename($_SERVER['PHP_SELF']);

switch($tab){
    case 'single.php':
        if(isset($_GET['id'])){
            $tabsq = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $tabqur = mysqli_query($db,$tabsq)or die('title query failed');
            $tabres = mysqli_fetch_assoc($tabqur);
            $tab_page = $tabres['title'];

        }else{
            $tab_page = 'data not found';
        }
        break;
    case 'category.php':
        if(isset($_GET['cid'])){
            $tabsq = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
            $tabqur = mysqli_query($db,$tabsq)or die('title query failed');
            $tabres = mysqli_fetch_assoc($tabqur);
            $tab_page = $tabres['category_name']." NEWS";

        }else{
            $tab_page = 'data not found';
        }
        break;
    case 'author.php':
        if(isset($_GET['autid'])){
            $tabsq = "SELECT * FROM user WHERE user_id = {$_GET['autid']}";
            $tabqur = mysqli_query($db,$tabsq)or die('title query failed');
            $tabres = mysqli_fetch_assoc($tabqur);
            $tab_page ="News by ". $tabres['first_name']." ".$tabres['last_name'];

        }else{
            $tab_page = 'data not found';
        }
        break;
    case 'search.php':
        if(isset($_GET['search'])){
            $tab_page = $_GET['search'];

        }else{
            $tab_page = 'data not found';
        }
        break;
    default:
    $tab_page = 'News';
       break;
     
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $tab_page;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <?php
                $setsql = "SELECT * FROM settings";
                $setqur = mysqli_query($db,$setsql)or die('Settings Data View Error');
                if(mysqli_num_rows($setqur)){
                    while($set_view = mysqli_fetch_assoc($setqur)){
                        if($set_view['logo'] == ""){
                            echo '<a href="index.php"> <h1>'.$set_view['web_name'].'</h1></a>' ;

                        }else{
                            echo '<a href="index.php" id="logo"><img src="./admin/images/'.$set_view['logo'].'"></a>';
                           
                        }  
                    }
                }
                ?>
                
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
            <div class="col-md-12">
            <div class="row">
            <?php 
            if(isset($_GET['cid'])){
            $c_id = $_GET['cid'];
            }
            $cat_sql = "SELECT * FROM category where post > 0 ";
            $cat_qur = mysqli_query($db,$cat_sql)or die('category query error');
            $active = '';
            if(mysqli_num_rows($cat_qur)>0){
            ?>
                <ul class='menu'>
                <li><a  href='<?php echo $host?>'>HOME</a></li>
                    <?php 
                    while($cat = mysqli_fetch_assoc($cat_qur)){
                        if(isset($_GET['cid'])){
                          if($cat['category_id']==$c_id){
                            $active = 'active';
                          }else{
                            $active = '';
                          }
                        }
                        echo " <li><a class='{$active}' href='category.php?cid={$cat['category_id']}'>{$cat['category_name']}</a></li>";
                    }
                    ?>
                   
                    <!-- <li><a href='category.php'>Entertainment</a></li>
                    <li><a href='category.php'>Sports</a></li>
                    <li><a href='category.php'>Politics</a></li> -->

                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
