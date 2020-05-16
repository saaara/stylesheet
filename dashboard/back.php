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
                    <h2>طلبات إرجاع المنتجات
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <p>اضغط على  اسم المنتج أو المستخدم للعرض</p>
                        <thead>
                        <tr>
                            <th>المشتري</th>
                            <th>رقم التتبع</th>
                            <th>الرسالة</th>
                            <th>رقم التواصل</th>
                            <th>الوقت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK == 1 || USER_RANK == 2)
                        {
                            $q  = "SELECT * FROM `reports` WHERE `type` = 'back'";
                        }
                        else
                        {
                            $uid = USER_ID;
                            $q  = "SELECT * FROM `reports` WHERE (`type` = 'back' AND  `uid` = '$uid')";
                        }
                        $smd = $engine->connect()->query($q);
                        while($show = $smd->fetch_array())
                        {
                            $pid   = $show['to'];
                            $uid   = $show['from'];
                            $qp    = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
                            $showp = $qp->fetch_array();
                            $qu    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
                            $showu = $qu->fetch_array();
                        ?>
                        <tr id="reports<?=$show['id']?>">
                            <th>
                                <a href="users#<?=$showu['id']?>" target="_blank"><?=$showu['name']?></a>
                            </th>
                            <th>
                                <?=$showp['to']?>
                            </th>
                            <th><?=$show['msg']?></th>
                            <th><?=$show['phone']?></th>
                            <th><?=counttime($show['date'])?></th>
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
