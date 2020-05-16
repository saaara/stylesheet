<?php
include 'header.php';
$engine->permissions(1,1,1,0);
?>        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <?php
        if(USER_RANK == 0)
        {
            include 'user_tracker.php';
        }
        else if(USER_RANK == 1 || USER_RANK == 2 || USER_RANK == 3)
        {
            include 'admin_tracker.php';
        }
        ?>
    </div>
</div>
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>
