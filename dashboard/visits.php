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
                    <h2>  الأكثر مشاهدة
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
                            <th>السعر</th>
                            <th>نسبة الموقع</th>
                            <th>عدد  المشاهدات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK == 1 || USER_RANK ==2)
                        {
                            $q = "SELECT * FROM `products` WHERE `visits` <> 0 ORDER BY `visits` DESC";
                        }
                        else
                        {
                            $uid = USER_ID;
                            $q   = "SELECT * FROM `products` WHERE ( `visits` <> 0 AND `uid` = '$uid') ORDER BY `visits` DESC";
                        }
                        $smd = $engine->connect()->query($q);
                        $num = $smd->num_rows;
                        if($num <= 0)
                        {
                            if(USER_RANK == 1 || USER_RANK ==2)
                            {
                                $q = "SELECT * FROM `offers` WHERE `visits` <> 0 ORDER BY `visits` DESC";
                            }
                            else
                            {
                                $uid = USER_ID;
                                $q   = "SELECT * FROM `offers` WHERE ( `visits` <> 0 AND `uid` = '$uid') ORDER BY `visits` DESC";
                            }
                            $smd = $engine->connect()->query($q);
                        }
                        while($show = $smd->fetch_array())
                        {
                            
                            $bid    = $show['uid'];
                            $qb     = "SELECT * FROM `users` WHERE `id` = '$bid'";
                            $smdb   = $engine->connect()->query($qb);
                            $showb  = $smdb->fetch_array();
                            $qnm    = "SELECT * FROM `sales` WHERE `pid` = '$pid'";
                            $smdnm  = $engine->connect()->query($qnm);
                        ?>
                        <tr>
                            <th>
                                <a href="../<?=$show['pid']?>" target="_blank"><?=$show['name']?></a>
                            </th>
                            <th><?=$show['section']?></th>
                            <th><a href="users#users<?=$showb['id']?>" target="_blank"><?=$showb['name']?></a></th>
                            <th><?=$show['newprice'].' ' .DCRC;?></th>
                            <th><?=$show['ratio'].' %'?></th>
                            <th><?=$show['visits']?></th>
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