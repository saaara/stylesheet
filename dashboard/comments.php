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
                    <h2> مراجعة التعليقات
                        <small>تعليقات بانتظار الموافقة</small>
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
                            <th>التعليق</th>
                            <th>الوقت</th>
                            <th>المستخدم</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?
                            if(USER_RANK == 1 || USER_RANK == 2)
                            {
                                $qrc = "SELECT * FROM `comments` WHERE `status` = 0";
                            }
                            else
                            {
                                $uid = USER_ID;
                                $qrc = "SELECT * FROM `comments` WHERE (`status` = 0 AND `uid` = '$uid')";
                            }
                            $smdrc = $engine->connect()->query($qrc);
                            while ($showrc = $smdrc->fetch_array())
                            {
                                $pid    = $showrc['to'];
                                $uid    = $showrc['from'];
                                $qp1    = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
                                $showp1 = $qp1->fetch_array();
                                $qu1    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
                                $showu1 = $qu1->fetch_array();
                            ?>
                            <tr id="comments<?=$showrc['id']?>">
                                <th>
                                    <a href="<?=$showp1['pid']?>" target="_blank"><?=$showp1['name']?></a>
                                </th>
                                <th><?=$showrc['comment']?></th>
                                <th><?=counttime($showrc['date']);?></th>
                                <th>
                                    <a href="users#<?=$showu1['id']?>" target="_blank"><?=$showu1['name']?></a>
                                </th>
                                <th>
                                    <button class="btn btn-danger btn-flat" onclick="del('comments','<?=$showrc[id]?>')"><i class="fa fa-trash"></i></button>
                                    <a onclick="acc_comm('<?=$showrc[id]?>')" class="btn btn-success btn-flat"><i class="fa fa-check"></i></a>
                                </th>
                            </tr>
                            <?}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--all comments-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> جميع  التعليقات
                        <small>جميع التعليقات الموجودة على المنتجات</small>
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display:none;">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <p>اضغط على  اسم المنتج أو المستخدم للعرض</p>
                        <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th>التعليق</th>
                            <th>الوقت</th>
                            <th>المستخدم</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?
                            if(USER_RANK == 1 || USER_RANK == 2)
                            {
                                $q = "SELECT * FROM `comments` WHERE `status` = 1";
                            }
                            else
                            {
                                $uid = USER_ID;
                                $q = "SELECT * FROM `comments` WHERE (`status` = 1 AND `uid` = '$uid')";
                            }
                            $smdrc = $engine->connect()->query($q);
                            while ($showrc = $smdrc->fetch_array())
                            {
                                $pid    = $showrc['pid'];
                                $uid    = $showrc['from'];
                                $qp    = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
                                $showp = $qp->fetch_array();
                                $qu    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
                                $showu = $qu->fetch_array();
                            ?>
                            <tr id="comments<?=$showrc['id']?>">
                                <th>
                                    <a href="<?=$showp['pid']?>" target="_blank"><?=$showp['name']?></a>
                                </th>
                                <th><?=$showrc['comment']?></th>
                                <th><?=counttime($showrc['date']);?></th>
                                <th>
                                    <a href="users#<?=$showu['id']?>" target="_blank"><?=$showu['name']?></a>
                                </th>
                                <th>
                                    <button class="btn btn-danger btn-flat" onclick="del('comments','<?=$showrc[id]?>')"><i class="fa fa-trash"></i></button>
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