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
                    <h2> عناوين الشحن
                        <small>يمكنك تحديد العنوان الرئيسي للشحن</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" name="add1" novalidate>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الدولة</label>
                                <select id="heard" name="country" class="form-control" onchange="getcity()" required>
                                    <option>اختر الدولة</option>
                                    <option value="المملكة العربية السعودية">المملكة العربية السعودية</option>
                                    <option value="البحرين">البحرين</option>
                                    <option value="الإمارات">الإمارات</option>
                                    <option value="الكويت">الكويت</option>
                                    <option value="عمان">عمان</option>
                                </select>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12" id="city">
                                <label>المدينة</label>
                                <select  id="heard" class="form-control" required>
                                    <option>اختر الدولة أولا</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>العنوان</label>
                                <input type="text" name="addr" required="required" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>رقم الهاتف</label>
                                <input type="text" data-validate-length-range="8" data-validate-words="1" required="required" name="phone" class="form-control col-md-12 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12">
                                <hr/>
                                <select class="form-control" name="main">
                                    <option value="0">عنوان شحن فرعي</option>
                                    <option value="1">عنوان شحن  رئيسي</option>
                                </select>
                                <small>عنوان الشحن الرئيسي سيتم استخدامه في حالة عملية إتمام الشراء</small>
                            </div>
                        </div>
                        <div class="col-md-12" id="msg"></div>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="add_address()" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--my addresses-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>عناويني
                        <small>جميع العناوين التي قمت بإضافتها</small>
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display:none;">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>الدولة</th>
                            <th>المدينة</th>
                            <th>العنوان</th>
                            <th>الهاتف</th>
                            <th>التصنيف</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $uid = USER_ID;
                        $q = "SELECT * FROM `addresses` WHERE `user` = '$uid'";
                        $smd = $engine->connect()->query($q);
                        while ($show = $smd->fetch_array()) {?>
                        <tr id="addresses<?=$show['id']?>">
                            <th><?=$show['country']?></th>
                            <th><?=$show['city']?></th>
                            <th><?=$show['address']?></th>
                            <th><?=$show['phone']?></th>
                            <th>
                                <?if($show['main'] == 1)
                                {
                                    echo "العنوان الرئيسي";
                                }
                                else 
                                {
                                    echo "عنوان فرعي";
                                }
                                ?>
                            </th>
                            <th>
                                <button class="btn btn-danger btn-flat" onclick="del('addresses','<?=$show[id]?>')"><i class="fa fa-trash"></i></button>
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