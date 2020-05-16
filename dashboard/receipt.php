<?php
include '../core.php';
$engine->permissions(1,1,1,0);
$rid = $_GET['rid'];
$qru = $engine->connect()->query("SELECT * FROM `sales` WHERE `receipt` = '$rid'");
$showru = $qru->fetch_array();
$uid    = $showru['buyer'];
$qu     = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
$showu  = $qu->fetch_array();
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="direction: rtl;">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>التاريخ : <?=date('Y-m-d');?></em>
                    </p>
                    <p>
                        <em>رقم  الفاتورة : #<?=$rid?></em>
                    </p>
                    <p>
                        <em>الاسم : <?=$showu['name']?></em>
                    </p>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <img src="<?=S_IMG?>" style="width:70px; height:50px;";/><br/>
                        <p><strong><?=S_NAME?></strong></p>
                        <p><?=S_PHONE?></p>
                        <p><?=S_MAIL?></p>
                        
                    </address>
                </div>
            </div>
            <!--receipt-->
            <div class="row" style="border-bottom:1px dashed #444; padding-bottom: 30px;">
                <div class="text-center">
                    <h1>الفاتورة</h1>
                </div>
                </span>
                <table class="table table-hover text-right" >
                    <thead>
                        <tr>
                            <td><b>المنتج </b></td>
                            <th class="text-center">السعر</td>
                            <th class="text-center">السعر النهائي</td>
                            <th class="text-center">الكمية</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $qr = $engine->connect()->query("SELECT * FROM `sales` WHERE `receipt` = '$rid'");
                        while($showr = $qr->fetch_array()){
                            $pid = $showr['pid'];
                            $qp  = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
                            $nm  = $qp->num_rows;
                            if($nm <= 0)
                            {
                                $qp  = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
                            }
                            $showp = $qp->fetch_array();
                            $total = $total+$showp['newprice']*$showr['q'];
                            ?>
                            <tr>
                                <td class="col-md-6"><em><?=$showp['name']?></em></h4></td>
                                <td class="col-md-2 text-center"><?=$showp['newprice']. ' '. DCRC?></td>
                                <td class="col-md-2 text-center"><?=$showp['newprice']. ' '. DCRC?></td>
                                <td class="col-md-2 text-center"><?=$showr['q']?></td>
                            </tr>
                        <?}?>
                        <tr>
                            <td colspan="3">
                                <b>السعر الإجمالي</b>
                            </td>
                            <td colspan="1" style="color:#aa2929; font-weight: 600;">
                                <?=$total . ' '.DCRC?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--dlever-->
            <div class="row" style="margin-top: 30px;">
                <div class="text-center">
                    <h1>تفاصيل الشحن</h1>
                </div>
                </span>
                <?php
                $qd = $engine->connect()->query("SELECT * FROM `purchases` WHERE `receipt` = '$rid'");
                $showd = $qd->fetch_array();
                $adr   = $showd['address'];
                $qadr  = $engine->connect()->query("SELECT * FROM `addresses` WHERE `id` = '$adr'");
                $showadr = $qadr->fetch_array();
                ?>
                <table class="table table-hover text-right">
                    <thead>
                        <tr>
                            <td><b>طريقة التوصيل </b></td>
                            <td><b>طريقة الدفع </b></td>
                            <td><b>حالة الدفع </b></td>
                            <td><b>سعر الشحن</b></td>
                            <td><b>السعر الكلي</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-3"><?=$showd['shipping']?></td>
                            <td class="col-md-3"><?=$showd['payment']?></td>
                            <td class="col-md-2"><?=$showd['paystatus']?></td>
                            <td class="col-md-2"><?=$showd['sh_cost']. ' '. DCRC?></td>
                            <td class="col-md-2"><?=$total. ' '. DCRC?></td>
                        </tr>
                    </tbody>
                </table>
                <p><b>الاسم  :</b> <?=$showu['name']?></p>
                <p><b>البلد :</b> <?=$showadr['country']?></p>
                <p><b>المدينة  :</b> <?=$showadr['city']?></p>
                <p><b>عنوان  :</b> <?=$showadr['address']?></p>
                <p><b>الهاتف  :</b> <?=$showadr['phone']?></p>
            </div>
            <button type="button" onclick="window.print()" class="btn btn-success btn-lg btn-block">
                    طباعة الفاتورة   <span class="fa fa-print"></span>
            </button>
        </div>
    </div>