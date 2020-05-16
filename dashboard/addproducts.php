<?php
include 'header.php';
$engine->permissions(1,1,1,0);
$pid = md5(rand(0,999));
?>       
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>إضافة  منتجات
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" name="add-pro">
                        <div class="form-group col-md-12"> 
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>عنوان المنتج "الاسم"</label>
                                <input type="text" data-validate-length-range="8" data-validate-words="1" required="required" name="name" class="form-control col-md-12 col-xs-12">
                                <input type="hidden" name="pid" value="<?=$pid?>">
                            </div>
                            <div class="item col-md-3 col-sm-12 col-xs-12">
                                <label>السعر</label>
                                <input type="text" name="price" required="required" class="form-control col-md-12 col-xs-12">
                                <small>(<?=DCR?>)</small>
                            </div>
                            <div class="item col-md-3 col-sm-12 col-xs-12">
                                <label>بدلاً من "في حالة وجود خصم"</label>
                                <input type="text" name="oldprice" required="required" class="form-control col-md-12 col-xs-12">
                                <small>(<?=DCR?>)</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>معلومات إضافية عن المنتج</label>
                                <input id="tags_1" name="addet" type="text" class="tags form-control"/>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>وصف المنتج</label>
                                <textarea style="height:100px;" data-validate-length-range="50" data-validate-words="10"  name="desc" required="required" class="tags form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>القسم</label>
                                <select class="form-control" name="sec">
                                    <?php
                                    $qsc = $engine->connect()->query("SELECT * FROM `sections`");
                                    while($section = $qsc->fetch_array()){?>
                                    <option value="<?=$section['name']?>"><?=$section['name']?></option>
                                    <?}?>
                                    <?php
                                    $qssc = $engine->connect()->query("SELECT * FROM `ssections`");
                                    while($ssection = $qssc->fetch_array()){?>
                                    <option value="<?=$ssection['name']?>"><?=$ssection['name']?></option>
                                    <?}?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الكلمات الدلالية</label>
                                <input id="tags" name="tags" type="text" class="tags form-control" value=""/>
                                <small>افصل بين الكلمات ب "," لعرض أفضل في نتائج البحث</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>نسبة الموقع</label>
                                <?if(USER_RANK ==1 || USER_RANK == 2){?>
                                <input type="text" value="<?=$show['ratio']?>" name="ratio" required="required" class="form-control col-md-12 col-xs-12">
                                <?}if(USER_RANK == 3){?>
                                <input type="hidden" name="ratio">
                                <?}?>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الكمية</label>
                                <input class="form-control col-md-12 col-xs-12" name="amount" type="text"/>
                                <small>الكمية المتوافرة من هذا  المنتج</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>صور المنتج</label>
                                <div class="col-md-12 row">
                                    <div class=" col-md-8">
                                        <div id="err1"></div>
                                        <div id="msg1"></div>      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صور
                                        <input type="file" id="pimg1"  name="files1[]" multiple onchange="edtupload('<?=$pid?>')"/> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12" id="msg"></div>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="add_product('add','add_product')" class="btn btn-primary">إضافة</button>
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