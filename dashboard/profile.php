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
                    <h2> إعدادات الحساب
                        <small>تعديل الاسم , البريد الإلكتروني وكلمة السر</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" name="form" novalidate>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الاسم</label>
                                <input type="text" name="name" data-validate-length-range="6" data-validate-words="2" required="required" value="<?=USER_NAME?>" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>البريد الإلكتروني</label>
                                <input type="email" name="mail" id="email" required="required" value="<?=USER_MAIL?>" class="form-control col-md-12 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>كلمة المرور</label>
                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>تأكيد كلمة المرور</label>
                                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>تغيير الصورة الشخصية</label>
                            <div class="col-md-12 row">
                                <div class=" col-md-8 text-left" id="msg">
                                    <img class="us-thump" src="<?=USER_IMG?>" />      
                                </div>
                                <div class="btn p-type btn-file col-md-4">
                                    <i class="fa fa-paperclip"></i> اختر صورة 
                                    <input type="file" id="pim"   capture="camera" name="file[]"  onchange="uploadusr()"/>        
                                </div>
                            </div>
                        </div>
                        <center id="msg"></center>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="upd_profile('<?=USER_ID?>')" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>