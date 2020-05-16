<?php
include 'header.php';
$engine->permissions(1,1,0,0);
?>        
<!-- page content -->
<div class="right_col" role="main" id="divcont">
    <div class="row" id="cont">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>الحسابات المُعلقة
                        <small>حسابات التجار المُعلقة</small>
                    </h2>
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
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الرتبة</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $thisid = USER_ID;
                        $q = "SELECT * FROM `users` WHERE (`id` <> '$thisid' AND `active` = 0)";
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array()) {?>
                        <tr id="users<?=$show['id']?>">
                            <th><?=$show['name']?></th>
                            <th><?=$show['mail']?></th>
                            <th>
                                <?php
                                if($show['rank'] == 2)
                                {
                                    echo "مشرف";
                                }
                                else if($show['rank'] == 1)
                                {
                                    echo "مدير";
                                }
                                else if($show['rank'] == 3)
                                {
                                    echo "تاجر";
                                }
                                else
                                {
                                    echo "مُستخدم";
                                }
                                ?>
                            </th>
                            <th>
                                <button class="btn btn-danger btn-flat" data-placement="top" data-toggle="tooltip"data-original-title="حذف" onclick="del('users','<?=$show[id]?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a onclick="activate('<?=$show[id]?>')" data-placement="top" data-toggle="tooltip"data-original-title="تفعيل" class="btn btn-success btn-flat">
                                    <i class="fa fa-check"></i>
                                </a>
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