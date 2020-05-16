<?php
include 'header.php';
$engine->permissions(1,0,0,0);
?>        
<!-- page content -->
<div class="right_col" role="main" id="divcont">
    <div class="row" id="cont">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> إعدادات الموقع
                        <small>البيانات العامة والأساسية للموقع</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="demo-form2" name="edit-site" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>اسم الموقع</label>
                                <input type="text" name="name" value="<?=S_NAME?>" required="required" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>عنوان الموقع</label>
                                <input type="text" name="lnk" value="<?=S_DOMAIN?>" required="required" class="form-control col-md-12 col-xs-12">
                                <small>الرابط بدون https, http أو www</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>رقم الهاتف</label>
                                <input type="text" name="phone" value="<?=S_PHONE?>" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>البريد الإلكتروني</label>
                                <input type="text" name="mail" value="<?=S_MAIL?>" class="form-control col-md-12 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الكلمات الدلالية</label>
                                <input id="tags_1" name="keys" value="<?=S_KEYS?>" type="text" class="tags form-control" value=""/>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>وصف الموقع</label>
                                <textarea class="textarea" name="desc" placeholder="أدخل النص هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                <?=S_DESC?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>لوجو الموقع</label>
                                <div class="col-md-12  row">
                                    <div class="col-md-8  text-left" id="msg">
                                        <img class="us-thump" src="<?=S_IMG?>" />      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صورة 
                                        <input type="file" id="pim"  onchange="uploadsit('<?=S_URI?>')" capture="camera" name="file[]"/>        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>ايقونة الموقع</label>
                                <div class="col-md-12 row">
                                    <div class=" col-md-8  text-left" id="fav">
                                       <img class="fav" src="<?=S_ICON?>" />      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صورة  
                                        <input type="file" id="fpim"   capture="camera" name="file[]"  onchange="uplfav('<?=S_URI?>')"/>        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="msg1"></div>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="edit_site()" class="btn btn-primary">حفظ</button>
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
<!-- Summernote -->
<script src="assets/vendors/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>