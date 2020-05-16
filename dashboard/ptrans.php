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
                    <h2> طلبات سحب الرصيد
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
                            <th>المستخدم</th>
                            <th>طريقة السحب</th>
                            <th>الحساب</th>
                            <th>المبلغ</th>
                            <th>التاريخ</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = "SELECT * FROM `withdraw` WHERE `status` = 0";
                            $smdrc = $engine->connect()->query($q);
                            while ($showrc = $smdrc->fetch_array())
                            {
                                $uid    = $showrc['uid'];
                                $qu1    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
                                $showu1 = $qu1->fetch_array();
                            ?>
                            <tr id="withdraw<?=$showrc['id']?>">
                                <th>
                                    <a href="users#<?=$showu1['id']?>" target="_blank"><?=$showu1['name']?></a>
                                </th>
                                <th>
                                    <?php
                                    if($showrc['type'] == 'paypal'){echo"بايبال";}
                                    else{echo "تحويل بنكي";}
                                    ?>    
                                </th>
                                <th>
                                    <?php
                                        if($showrc['type'] == 'paypal')
                                        {
                                            echo "البريد الإلكتروني : ".$showrc['mail'];
                                        }
                                        else
                                        {
                                            echo "الاسم : " .$showrc['name'].'<br/>'
                                            ."الحساب : ". $showrc['account'].'<br/>'
                                            ."البنك والفرع : ". $showrc['bname'];
                                        }
                                    ?>    
                                </th>
                                <th><?=$showrc['val'] . DCRC;?></th>
                                <th><?=counttime($showrc['date']);?></th>
                                <th>
                                    <button class="btn btn-danger btn-flat" onclick="del('comments','<?=$showrc[id]?>')"><i class="fa fa-trash"></i></button>
                                    <a onclick="acc_comm('<?=$showrc[id]?>')" class="btn btn-success btn-flat"><i class="fa fa-check"></i></a>
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
<script src="assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="assets/vendors/jszip/dist/jszip.min.js"></script>
<script src="assets/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/vendors/pdfmake/build/vfs_fonts.js"></script>