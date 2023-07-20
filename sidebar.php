<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text"  name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" id="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
    <?php
    $limit = 3;
    include './admin/backend/config.php';
    $recent_sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id ORDER BY post_id DESC LIMIT {$limit}";
    $recent_qur = mysqli_query($db,$recent_sql)or die('Recent Query Error');
    if(mysqli_num_rows($recent_qur)>0){
        while($recent = mysqli_fetch_assoc($recent_qur)){
    ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $recent['post_id'];?>">
                <img src="./admin/upload/<?php echo $recent['post_img'];?>" alt="#"/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $recent['post_id'];?>"><?php echo $recent['title'];?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $recent['category_id'];?>'><?php echo $recent['category_name'];?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $recent['post_date'];?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $recent['post_id'];?>">read more</a>
            </div>
        </div>
    <?php
     }
    }else{
        echo 'Recent post data not found';
    }
    ?>
    </div>
    <!-- /recent posts box -->
</div>
