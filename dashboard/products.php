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
                    <h2> المنتجات
                        <small>جميع المنتجات</small>
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <p>اضغط على اسم المنتج أو التاجر للعرض</p>
                        <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th>القسم</th>
                            <th>التاريخ</th>
                            <th>التاجر</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK == 3)
                        {
                            $thisid = USER_ID;
                            $q = "SELECT * FROM `products` WHERE (`uid` = '$thisid' AND `status` = 1) ORDER BY `date` DESC";
                        }
                        else if(USER_RANK == 1 || USER_RANK == 2)
                        {
                            $q = "SELECT * FROM `products` WHERE `status` = 1 ORDER BY `date` DESC ";
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
                            <th><?=counttime($show['date']);?></th>
                            <th>
                                <a href="users#users<?=$showu['id']?>" target="_blank"><?=$showu['name']?></a>
                            </th>
                            <th>
                                <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#del<?=$show['pid']?>"><i class="fa fa-trash"></i></button>
                                <a href="pedt?edit=<?=$show['pid']?>" class="btn btn-success btn-flat"><i class="fa fa-edit"></i></a>
                            </th>
                        </tr>
                        <!--delete confirm-->
                        <div class="modal fade" id="del<?=$show['pid']?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3>تأكيد الحذف</h3>
                                    </div>
                                    <div class="modal-body modal-body-sub_agile">
                                        <div class="modal_body_left modal_body_left1">
                                            <h3 id="dmsg<?=$show['pid']?>">
                                                هل أنت متأكد من أنك تريد  حذف هذا  المنتج ؟
                                            </h3> 
                                            <button class="btn btn-danger" onclick="del('products','<?=$show[pid]?>')">حذف</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- //Modal content-->
                            </div>
                        </div>
                        <!--/ delete confirm-->
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