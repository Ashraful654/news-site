<?php include "header.php";
include 'backend/config.php';
$id=$_GET['id'];
if($_SESSION['userrool']==0){
    $normal_usql= "SELECT author FROM post WHERE post_id={$id}";
    $nor_sequr = mysqli_query($db,$normal_usql)or die('noemal user query error');
    $nor_user = mysqli_fetch_assoc($nor_sequr);
    if($_SESSION['userid']!=$nor_user['author']){
        header("location:{$host}admin/post.php");
    }

}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php
            $eds= "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id 
            LEFT JOIN user ON post.author=user.user_id WHERE post_id={$id}";
 

        //     elseif($_SESSION['userrool']==0){
        //     $eds= "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id 
        //     LEFT JOIN user ON post.author=user.user_id WHERE post_id={$id} AND post.author = {$_SESSION['userid']}";
        //     }

        $eidqur = mysqli_query($db,$eds)or die('query Error');
        if(mysqli_num_rows($eidqur)>0){
            while($v_edit = mysqli_fetch_assoc($eidqur)){

            
        
        ?>
        <form action="backend/update_post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $v_edit['post_id'];?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $v_edit['title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $v_edit['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <?php
                $edit_vsql = "SELECT * FROM category";
                $myqur = mysqli_query($db,$edit_vsql)or die('query error');
                if(mysqli_num_rows($myqur)>0){
                    echo '<select class="form-control" name="category">';
                    while($cat_eid=mysqli_fetch_assoc($myqur)){
                        if($cat_eid['category_id']==$v_edit['category']){
                            $select = "selected";
                        }else{
                            $select = "";
                        }
                        echo "<option {$select} value='{$cat_eid['category_id']}'>{$cat_eid['category_name']}</option>";
                    }
                }

                ?>
                   <input type="hidden" name="old_category" value="<?php echo $v_edit['category_id'];?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="./upload/<?php echo $v_edit['post_img'];?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $v_edit['post_img'];?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        
        </form>
        <?php
        }
    }
        else{
            echo 'data not found';
        }
    
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
