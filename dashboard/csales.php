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
                    <h2>  المبيعات المغلقة
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>القسم</th>
                            <th>البائع</th>
                            <th>المُشتري</th>
                            <th>السعر</th>
                            <th>نسبة الموقع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK == 1 || USER_RANK ==2)
                        {
                            $q = "SELECT DISTINCT * FROM `sales` WHERE `status` = 3 ORDER BY `num`";
                        }
                        else
                        {
                            $uid = USER_ID;
                            $q   = "SELECT DISTINCT * FROM `sales` WHERE (`uid` = '$uid' AND `status` = 3) ORDER BY `num`";
                        }
                        $smd = $engine->connect()->query($q);
                        while($show = $smd->fetch_array())
                        {
                            $pid    = $show['pid'];
                            $bid    = $show['buyer'];
                            $uid    = $show['uid'];
                            $qp     = "SELECT * FROM `products` WHERE `pid` = '$pid'";
                            $smdp   = $engine->connect()->query($qp);
                            $nm     = $smdp->num_rows;
                            if($nm <= 0)
                            {
                                $qp     = "SELECT * FROM `offers` WHERE `pid` = '$pid'";
                                $smdp   = $engine->connect()->query($qp);
                            }
                            $showp  = $smdp->fetch_array();
                            $qb     = "SELECT * FROM `users` WHERE `id` = '$bid'";
                            $smdb   = $engine->connect()->query($qb);
                            $showb  = $smdb->fetch_array();
                            $qu     = "SELECT * FROM `users` WHERE `id` = '$uid'";
                            $smdu   = $engine->connect()->query($qu);
                            $showu  = $smdu->fetch_array();
                            $qnm    = "SELECT * FROM `sales` WHERE `pid` = '$pid'";
                            $smdnm  = $engine->connect()->query($qnm);
                            $nums   = $smdnm->num_rows;
                            $qcom   = "SELECT * FROM `trans` WHERE (`pid` = '$pid' AND `uid` = '$uid' AND `type` = 'in')";
                            $smdcom = $engine->connect()->query($qcom);
                            $showcom= $smdcom->fetch_array();
                        ?>
                        <tr>
                            <th>
                                <a href="../<?=$showp['pid']?>" target="_blank"><?=$showp['name']?></a>
                            </th>
                            <th><?=$showp['section']?></th>
                            <th><a href="users#users<?=$showu['id']?>" target="_blank"><?=$showu['name']?></a></th>
                            <th><a href="users#users<?=$showb['id']?>" target="_blank"><?=$showb['name']?></a></th>
                            <th><?=$showp['newprice'].' ' .DCRC;?></th>
                            <th>
                                <?php 
                                if($showcom['commission'] == '')
                                {
                                    echo"0";
                                }
                                else
                                {
                                    echo $showcom['commission'];
                                }
                                echo DCRC
                                ?>
                            </th>
                        </tr>
                        <?}?>
                        </tbody>
                    </table>
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