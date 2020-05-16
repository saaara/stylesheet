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
                    <h2> كلمات  البحث
                        <small>أعلى  10 كلمات بحث هذا الإسبوع</small>
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <p>أعلى  10 كلمات بحث هذا الإسبوع</p>
                        <thead>
                        <tr>
                            <th>الكلمة</th>
                            <th>عدد مرات البحث</th>
                            <th>آخر  عملية بحث</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT DISTINCT * FROM `search` ORDER BY `num` DESC LIMIT 10";
                        $smd = $engine->connect()->query($q);
                        while($show = $smd->fetch_array()){?>
                        <tr>
                            <th><?=$show['word']?></th>
                            <th><?=$show['num']?></th>
                            <th><?=counttime($show['date'])?></th>
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