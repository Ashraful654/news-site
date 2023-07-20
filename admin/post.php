<?php include "header.php";

include 'backend/config.php';
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                <?php
                $limit = 3;
                if(isset($_GET['page'])){
                  $page = $_GET['page'];
                }else{
                  $page = 1;
                }
                $offset = ($page -1)* $limit;
                if($_SESSION['userrool']==1){
                $post_sql = "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id
                 LEFT JOIN user ON post.author=user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                 }elseif($_SESSION['userrool']==0){
                 $post_sql = "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id
                 LEFT JOIN user ON post.author=user.user_id  WHERE post.author = {$_SESSION['userid']} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                 }
                $post_qur = mysqli_query($db,$post_sql)or die('Query error');
                if(mysqli_num_rows($post_qur)>0){
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        
                        <?php
                        $serial = $offset + 1;
                        while($post_view = mysqli_fetch_assoc($post_qur)){
                        
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $post_view['title']; ?></td>
                              <td><?php echo $post_view['category_name']; ?></td>
                              <td><?php echo $post_view['post_date']; ?></td>
                              <td><?php echo $post_view['username']; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $post_view['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='backend/delete-post.php?id=<?php echo $post_view['post_id']; ?>&catid=<?php echo $post_view['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                          $serial++;
                          }
                          ?>
                      </tbody>
                  </table>
                  <?php
                  }else{
                    echo 'post Not found';
                  }
                  //pagination start----------
                  $pagsql = "SELECT * FROM post";
                  $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                  if(mysqli_num_rows($pagiqur)>0){
                  $total_reacord = mysqli_num_rows($pagiqur);
                  $total_page = ceil($total_reacord/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1){
                    echo '<li><a href="post.php?page='.($page -1).'">Prev</a></li>';

                  }

                  for($p =1 ; $p <=$total_page ; $p++){
                    if($p == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                  // <li class="active"><a>1</a></li>
                  echo "<li class='$active' ><a href=post.php?page={$p}>{$p}</a></li>";
                }
                
                if($total_page > $page){
                  echo '<li><a href="post.php?page='.($page +1).'">Next</a></li>';

                }
                  echo "</ul>";
                }
                  //pagination end------------
                  ?>
                  <!-- <ul class='pagination admin-pagination'>
                      <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                      
                  </ul> -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>