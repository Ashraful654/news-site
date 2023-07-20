<?php include "header.php";
    if($_SESSION['userrool']==0){
        header("location:{$host}admin/post.php");
  
      }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                $userid = $_GET['id'];
                include 'backend/config.php';
                $editshow = "SELECT * FROM user WHERE user_id ='{$userid}'";
                $eidsql= mysqli_query($db,$editshow)or die('Query Error');

                If(mysqli_num_rows($eidsql)>0){
                    while($edit = mysqli_fetch_assoc($eidsql)){


                ?>
                  <!-- Form Start -->
                  <form  action="backend/user_update.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $edit['user_id'];?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $edit['first_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $edit['last_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $edit['username'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php 
                          if($edit['role']==1){
                            echo "<option value='0'>normal User</option>
                            <option selected value='1'>Admin</option>";
                          }else{
                            echo "<option selected  value='0'>normal User</option>
                            <option  value='1'>Admin</option>";
                          }
                          
                          ?>

                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
                  <?php 
                      }
                  }
                  ?>
    
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
