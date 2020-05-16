<?php
include 'header.php';
$engine->permissions(1,0,0,0);
?>       
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المدراء
                        <small>إضافة  مدير</small>
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
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>الاسم</label>
                                <input type="text" name="name" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>البريد الإلكتروني</label>
                                <input type="text" name="mail" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>الهاتف</label>
                                <input type="text" name="phone" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
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
                            <input type="hidden" name="type" value="2">
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
        <div class="col-md-12 col-sm-12 col-xs-12" id="divcont">
            <div class="x_panel" id="cont">
                <div class="x_title">
                    <h2> المشرفون
                        <small>مشاهدة وتعديل</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    $q = "SELECT * FROM `users` WHERE `rank` = 2";
                    $sdm = $engine->connect()->query($q);
                    while ($show = $sdm->fetch_array()) {?>
                    <!-- one admin -->
                     <div class="col-md-4 col-sm-4 col-xs-12 profile_details" id="users<?=$show['id']?>">
                        <div class="well profile_view">
                            <div class="col-sm-12">
                                <div class="left col-xs-7">
                                    <h2><?=$show['name']?></h2>
                                    <p><strong>مُشرف</strong></p>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-envelope "></i> <small><?=$show['mail']?></small></li>
                                    </ul>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="<?=$show['usrimg']?>" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                                
                                <div class="col-xs-12 col-sm-12 emphasis">
                                    <button type="button" class="btn btn-danger col-md-2" onclick="del('users','<?=$show[id]?>')">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                    <a href="edtusers?edit=<?=$show['id']?>" data-placement="top" data-toggle="tooltip"data-original-title="تعديل" class="btn btn-success btn-flat col-md-2">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle col-md-6" type="button" aria-expanded="false">تغيير الرُتبة <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#" onclick="rnk('1','<?=$show[id]?>')">مُدير</a></li>
                                        <li><a href="#" onclick="rnk('3','<?=$show[id]?>')">تاجر</a></li>
                                        <li><a href="#" onclick="rnk('2','<?=$show[id]?>')">مُشرف</a></li>
                                        <li><a href="#" onclick="rnk('0','<?=$show[id]?>')">مستخدم</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ one admin-->
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>