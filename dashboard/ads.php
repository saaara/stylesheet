<?php
include 'header.php';
$engine->permissions(1,1,1,0);
?>
        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>الإعلان
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" name="add-ad">
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>الإعلان</label>
                                <?php 
                                $g_ad  = $engine->connect()->query("SELECT * FROM `ads`");
                                $show_ad = $g_ad->fetch_array();
                                $show  = 'ads';
                                $txt   = htmlspecialchars_decode($show_ad['ad']);
                                include '../editor.php';?>
                            </div>
                        </div>
                    </form> 
                    <div class="col-md-12" id="msg"></div>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="add_ad('add','add_ad')" class="btn btn-primary">إضافة</button>
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