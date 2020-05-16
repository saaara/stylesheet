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
                    <h2>إضافة  للسلايدر
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
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>العنوان</label>
                                <input type="text" name="name" class="form-control" placeholder="الاسم أو الوصف">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>الرابط التوجيهي</label>
                                <input type="text" name="lnk" class="form-control" placeholder="رابط منتج أو صفحة خارجية">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>صورة البانر </label>
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
                            <button class="btn btn-primary" onclick="add_slider()">إضافة</button>
                        </div>
                    </div> 
                    <div class="col-md-12" id="msg"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12" id="divcont">
            <div class="x_panel" id="cont">
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
                            <th>المكان</th>
                            <th>العنوان</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?
                            $qrc = "SELECT * FROM `slides`";
                            $smdrc = $engine->connect()->query($qrc);
                            while ($showrc = $smdrc->fetch_array())
                            {?>
                            <tr id="slides<?=$showrc['id']?>">
                                <th>
                                    <img src="<?=$showrc['img']?>" style="max-width: 500px;"/>
                                </th>
                                <th><?=$showrc['lnk']?></th>
                                <th>
                                    <?
                                    if($showrc['place'] == 1)
                                    {
                                        echo "اليمين";
                                    }
                                    else if($showrc['place'] == 2)
                                    {
                                        echo "اليسار أعلى";
                                    }
                                    else if($showrc['place'] == 3)
                                    {
                                        echo "اليسار  أسفل اليمين";
                                    }
                                    else if($showrc['place'] == 4)
                                    {
                                        echo "اليسار  أسفل  اليسار";
                                    }
                                    ?>    
                                </th>
                                <th><?=$showrc['name']?></th>
                                <th>
                                    <button class="btn btn-danger btn-flat" onclick="del('slides','<?=$showrc[id]?>')"><i class="fa fa-trash"></i></button>
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