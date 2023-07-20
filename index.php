<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content">
                        <?php
                            $limit = 3;
                            if(isset($_GET['page'])){
                            $page = $_GET['page'];
                            }else{
                              $page = 1;
                            }
                             $offset = ($page -1)* $limit;
                            include './admin/backend/config.php';
                             $site_view_sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id
                              LEFT JOIN user ON post.author = user.user_id ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                             $site_qur = mysqli_query($db,$site_view_sql)or die('site view query error');
                             if(mysqli_num_rows($site_qur)>0){
                               while($site= mysqli_fetch_assoc($site_qur)){
                                
                            ?>
                            <div class="row" id="tb">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $site['post_id'];?>"><img src="./admin/upload/<?php echo $site['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $site['post_id'];?>'><?php echo $site['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $site['category_id'];?>'><?php echo $site['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?autid=<?php echo $site['author'];?>'><?php echo $site['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $site['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo $site['description'];?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $site['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                                }else{
                                    echo 'post not found';
                                }
                            ?>

                        </div> 
                         <!-- pagination start -->
                        <?php
                          $pagsql = "SELECT * FROM post";
                            $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                            if(mysqli_num_rows($pagiqur)>0){
                                $total_reacord = mysqli_num_rows($pagiqur);
                                $total_page = ceil($total_reacord/$limit);
                                echo "<ul class='pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li><a href="index.php?page='.($page -1).'">Prev</a></li>';

                                }

                                for($p =1 ; $p <=$total_page ; $p++){
                                    if($p == $page){
                                    $active = "active";
                                    }else{
                                    $active = "";
                                    }
                                // <li class="active"><a>1</a></li>
                                echo "<li class='$active' ><a href=index.php?page={$p}>{$p}</a></li>";
                                }
                                
                                if($total_page > $page){
                                echo '<li><a href="index.php?page='.($page +1).'">Next</a></li>';

                                }
                                echo "</ul>";
                            }
                                    
                        ?>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

