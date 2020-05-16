<?php
include 'header.php';
$engine->permissions(1,1,1,0);
$pid = md5(rand(0,999));
$date = date('Y-m-d G:i:s');
$edate = date('Y-m-d G:i:s', strtotime(' +1 day'));
?>
        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>إضافة   عروض جديدة
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
                                <label>القيمة الأساسية</label>
                                <input type="text" name="price" required="required" class="form-control col-md-12 col-xs-12">
                                <small>(<?=DCR?>)</small>
                            </div>
                            <div class="item col-md-3 col-sm-12 col-xs-12">
                                <label>القيمة بعد التخفيض</label>
                                <input type="text" name="oldprice" required="required" class="form-control col-md-12 col-xs-12">
                                <small>(<?=DCR?>)</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>الشروط</label>
                                <?php 
                                $show  = 'addet';
                                include '../editor.php';?>
                                <small>رجاء افصل بين كل شرط والآخر باستخدام الفاصلة  ,</small>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>وصف المنتج</label>
                                <?php 
                                $show  = 'desc';
                                include '../editor.php';?>
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
                                <?if(USER_RANK ==1 || USER_RANK == 2){?>
                                <label>نسبة الموقع</label>
                                <input type="text" value="<?=$show['ratio']?>" name="ratio" required="required" class="form-control col-md-12 col-xs-12">
                                <?}if(USER_RANK == 3){?>
                                <input type="hidden" name="ratio">
                                <input type='hidden' value="<?=$date?>" name="date" class="form-control"/>
                                </div>
                                <?}?>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الكمية</label>
                                <input class="form-control col-md-12 col-xs-12" name="amount" type="text"/>
                                <small>الكمية المتوافرة من هذا  المنتج</small>
                            </div>
                        </div>
                        <?if(USER_RANK == 3){?>
                            <input type='hidden' name="enddate" value="<?=$edate?>" class="form-control"/>      
                        <?}?>
                        <?if(USER_RANK == 1 || USER_RANK == 2){?>
                            <input type='hidden' name="date" value="<?=$date?>" class="form-control"/>
                            <input type='hidden' name="enddate" value="<?=$edate?>" class="form-control"/>
                        <?}?>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>طباعة الفاتورة</label>
                                <select name="rstatus" class="form-control">
                                    <option value="1">نقبل نسخة إلكترونية</option>
                                    <option value="0">يجب طباعة  فاوتشر</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الفروع التي يسري عليها العرض</label>
                                <select name="spranches" class="form-control" onchange="s_pranch()">
                                    <option disabled selected>اختر الفروع</option>
                                    <?php
                                    if(USER_RANK == 1)
                                    {
                                        $q = $engine->connect()->query("SELECT * FROM `companies`");
                                    }
                                    else
                                    {
                                        $merchant = USER_ID;
                                        $q = $engine->connect()->query("SELECT * FROM `companies` WHERE `merchant` = '$merchant'");
                                    }
                                    while($showpr = $q->fetch_array()){?>
                                    <option value="<?=$showpr['name']?>">
                                        <?=$showpr['name']?>
                                    </option> 
                                    <?}?>
                                </select>
                                <input type="hidden" name="pranches">
                                <small></small>
                                <ul id="pranchesli">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?include 'cities.php';?>
                                <input type="hidden" name="cities">
                                <ul id="citiesli">
                                </ul>
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
                            <button onclick="add_offer('add','add_deal')" class="btn btn-primary">إضافة</button>
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