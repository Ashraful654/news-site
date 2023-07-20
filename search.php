<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    if(isset($_GET['search'])){
                     $serch = mysqli_real_escape_string($db,$_GET['search']);
                    }
                ?> 
                <div class="post-container">
                  <h2 class="page-heading">Search : <?php echo $serch ;?></h2>
                    <div class="post-content">
                        <?php
                        $limit = 1;
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        }else{
                          $page = 1;
                        }
                        $offset = ($page -1)* $limit; 
                        $serch_sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id  WHERE title LIKE '%{$serch}%' OR description LIKE '%{$serch}%' ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                        $serchqur = mysqli_query($db,$serch_sql)or die('serching query error');
                        if(mysqli_num_rows($serchqur)>0){
                            while($ser= mysqli_fetch_assoc($serchqur)){


                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $ser['post_id'];?>"><img src="./admin/upload/<?php echo $ser['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $ser['post_id'];?>'><?php echo $ser['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $ser['category_id'];?>'><?php echo $ser['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $ser['author'];?>'><?php echo $ser['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $ser['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $ser['description'];?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php'>read more</a>
                                </div>
                            </div>
                        </div>
                        <?php
                         }
                        }else{
                            echo 'Record not found';
                        }
                        ?>
                    </div>
                    <?php
                            // $pagsql = "SELECT * FROM category WHERE category_id ={$cid}";
                            // $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                            // $res = mysqli_fetch_assoc($pagiqur);
                            // pagination_query
                            $pagsql = "SELECT * FROM post  WHERE title LIKE '%{$serch}%'";
                            $pagiqur = mysqli_query($db,$pagsql)or die('Author Query Error');
                            // pagination_query end
                            if(mysqli_num_rows($pagiqur)>0){ 
                                $total_reacord = mysqli_num_rows($pagiqur);
                                $total_page = ceil($total_reacord/$limit);
                                echo "<ul class='pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li><a href="author.php?search='.$serch.'&page='.($page -1).'">Prev</a></li>';

                                }

                                for($p =1 ; $p <=$total_page ; $p++){
                                    if($p == $page){
                                    $active = "active";
                                    }else{
                                    $active = "";
                                    }
                                // <li class="active"><a>1</a></li>
                                echo "<li class='$active' ><a href=author.php?search={$serch}&page={$p}>{$p}</a></li>";
                                }
                                
                                if($total_page > $page){
                                echo '<li><a href="author.php?search='.$serch.'&page='.($page +1).'">Next</a></li>';

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
