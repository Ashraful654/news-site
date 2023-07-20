<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                $setsql = "SELECT * FROM settings";
                $setqur = mysqli_query($db,$setsql)or die('Settings Data View Error');
                if(mysqli_num_rows($setqur)){
                    while($set_view = mysqli_fetch_assoc($setqur)){
                        echo '<span>' .'©Copyright '. date('Y').$set_view['footer_des'].'</span>';
 
                    }
                }
                ?>
                <!-- <span> 2022 News | Powered by <a href="#">Ashraful Islam</a></span> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"  src="../js/jquery-3.6.3.min.js"></script>
<script type="text/javascript"  src="../js/sweetalert.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- /Footer -->
</body>
</html>
