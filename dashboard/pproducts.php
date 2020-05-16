<?php
include 'header.php';
$engine->permissions(1,1,0,0);
?>         
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المنتجات المُعلقة
                        <small>منتجات بانتظار المراجعة</small> 
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
                            <th>اسم المنتج</th>
                            <th>القسم</th>
                            <th>السعر</th>
                            <th>الوقت</th>
                            <th>المستخدم</th>
                            <th>نسبة الموقع</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK ==1 )
                        {
                            $q = "SELECT * FROM `products` WHERE `status` = 0 ORDER BY `date` DESC ";
                        }
                        else
                        {
                            $uid = USER_ID;
                            $q = "SELECT * FROM `products` WHERE (`status` = 0 AND `uid` = '$uid') ORDER BY `date` DESC ";
                        }
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array())
                        {
                            $usr   = $show['uid'];
                            $qu    = "SELECT * FROM `users` WHERE `id` = '$usr'";
                            $smdu  = $engine->connect()->query($qu);
                            $showu = $smdu->fetch_array();
                        ?>
                        <tr id="products<?=$show['pid']?>">
                            <th>
                                <a href="../<?=$show['pid']?>" target="_blank"><?=$show['name']?></a>
                            </th>
                            <th><?=$show['section']?></th>
                            <th><?=$show['newprice']?></th>
                            <th><?=counttime($show['date']);?></th>
                            <th>
                                <a href="users#users<?=$showu['id']?>" target="_blank"><?=$showu['name']?></a>
                            </th>
                            <th>
                                <form name="ratio">
                                    <input type="text" placeholder="نسبة مئوية  (10,15...)" class="form-control" name="ratio">
                                </form>
                            </th>
                            <th>
                                <button class="btn btn-danger btn-flat" onclick="del('products','<?=$show[pid]?>')"><i class="fa fa-trash"></i></button>
                                <a href="pedt?edit=<?=$show['pid']?>" class="btn btn-success btn-flat"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-primary btn-flat" onclick="acc_pro('<?=$show[pid]?>','products')"><i class="fa fa-check"></i></button>
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