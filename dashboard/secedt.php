<?php
include 'header.php';
$engine->permissions(1,0,0,0);
$id    = $_GET['edit'];
$q     = $engine->connect()->query("SELECT * FROM `sections` WHERE `id` = '$id'");
$show  = $q->fetch_array();
?>         
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>الأقسام
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                    <form name="add-pro">
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>اسم القسم</label>
                                <input type="text" value="<?=$show['name']?>" name="name" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الترتيب</label> 
                                <input type="text" name="rank" value="<?=$show['rank']?>" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>أيقونة القسم</label>
                                <div class="col-md-12 row">
                                    <div class=" col-md-8">
                                        <div id="err1"></div>
                                        <div id="msg1">
                                            <img src="<?=$show['img']?>"/>
                                            <input type="hidden" name="img" value="<?=$show['img']?>">
                                        </div>      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صور
                                        <input type="file" id="pimg1"  name="files1[]" multiple onchange="upload_baner()"/>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="msg"></div>
                            <div class="col-md-12 row">
                                <button class="btn btn-primary" onclick="add_section('update','<?=$id?>')">تعديل</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="msg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>