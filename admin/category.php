<?php include "header.php";
    if($_SESSION['userrool']==0){
        header("location:{$host}admin/post.php");
  
      }
 ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <?php
            include 'backend/config.php';
            $cat_limit = 3;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
              }else{
                $page = 1;
              }
              $offset = ($page -1)* $cat_limit;
            $catviewsql = "SELECT * FROM category ORDER BY category_id asc LIMIT {$offset},{$cat_limit} ";
            $catviewqur = mysqli_query($db,$catviewsql)or die('Category View Query Error');
            if(mysqli_num_rows($catviewqur)>0){  
            
            ?>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $serial = $offset +1;
                        while($cat_view = mysqli_fetch_assoc($catviewqur)){
                        
                        ?>
                        <tr>
                            <td class='id'><?php echo $serial;?></td>
                            <td><?php echo $cat_view['category_name'];?></td>
                            <td><?php echo $cat_view['post'];?></td>
                            <td class='edit'><a href='update-category.php?catid=<?php echo $cat_view['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='backend/category_delete.php?catid=<?php echo $cat_view['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php $serial++; }?>
                    </tbody>
                </table>
                <?php
                include 'backend/config.php';  
                $cat_pagi= "SELECT * FROM category";
                $catpag_qur = mysqli_query($db,$cat_pagi)or die('Pagination Error');
                if(mysqli_num_rows($catpag_qur)>0){
                    $total_cat= mysqli_num_rows($catpag_qur);
                    
                    $total_cat_page = ceil($total_cat/$cat_limit);
                    echo '<ul class="pagination admin-pagination">';
                    if($page > 1){
                        echo '<li><a href="category.php?page='.($page -1).'">Prev</a></li>';
    
                    }
                    for($a=1 ;$a <=$total_cat_page ;$a++){
                        if($a == $page){
                            $active = "active";
                          }else{
                            $active = "";
                         }
                          echo "<li class='$active' ><a href=category.php?page={$a}>{$a}</a></li>";

                    }
                    if($total_cat_page > $page){
                        echo '<li><a href="category.php?page='.($page+1).'">Next</a></li>';
    
                    }

                    echo'</ul>';
                }
                
                ?>
            </div>
            <?php }else{
                echo'category data not found';
            }
            
            
            ?>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
