<?php
include 'header.php';
$engine->permissions(1,1,0,0);
?>        
<!-- page content -->
<div class="right_col" role="main" id="divcont">
    <div class="row" id="cont">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المستخدمون
                        <small>مشاهدة وتعديل</small>
                    </h2>
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
                            <th>البريد الإلكتروني</th>
                            <th>الحالة</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $thisid = USER_ID;
                        $q = "SELECT * FROM `users` WHERE (`id` <> '$thisid' AND `rank` = 0)";
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array()) {?>
                        <tr id="users<?=$show['id']?>">
                            <th><?=$show['name']?></th>
                            <th><?=$show['mail']?></th>
                            <th>
                                <?php
                                if($show['active'] == 1)
                                {
                                    echo "مُفعل";
                                }
                                else if($show['acgtive'] == 0)
                                {
                                    echo "غير مُفعل";
                                }
                                ?>
                            </th>
                            <th>
                                <button class="btn btn-danger btn-flat" onclick="del('users','<?=$show[id]?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="edtusers?edit=<?=$show['id']?>" data-placement="top" data-toggle="tooltip"data-original-title="تعديل" class="btn btn-success btn-flat">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#<?=$show['id']?>" class="btn btn-warning btn-flat">
                                    <i class="fa fa-info"></i>
                                </a>
                            </th>
                            <!-- Modal -->
                            <div class="modal fade" id="<?=$show['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">جميع بيانات  <?=$show['name']?></h4>
                                  </div>
                                  <div class="modal-body text-center">
                                        <img class="thump" src="<?=$show['name']?>">
                                        <h3><?=$show['name']?></h3>
                                        <span>مُشتري</span>
                                        <div class="text-right">
                                            <h3>العناوين</h3>
                                            <?php
                                            $uid = $show['id'];
                                            $qad = $engine->connect()->query("SELECT * FROM `addresses` WHERE `user` = '$uid'");
                                            while ($showad = $qad->fetch_array()){?>
                                            <div>
                                                <p>الدولة : <?=$showad['country']?></p>
                                                <p>المدينة : <?=$showad['city']?></p>
                                                <p>العنوان : <?=$showad['address']?></p>
                                                <p>الهاتف : <?=$showad['phone']?></p>
                                            </div><hr/>
                                            <?}?>
                                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
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