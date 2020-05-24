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
                    <h2> الشركات والفروع
                        <small>إضافة  وحذف</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" name="companies" novalidate>
                        <div class="form-group col-md-12">
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>الاسم عربي</label>
                                <input type="text" name="name" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>الاسم إنجليزي</label>
                                <input type="text" name="ename" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>التاجر</label>
                                <select name="merchant" class="form-control">
                                    <option value="">اختر واحد</option>
                                    <?php
                                    $q = $engine->connect()->query("SELECT * FROM `users` WHERE `rank` = 3");
                                    while($showm = $q->fetch_array()){?>
                                    <option value="<?=$showm['id']?>">
                                        <?=$showm['name']?>
                                    </option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>عنوان الفرع</label>
                                <textarea name="address" class="textarea form-control col-md-12 col-xs-12"></textarea>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>معلومات التواصل</label>
                                <textarea name="contact" class="textarea form-control col-md-12 col-xs-12"></textarea>
                            </div>
                            <input type="hidden" name="type" value="3">
                        </div>
                         <div class="item col-md-12 col-sm-12 col-xs-12">
                            <label for="inputEmail">العنوان على خرائط جوجل</label>
                            <input type="text" id="pickup_country" name="map" class="theinp form-control" placeholder="العنوان على الخريطة"  autofocus>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>شعار الشركة</small></label>
                                <div class="col-md-12 row">
                                    <div class=" col-md-8">
                                        <div id="err1"></div>
                                        <div id="msg1">
                                            <input type="hidden" value="" name="img">
                                        </div>      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صور
                                        <input type="file" id="pimg1"  name="files1[]" multiple onchange="upload_baner()"/>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <center id="msg"></center>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="add_company()" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> 
                        الشركات
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
                            <th>شعار الشركة</th>
                            <th>اسم الشركة</th>
                            <th>الاسم  باللغة الإنجليزية</th>
                            <th>العنوان</th>
                            <th>معلومات التواصل</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT * from `companies`";
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array()) {?>
                        <tr id="companies<?=$show['id']?>">
                            <th>
                                <img src="<?=$show['img']?>" style="width:60px; height:60px;">
                            </th>
                            <th><?=$show['name']?></th>
                            <th><?=$show['ename']?></th>
                            <th><?=$show['address']?></th>
                            <th><?=$show['contact']?></th>
                            <th>
                                <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#del<?=$show['id']?>">
                                    <i class="fa fa-trash"></i>
                                </button>
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
                        <!--delete confirm-->
                        <div class="modal fade" id="del<?=$show['id']?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3>تأكيد الحذف</h3>
                                    </div>
                                    <div class="modal-body modal-body-sub_agile">
                                        <div class="modal_body_left modal_body_left1">
                                            <h3 id="dmsg<?=$show['id']?>">
                                                هل أنت متأكد من أنك تريد  حذف هذا المشرف ؟
                                            </h3>
                                            <button class="btn btn-danger" onclick="del('companies','<?=$show[id]?>')">حذف</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- //Modal content-->
                            </div>
                        </div>
                        <!--/ delete confirm-->
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
<!-- Summernote -->
<script src="assets/vendors/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>