<?php
include 'header.php';
$pid = addslashes(htmlspecialchars($_GET['edit']));
$q   = "SELECT * FROM `offers` WHERE `pid` = '$pid'";
$smd = $engine->connect()->query($q);
$showp = $smd->fetch_array();
$engine->permissions(1,1,1,0);
$edate = date('d-m-Y h:i:s A', strtotime($showp['edate']));
$date = date('d-m-Y h:i:s A', strtotime($showp['date']));
?>      
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل الفاوتشر  
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                    <form id="demo-form2" method="post" data-parsley-validate class="form-horizontal form-label-left" action="#" name="add-pro">
                        <div class="form-group col-md-12"> 
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>عنوان المنتج "الاسم"</label>
                                <input type="text" data-validate-length-range="8" data-validate-words="1" required="required" name="name" value="<?=$showp['name']?>" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="item col-md-3 col-sm-12 col-xs-12">
                                <label>السعر</label>
                                <input type="text" value="<?=$showp['newprice']?>" name="price" required="required" class="form-control col-md-12 col-xs-12">
                                <small>(<?=DCR?>)</small>
                            </div>
                            <div class="item col-md-3 col-sm-12 col-xs-12">
                                <label>بدلاً من "في حالة وجود خصم"</label>
                                <input type="text" value="<?=$showp['oldprice']?>" name="oldprice" required="required" class="form-control col-md-12 col-xs-12">
                                <small>(<?=DCR?>)</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>الشروط</label>
                                <?php 
                                $show  = 'addet';
                                $txt   = $showp['ad_det'];
                                include '../editor.php';?>
                                <small></small>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>وصف المنتج</label>
                                <?php 
                                $show  = 'desc';
                                $txt   = $showp['desc'];
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
                                    <option <?if($showp['section']==$section['name']){echo "selected";}?> value="<?=$section['name']?>"><?=$section['name']?></option>
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
                                <input id="tags" name="tags" value="<?=$showp['keys']?>" type="text" class="tags form-control" value=""/>
                                <small>افصل بين الكلمات ب "," لعرض أفضل في نتائج البحث</small>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>نسبة الموقع</label>
                                <?if(USER_RANK ==1 || USER_RANK == 2){?>
                                <input type="text" value="<?=$showp['ratio']?>" name="ratio" required="required" class="form-control col-md-12 col-xs-12">
                                <?}if(USER_RANK == 3){?>
                                <input type="hidden" value="<?=$showp['ratio']?>" name="ratio">
                                <label>تاريخ بدء العرض</label>
                                <div class='input-group date'>
                                    <input type='text' value="<?=$date?>" name="date" class="form-control" id='myDatepicker' />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <?}?>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الكمية</label>
                                <input class="form-control col-md-12 col-xs-12" name="amount" value="<?=$showp['amount']?>" type="text"/>
                                <small>الكمية المتوافرة من هذا  المنتج</small>
                            </div>
                        </div>
                        <?if(USER_RANK == 3){?>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>تاريخ انتهاء العرض</label>
                                <div class='input-group date'>
                                    <input type='text' name="enddate" value="<?=$edate?>" class="form-control" id='myDatepicker2' />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?}?>
                        <?if(USER_RANK == 1 || USER_RANK == 2){?>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>تاريخ بدء العرض</label>
                                <div class='input-group date'>
                                    <input type='text' value="<?=$date?>" name="date" class="form-control" id='myDatepicker' />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>تاريخ انتهاء العرض</label>
                                <div class='input-group date'>
                                    <input type='text' name="enddate" value="<?=$edate?>" class="form-control" id='myDatepicker2' />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?}?>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>طباعة الفاتورة</label>
                                <select name="rstatus" class="form-control">
                                    <option value="1" <?if($showp['rstatus'] == 1){?> selected <?}?>>يقبل طباعة فاتورة</option>
                                    <option value="0" <?if($showp['rstatus'] == 0){?> selected <?}?>>لا يقبل  طباعة فاتورة</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الفروع التي يسري عليها العرض</label>
                                <select name="spranches" class="form-control" onchange="s_pranch()">
                                    <option disabled selected>اختر الفروع</option>
                                    <?php
                                    if(USER_RANK == 1)
                                    {
                                        $qp = $engine->connect()->query("SELECT * FROM `companies`");
                                    }
                                    else
                                    {
                                        $merchant = USER_ID;
                                        $qp = $engine->connect()->query("SELECT * FROM `companies` WHERE `merchant` = '$merchant'");
                                    }
                                    while($showpr = $qp->fetch_array()){?>
                                    <option value="<?=$showppr['name']?>">
                                        <?=$showpr['name']?>
                                    </option> 
                                    <?}?>
                                </select>
                                <input type="text" class="col-md-12" value="<?=$showp['pranches']?>" name="pranches">
                                <small>يمكنك اختيار أكثر من فرع</small>
                                <ul id="pranchesli">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?include 'cities.php';?>
                                <input type="hidden" value="<?=$showp['cities']?>" name="cities">
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
                                        <div id="msg1">
                                            <ul class="img-del">
                                            <?php 
                                            $qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
                                            while($showimg = $qimg->fetch_array()){?>
                                            <li id="photos<?=$showpimg['id']?>">
                                              <img class='thump' src='<?=$showimg['img']?>'/>
                                              <button type="button" class="btn-danger" data-toggle="modal" data-target="#del<?=$showimg['id']?>">
                                                  <i class="fa fa-times"></i>
                                              </button>
                                            </li>
                                            <!--delete confirm-->
                                            <div class="modal fade" id="del<?=$showpimg['id']?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h3>تأكيد الحذف</h3>
                                                        </div>
                                                        <div class="modal-body modal-body-sub_agile">
                                                            <div class="modal_body_left modal_body_left1">
                                                                <h3 id="dmsg<?=$showpimg['id']?>">
                                                                    هل أنت متأكد من أنك تريد  حذف هذا المشرف ؟
                                                                </h3>
                                                                <button class="btn btn-danger" onclick="del('photos','<?=$showpimg[id]?>')">حذف</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- //Modal content-->
                                                </div>
                                            </div>
                                            <!--/ delete confirm--> 
                                            <?}?>
                                            </ul>
                                        </div>      
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
                            <button onclick="add_offer('update','add_offers','<?=$showp[pid]?>')" class="btn btn-primary">تعديل</button>
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