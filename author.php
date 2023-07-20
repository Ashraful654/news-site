<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    if(isset($_GET['autid'])){
                     $author = $_GET['autid'];
                    }
                    // pagination_query
                    $pagsql = "SELECT * FROM post JOIN user ON post.author=user.user_id WHERE author ={$author}";
                    $pagiqur = mysqli_query($db,$pagsql)or die('Author Query Error');
                    $auth = mysqli_fetch_assoc($pagiqur);
                    
                     // pagination_query end

                    ?>
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $auth['username'];?></h2>
                    <div class="post-content">
                        <?php
                        $limit = 1;
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        }else{
                          $page = 1;
                        }
                        $offset = ($page -1)* $limit; 

                        $auth_sq = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id  WHERE author = {$author} LIMIT {$offset},{$limit} ";
                        $authq = mysqli_query($db,$auth_sq)or die('Author Query Error');
                        if(mysqli_num_rows($authq)){
                            while($aut = mysqli_fetch_assoc($authq)){
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php"><img src="./admin//upload/<?php echo $aut['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $aut['post_id'];?>'><?php echo $aut['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $aut['category_id'];?>'><?php echo $aut['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?autid=<?php echo $aut['author'];?>'><?php echo $aut['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $aut['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $aut['description'];?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $aut['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }else{
                            echo 'data not found';
                        }
                        ?>
                    </div>
                    <?php
                            // $pagsql = "SELECT * FROM category WHERE category_id ={$cid}";
                            // $pagiqur = mysqli_query($db,$pagsql)or die('Query Error');
                            // $res = mysqli_fetch_assoc($pagiqur);    
                            if(mysqli_num_rows($pagiqur)>0){ 
                                $total_reacord = mysqli_num_rows($pagiqur);
                                $total_page = ceil($total_reacord/$limit);
                                echo "<ul class='pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li><a href="author.php?autid='.$author.'&page='.($page -1).'">Prev</a></li>';

                                }

                                for($p =1 ; $p <=$total_page ; $p++){
                                    if($p == $page){
                                    $active = "active";
                                    }else{
                                    $active = "";
                                    }
                                // <li class="active"><a>1</a></li>
                                echo "<li class='$active' ><a href=author.php?autid={$author}&page={$p}>{$p}</a></li>";
                                }
                                
                                if($total_page > $page){
                                echo '<li><a href="author.php?autid='.$author.'&page='.($page +1).'">Next</a></li>';

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
