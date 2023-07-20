<?php include "header.php";
    if($_SESSION['userrool']==0){
      header("location:{$host}admin/post.php");

    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                $catid = $_GET['catid'];
                include 'backend/config.php';
                $upcatsql = "SELECT * FROM category WHERE category_id ='{$catid}'";
                $upcat_qur = mysqli_query($db,$upcatsql)or die('Query Error');
                if(mysqli_num_rows($upcat_qur)>0){
                    while($upview = mysqli_fetch_assoc($upcat_qur)){
                
                ?>

                  <form action="backend/category_update.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $upview['category_id'];?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $upview['category_name'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                  }
                  }else{
                    echo 'data not found';
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
