<?php
include 'header.php';
$engine->permissions(1,0,0,0);
$id    = $_GET['edit'];
$q     = $engine->connect()->query("SELECT * FROM `ssections` WHERE `id` = '$id'");
$show  = $q->fetch_array();
?>         
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> الأقسام الفرعية
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
                                <label>القسم الرئيسي</label>
                                <select name="msec" class="form-control">
                                    <option value="<?=$show['msec']?>"><?=$show['msec']?></option>
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
                                <button class="btn btn-primary" onclick="add_subsection('update','<?=$id?>')">تعديل</button>
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