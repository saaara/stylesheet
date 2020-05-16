<?php
include 'header.php';
$engine->permissions(1,0,0,0);
?>         
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المدن
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
                                <input type="text" name="name" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>القسم الرئيسي</label>
                                <select name="msec" class="form-control">
                                    <?php
                                    $q = "SELECT * FROM `sections`";
                                    $smd = $engine->connect()->query($q);
                                    while($show = $smd->fetch_array()){?>
                                    ?>
                                    <option value="<?=$show['name']?>"><?=$show['name']?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="msg"></div>
                            <div class="col-md-12 row">
                                <button class="btn btn-primary" onclick="add_subsection('add')">إضافة</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="msg"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>جميع  الأقسام
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
                            <th>الاسم</th>
                            <th>القسم</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?
                            $qrc = "SELECT * FROM `ssections`";
                            $smdrc = $engine->connect()->query($qrc);
                            while ($showrc = $smdrc->fetch_array())
                            {?>
                            <tr id="ssections<?=$showrc['id']?>">
                                <th><?=$showrc['name']?></th>
                                <th><?=$showrc['msec']?></th>
                                <th>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#del<?=$showrc['id']?>"><i class="fa fa-trash"></i>
                                    </button>
                                    <a href="subsec_edit?edit=<?=$showrc['id']?>" class="btn btn-success btn-flat"><i class="fa fa-edit"></i></a>
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
                                                    هل أنت متأكد من أنك تريد  حذف هذا  القسم ؟
                                                </h3>
                                                <button class="btn btn-danger" onclick="del('ssections','<?=$showrc[id]?>')">حذف</button>
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