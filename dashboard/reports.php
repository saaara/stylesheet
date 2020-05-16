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
                    <h2>الشكاوى
                        <small>جميع الشكاوي المقدمة من المستخدمين</small>
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
                            <th>مُقدم الشكوى</th>
                            <th>المنتج</th>
                            <th>الشكوى</th>
                            <th>رقم التواصل</th>
                            <th>الوقت</th>
                            <?if(USER_RANK == 1 || USER_RANK ==2){?>
                            <th>خيارات</th>
                            <?}?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(USER_RANK == 1 || USER_RANK == 2)
                        {
                            $q  = "SELECT * FROM `reports` WHERE `type` = 'report'";
                        }
                        else
                        {
                            $uid = USER_ID;
                            $q  = "SELECT * FROM `reports` WHERE (`type` = 'report' AND  `uid` = '$uid')";
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
                                <a href="../<?=$showp['pid']?>" target="_blank"><?=$showp['name']?></a>
                            </th>
                            <th><?=$show['msg']?></th>
                            <th><?=$show['phone']?></th>
                            <th><?=counttime($show['date'])?></th>
                            <?if(USER_RANK == 1 || USER_RANK ==2){?>
                            <th>
                                <button data-placement="top" data-toggle="tooltip" data-original-title="شكوى زائفة" class="btn btn-danger btn-flat" onclick="del('reports','<?=$show[id]?>')"><i class="fa fa-trash"></i></button>
                                <button data-placement="top" data-toggle="tooltip" data-original-title="تم التعامل مع الشكوى" class="btn btn-success btn-flat" onclick="del('reports','<?=$show[id]?>')"><i class="fa fa-check"></i></button>
                            </th>
                            <?}?>
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