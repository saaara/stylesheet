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
                    <h2>إضافة بنرات
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                    <form id="demo-form2" action="#" data-parsley-validate class="form-horizontal form-label-left" name="add-pro">
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>الرابط التوجيهي</label>
                                <input type="text" name="lnk" class="form-control" placeholder="رابط منتج أو صفحة خارجية">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>صورة البانر <small>يُفضل أن تكون أبعاد الصورة أكبر من 500*300 بكسل </small></label>
                                <div class="col-md-12 row">
                                    <div class=" col-md-8">
                                        <div id="err1"></div>
                                        <div id="msg1"></div>      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صور
                                        <input type="file" id="pimg1"  name="files1[]" multiple onchange="upload_baner()"/>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="msg"></div>
                    <div class="form-group">
                        <div class="col-md-12 row">
                            <button class="btn btn-primary" onclick="add_baner()">إضافة</button>
                        </div>
                    </div> 
                    <div class="col-md-12" id="msg"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>جميع البنرات
                    </h2><br/>
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
                            <th>الرابط</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?
                            $qrc = "SELECT * FROM `baners`";
                            $smdrc = $engine->connect()->query($qrc);
                            while ($showrc = $smdrc->fetch_array())
                            {?>
                            <tr id="baners<?=$showrc['id']?>">
                                <th>
                                    <img src="<?=$showrc['img']?>" style="max-width: 500px;"/>
                                </th>
                                <th><?=$showrc['lnk']?></th>
                                <th>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#del<?=$showrc['id']?>"><i class="fa fa-trash"></i></button>
                                </th>
                            </tr>
                            <!--delete confirm-->
                            <div class="modal fade" id="del<?=$showrc['id']?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3>تأكيد الحذف</h3>
                                        </div>
                                        <div class="modal-body modal-body-sub_agile">
                                            <div class="modal_body_left modal_body_left1">
                                                <h3 id="dmsg<?=$showrc['id']?>">
                                                    هل أنت متأكد من أنك تريد  حذف هذا  البانر ؟
                                                </h3>
                                                <button class="btn btn-danger" onclick="del('baners','<?=$showrc[id]?>')">حذف</button>
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