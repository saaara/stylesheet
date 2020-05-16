<?php
include 'header.php';
$engine->permissions(1,1,1,0);
?>       
<!-- page content -->
<div class="right_col" role="main">
    <?
    if(USER_RANK ==1 OR USER_RANK ==2)
    {
        include 'admin_index.php';
    }
    else if(USER_RANK ==3)
    {
        include 'merchant_index.php';
    }
    else if(USER_RANK ==0)
    {
        include 'user_index.php';
    }
    ?>
</div>
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>