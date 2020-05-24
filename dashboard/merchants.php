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
                    <h2> التُجار
                        <small>إضافة  تاجر</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" name="signup" novalidate>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الاسم</label>
                                <input type="text" name="name" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>البريد الإلكتروني</label>
                                <input type="text" name="mail" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الهاتف</label>
                                <input type="text" name="phone" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>نسبة فاوتشر</label>
                                <input type="text" name="ratio" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>كلمة المرور</label>
                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>تأكيد كلمة المرور</label>
                                <input id="password2" type="password" name="repassword" data-validate-linked="password" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <input type="hidden" name="type" value="3">
                        </div>
                        <center id="msg"></center>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="s_up()" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المستخدمون
                        <small>مشاهدة وتعديل</small>
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
                            <th>الهاتف</th>
                            <th>الحالة</th>
                            <th>الرصيد</th>
                            <th>النسبة</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $thisid = USER_ID;
                        $q = "SELECT * FROM `users` WHERE (`id` <> '$thisid' AND `rank` = 3)";
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array()) {?>
                        <tr id="users<?=$show['id']?>">
                            <th><?=$show['name']?></th>
                            <th><?=$show['mail']?></th>
                            <th><?=$show['phone']?></th>
                            <th>
                                <?php
                                if($show['active'] == 1)
                                {
                                    echo "مُفعل";
                                }
                                else if($show['acgtive'] == 0)
                                {
                                    echo "غير مُفعل";
                                }
                                ?>
                            </th>
                            <th><?=$show['balance']. ' ' .DCRC?></th>
                            <th><?='%'.$show['ratio']?></th>
                            <th>
                                <button class="btn btn-danger btn-flat" onclick="del('users','<?=$show[id]?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="edtusers?edit=<?=$show['id']?>" data-placement="top" data-toggle="tooltip"data-original-title="تعديل" class="btn btn-success btn-flat">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#<?=$show['id']?>" class="btn btn-warning btn-flat">
                                    <i class="fa fa-info"></i>
                                </a>
                                <span class="dropdown">
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" aria-expanded="false" data-placement="top" data-original-title="ترقية">
                                        <span class="fa fa-level-up"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#" onclick="rnk('1','<?=$show[id]?>')">مُدير</a></li>
                                        <li><a href="#" onclick="rnk('3','<?=$show[id]?>')">تاجر</a></li>
                                        <li><a href="#" onclick="rnk('2','<?=$show[id]?>')">مُشرف</a></li>
                                        <li><a href="#" onclick="rnk('0','<?=$show[id]?>')">مستخدم</a></li>
                                    </ul>
                                </span>
                            </th>
                            <!-- Modal -->
                            <div class="modal fade" id="<?=$show['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">جميع بيانات  <?=$show['name']?></h4>
                                  </div>
                                  <div class="modal-body text-center">
                                        <img class="thump" src="<?=$show['usrimg']?>">
                                        <h3><?=$show['name']?></h3>
                                        <span>تاجر</span>
                                        <div class="text-right">
                                            <h3>آخر المنتجات بواسطة  <?=$show['name']?></h3>
                                            <?php
                                            $uid = $show['id'];
                                            $qad = $engine->connect()->query("SELECT * FROM `products` WHERE `uid` = '$uid' LIMIT 4");
                                            while ($showad = $qad->fetch_array()){?>
                                            <div>
                                                <a href="../<?=$showad['pid']?>" target="_blank"><?=$showad['name']?></a>
                                            </div><hr/>
                                            <?}?>
                                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
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