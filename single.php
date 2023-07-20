<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                  <?php 
                  $id=$_GET['id'];
                  include './admin/backend/config.php';
                  $vsql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id
                  LEFT JOIN user ON post.author = user.user_id WHERE post_id = {$id}";
                  $vqur = mysqli_query($db,$vsql)or die('Singel viwe query error');
                  if(mysqli_num_rows($vqur)>0){
                    while($sin_view = mysqli_fetch_assoc($vqur)){
                  ?>
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $sin_view['title'];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?php echo $sin_view['category_id'];?>"><?php echo $sin_view['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?autid=<?php echo $sin_view['author'];?>'><?php echo $sin_view['username'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $sin_view['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="./admin//upload/<?php echo $sin_view['post_img'];?>" alt=""/>
                            <p class="description">
                            <?php echo $sin_view['description'];?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                    <?php
                    }
                    }else{
                        echo 'singel resault not found';
                    }
                    ?>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
