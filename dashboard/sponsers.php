<?php
include 'header.php';
$engine->permissions(1,1,0,0);
?>         
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> الرُعاة
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
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الاسم</label>
                                <input type="text" name="name" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>القسم</label>
                                <select name="section" class="form-control">
                                    <option value="">اختر واحد</option>
                                    <?php
                                    $q = $engine->connect()->query("SELECT * FROM `ssections`");
                                    while($show_sec = $q->fetch_array()){?>
                                    <option value="<?=$show_sec['name']?>">
                                        <?=$show_sec['name']?>
                                    </option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-12 col-sm-12 col-xs-12">
                                <label for="inputEmail">الرابط</label>
                                <input type="text" name="link" class="theinp form-control" placeholder="الرابط"  autofocus>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>البانر</small></label>
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
                            <button onclick="add_sponser()" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12" id="divcont">
            <div class="x_panel" id="cont">
                <div class="x_title">
                    <h2> 
                        الرُعاة
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
                            <th>الصورة</th>
                            <th>الاسم</th>
                            <th>الرابط</th>
                            <th>القسم</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT * from `sponsers`";
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array()) {?>
                        <tr id="companies<?=$show['id']?>">
                            <th>
                                <img src="<?=$show['baner']?>" style="width:60px; height:60px;">
                            </th>
                            <th><?=$show['name']?></th>
                            <th><?=$show['link']?></th>
                            <th><?=$show['section']?></th>
                            <th>
                                <button class="btn btn-danger btn-flat" data-toggle="modal" onclick="del('sponsers','<?=$show[id]?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
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