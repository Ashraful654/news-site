<?php include "header.php";
    if($_SESSION['userrool']==0){
        header("location:{$host}admin/post.php");
  
      }
?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">SETTINGS</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                $setsql = "SELECT * FROM settings";
                $setqur = mysqli_query($db,$setsql)or die('Settings Data View Error');
                if(mysqli_num_rows($setqur)){
                    while($set_view = mysqli_fetch_assoc($setqur)){
                
                ?>
                  <!-- Form -->
                  <form  action="./backend/update_settings.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Website name</label>
                          <input type="text" name="website_name" class="form-control" value="<?php echo $set_view['web_name'];?>" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $set_view['footer_des'];?></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Website logo</label>
                          <input type="file" name="logo">
                          <img src="./images/<?php echo $set_view['logo'];?>" alt="">
                          <input type="hidden" name="old_logo" value="<?php echo $set_view['logo'];?>">

                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                   }
                  }else{
                    echo 'settings data not found';
                  }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
