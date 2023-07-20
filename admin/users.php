<?php include "header.php";

    if($_SESSION['userrool']==0){
      header("location:{$host}admin/post.php");

    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
          <?php 
                  if(isset($_SESSION['user_del'])){
                    echo $_SESSION['user_del'];
                    unset($_SESSION['user_del']);
                  }
                  ?>
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>

              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php
                include 'backend/config.php';
                $limit = 3;
                if(isset($_GET['page'])){
                  $page = $_GET['page'];
                }else{
                  $page = 1;
                }
                $offset = ($page -1)* $limit;


                $viewsql= "SELECT * FROM user ORDER BY user_id desc LIMIT {$offset},{$limit}";
                $viewqur= mysqli_query($db,$viewsql)or die('view query error');
                if(mysqli_num_rows($viewqur)>0){
                
                
                ?>
                
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        $serial = $offset +1;
                        while($view=mysqli_fetch_assoc($viewqur)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial;?></td>
                              <td><?php echo $view['first_name']." ". $view['last_name'];?></td>
                              <td><?php echo $view['username'];?></td>
                              <td><?php 
                              if($view['role']==1){
                               echo  'admin';
                              }else{
                                echo 'normal';
                              }
                              ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $view['user_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <!-- <td class='delete'><a ><i class='fa fa-trash-o '></i></a></td> -->
                              <td class='delete'><button data-id="<?php echo $view['user_id'];?>" class="btn btn-danger DeleteUser"><i class='fa fa-trash-o'></i>Delete</button></td>

                             

                          </tr>
                          <?php $serial ++;}?>
                      </tbody>
                  </table>
                  <?php 
                  }else{
                    echo 'NO Data Exist';
                  }
                  $pagsql = "SELECT * FROM user";
                  $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                  if(mysqli_num_rows($pagiqur)>0){
                  $total_reacord = mysqli_num_rows($pagiqur);
                  $total_page = ceil($total_reacord/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1){
                    echo '<li><a href="users.php?page='.($page -1).'">Prev</a></li>';

                  }

                  for($p =1 ; $p <=$total_page ; $p++){
                    if($p == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                  // <li class="active"><a>1</a></li>
                  echo "<li class='$active' ><a href=users.php?page={$p}>{$p}</a></li>";
                }
                
                if($total_page > $page){
                  echo '<li><a href="users.php?page='.($page +1).'">Next</a></li>';

                }

                  echo "</ul>";

                }


                  ?>

              </div>
          </div>
      </div>
  </div>
  <!-- ///////////////////////////////////////// -->
<?php include "footer.php"; ?>
