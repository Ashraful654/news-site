<?php include 'header.php';
include './admin/backend/config.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if(isset($_GET['cid'])){
                    $cid = $_GET['cid'];
                    }
                    // pagination_query
                    $pagsql = "SELECT * FROM category WHERE category_id ={$cid}";
                    $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                    $res = mysqli_fetch_assoc($pagiqur);
                     // pagination_query end

                    ?>
                    <h2 class="page-heading"><?php echo $res['category_name'];?></h2>
                    <div class="post-content">
                        <?php
                        $limit = 1;
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        }else{
                          $page = 1;
                        }
                        $offset = ($page -1)* $limit;
                        $sincat = "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id WHERE category = {$cid} ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                        $cqur = mysqli_query($db,$sincat)or die('category query error');
                        if(mysqli_num_rows($cqur)>0){
                            while($catg = mysqli_fetch_assoc($cqur)){
                        
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $catg['post_id'];?>"><img src="./admin/upload/<?php echo $catg['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $catg['post_id'];?>'><?php echo $catg['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $catg['category_id'];?>'><?php echo $catg['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?autid=<?php echo $catg['author'];?>'><?php echo $catg['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $catg['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $catg['description'];?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $catg['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        }else{
                            echo 'Post not found';
                        }
                        
                        ?>
                    </div>
                     <!-- pagination start  -->
                    <?php
                            // $pagsql = "SELECT * FROM category WHERE category_id ={$cid}";
                            // $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                            // $res = mysqli_fetch_assoc($pagiqur);    
                            if(mysqli_num_rows($pagiqur)>0){ 
                                $total_reacord = $res['post'];
                                $total_page = ceil($total_reacord/$limit);
                                echo "<ul class='pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li><a href="category.php?cid='.$cid.'&page='.($page -1).'">Prev</a></li>';

                                }

                                for($p =1 ; $p <=$total_page ; $p++){
                                    if($p == $page){
                                    $active = "active";
                                    }else{
                                    $active = "";
                                    }
                                // <li class="active"><a>1</a></li>
                                echo "<li class='$active' ><a href=category.php?cid={$cid}&page={$p}>{$p}</a></li>";
                                }
                                
                                if($total_page > $page){
                                echo '<li><a href="category.php?cid='.$cid.'&page='.($page +1).'">Next</a></li>';

                                }
                                echo "</ul>";
                            }
                                    
                        ?>
                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
