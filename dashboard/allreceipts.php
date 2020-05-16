<?php
include 'header.php';
$engine->permissions(1,1,1,0);
?>        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> الفواتير
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    if(USER_RANK == 1 || USER_RANK ==2)
                    {
                        $q = "SELECT DISTINCT `receipt` FROM `sales` ORDER BY `num`";
                    }
                    else
                    {
                        $uid = USER_ID;
                        $q   = "SELECT DISTINCT `receipt` FROM `sales` WHERE `uid` = '$uid' ORDER BY `num`";
                    }
                    $smd = $engine->connect()->query($q);
                    while($show = $smd->fetch_array()){?>
                    <div class="receipt col-md-12" id="pid">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <h3>فاتورة رقم : # <?=$show['receipt']?></h3>
                            </div>
                            <div class="col-md-6 text-left">
                                <a href="receipt.php?rid=<?=$show['receipt']?>" target="_blank" class="btn btn-warning btn-flat"><i class="fa fa-file"></i> عرض الفاتورة</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                            <div class="col-md-12">
                                <b>المنتجات</b>
                                <?php
                                $receipt = $show['receipt'];
                                $qr = $engine->connect()->query("SELECT * FROM `sales` WHERE `receipt` = '$receipt'");
                                while($showr = $qr->fetch_array()){
                                    $pid = $showr['pid'];
                                    $qp  = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
                                    $nm     = $qp->num_rows;
                                    if($nm <= 0)
                                    {
                                        $qp  = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
                                    }
                                    $showp = $qp->fetch_array();
                                    ?>
                                    <p>
                                        <a href="products#<?=$showp['pid']?>" target="_blank">
                                            <?=$showp['name']?>
                                        </a>
                                    </p>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>
<!-- Datatables -->
<script src="assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>