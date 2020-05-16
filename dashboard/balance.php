<?php
include 'header.php';
$engine->permissions(0,0,1,0);
?>        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> الرصيد
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <div class="col-md-6">
                        <h1>رصيد مُتاح</h1>
                        <h3><?=USER_BALANCE .' '. DCRC?></h3>
                        <p>عند طلب تحويل الرصيد لبطاقتك الائتمانية أو بايبال يتم تعليق الطلب لمدة 24 ساعة  للمراجعة</p>
                    </div>
                    <div class="col-md-6">
                        <h1>رصيد  مُعلق</h1>
                        <h3><?=USER_PBALANCE .' '. DCRC?></h3>
                        <p>يتم تحويل الرصيد المُعلق إلى رصيدك المتاح بعد تسليم المنتجات التي قمت بيعها</p>
                    </div>
                </div>
            </div>
        </div>

        <!--withdraw money-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>سحب الأموال
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display:none;">
                      <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#paypal" aria-controls="home" role="tab" data-toggle="tab">بايبال</a>
                        </li>
                        <li role="presentation">
                            <a href="#bank" aria-controls="profile" role="tab" data-toggle="tab">حساب بنكي</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="paypal">
                            <form name="pwithdraw">
                                <div class="form-group col-md-12">
                                    <div class="col-md-6">
                                        <label>حسابك في بايبال</label>
                                        <input type="txt" class="form-control" name="mail" placeholder="البريد الإلكتروني">
                                    </div>
                                    <div class="col-md-6">
                                        <label>المبلغ</label>
                                        <input type="txt" class="form-control" name="amount" placeholder="120...">
                                    </div>
                                </div>
                            </form>
                            <div class="form-group col-md-12">
                                <div class="col-md-4">
                                    <br/>
                                    <button class="btn btn-primary" onclick="p_withdraw()">إرسال</button>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="bank">
                            <form name="bwithdraw">
                                <div class="form-group col-md-12">
                                    <div class="col-md-6">
                                        <label>اسم صاحب الحساب</label>
                                        <input type="txt" class="form-control" name="name" placeholder="باللغة العربية">
                                    </div>
                                    <div class="col-md-6">
                                        <label>القيمة</label>
                                        <input type="txt" class="form-control" name="amount" placeholder="120...">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-6">
                                        <label>رقم الحساب</label>
                                        <input type="txt" class="form-control" name="account" placeholder="رقم حسابك البنكي">
                                    </div>
                                    <div class="col-md-6">
                                        <label>اسم البنك والفرع</label>
                                        <input type="txt" class="form-control" name="bname" placeholder="الاسم والفرع">
                                    </div>
                                </div>
                            </form>
                            <div class="form-group col-md-12">
                                <button class="btn btn-primary" onclick="b_withdraw()">إرسال</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="msg"></div>
                </div>
            </div>
        </div>

        <!--transactions-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المعاملات المالية
                        <small>جميع المعاملات المالية الخاصة بك</small>
                    </h2><br/>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display:none;">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <tbody>
                            <?
                            $uid = USER_ID;
                            $q = "SELECT * FROM `trans` WHERE (`status` = 1 AND `uid` = '$uid')";
                            $smdrc = $engine->connect()->query($q);
                            while ($showrc = $smdrc->fetch_array())
                            {
                            $pid    = $showrc['pid'];
                            $uid    = $showrc['uid'];
                            $qp    = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
                            $showp = $qp->fetch_array();
                            if($showrc['type'] == 'in'){
                            ?>
                            <tr>
                                <th style="color:green;">
                                    +<?=$showrc['val']?> <?=DCRC?>
                                </th>
                                <th>
                                    <?=$showrc['title']?> <a href="../<?=$showp['pid']?>"><?=$showp['name']?></a>
                                </th>
                                <th><?=counttime($showrc['date']);?></th>
                            </tr>
                            <?}
                            if($showrc['type'] == 'out'){?>
                            <tr>
                                <th style="color:red;">
                                    -<?=$showrc['val']?> <?=DCRC?>
                                </th>
                                <th>
                                    <?=$showrc['title']?> #<?=$showrc['trans']?></a>
                                </th>
                                <th><?=counttime($showrc['date']);?></th>
                            </tr>
                            <?}}?>
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