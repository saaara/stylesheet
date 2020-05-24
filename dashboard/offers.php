<?php
include 'header.php';
$engine->permissions(1,1,1,0);
?>         
<!-- page content -->
<div class="right_col" role="main" id="divcont">
    <div class="row" id="cont">
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
                            <th>تاريخ الانتهاء</th>
                            <th>التاجر</th>
                            <th>الفروع</th>
                            <th>المدينة</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK == 3)
                        {
                            $thisid = USER_ID;
                            $q = "SELECT * FROM `offers` WHERE (`uid` = '$thisid' AND `status` = 1) ORDER BY `date` DESC";
                        }
                        else
                        {
                            $q = "SELECT * FROM `offers` WHERE `status` = 1 ORDER BY `date` DESC ";
                        }
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array())
                        {
                            $usr   = $show['uid'];
                            $qu    = "SELECT * FROM `users` WHERE `id` = '$usr'";
                            $smdu  = $engine->connect()->query($qu);
                            $showu = $smdu->fetch_array();
                        ?>
                        <tr id="offers<?=$show['pid']?>">
                            <th>
                                <a href="../<?=$show['pid']?>" target="_blank"><?=$show['name']?></a>
                            </th>
                            <th><?=$show['section']?></th>
                            <th><?=counttime($show['date']);?></th>
                            <th><?=date('Y-m-d', strtotime($show['edate']));?></th>
                            <th>
                                <a href="users#users<?=$showu['id']?>" target="_blank"><?=$showu['name']?></a>
                            </th>
                            <th><?=$show['pranches']?></th>
                            <th><?=$show['city']?></th>
                            <th>
                                <button class="btn btn-danger btn-flat" onclick="del('offers','<?=$show[pid]?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="eedit?edit=<?=$show['pid']?>" class="btn btn-success btn-flat"><i class="fa fa-edit"></i></a>
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