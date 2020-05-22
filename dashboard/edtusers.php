<?php
include 'header.php';
$uid = addslashes(htmlspecialchars($_GET['edit']));
$q   = "SELECT * FROM `users` WHERE `id` = '$uid'";
$smd = $engine->connect()->query($q);
$show = $smd->fetch_array();
$engine->permissions(1,1,0,0);
?>
        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> تعديل الحساب
                        <small>تعديل الاسم , البريد الإلكتروني ,كلمة السر , الرصيد والحالة</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" name="edt-profile" novalidate>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الاسم</label>
                                <input type="text" name="name" data-validate-length-range="6" data-validate-words="2" required="required" value="<?=$show['name']?>" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>البريد الإلكتروني</label>
                                <input type="email" name="mail" id="email" required="required" value="<?=$show['mail']?>" class="form-control col-md-12 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>كلمة المرور</label>
                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>تأكيد كلمة المرور</label>
                                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                        </div>
                        <?if($show['rank'] == 0){?>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الرصيد</label>
                                <input type="text" name="balance" value="<?=$show['balance']?>" class="form-control col-md-12 col-xs-12" required="required">
                                <small>(<?=DCRC?>)</small>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>الحالة</label>
                                <select name="active" class="form-control">
                                    <option value="0" <?if($show['active'] == 0){echo "selected";}?>>غير مُفعل</option>
                                    <option value="1" <?if($show['active'] == 1){echo "selected";}?>>مُفعل</option>
                                </select>
                            </div>
                            <input type="hidden" name="ratio" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                            </div>
                        </div>
                        <?}
                        else if($show['rank'] == 2){?>
                        <div class="form-group col-md-12">
                            <input type="hidden" name="active" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                            <input type="hidden" name="text" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                            <input type="hidden" name="ratio" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                            </div>
                        </div>   
                        <?}else{?>
                        <div class="form-group col-md-12">
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>الرصيد</label>
                                <input type="text" name="balance" value="<?=$show['balance']?>" class="form-control col-md-12 col-xs-12" required="required">
                                <small>(<?=DCRC?>)</small>
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>الحالة</label>
                                <select name="active" class="form-control">
                                    <option value="0" <?if($show['active'] == 0){echo "selected";}?>>غير مُفعل</option>
                                    <option value="1" <?if($show['active'] == 1){echo "selected";}?>>مُفعل</option>
                                </select>
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>نسبة التاجر</label>
                                <input type="text" name="ratio" required="required" class="form-control col-md-12 col-xs-12" autocomplete="off">
                                <ul id="show_names"></ul>
                            </div>
                        </div>
                        <?}?>
                        <center id="msg"></center>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="edt_user('<?=$show[id]?>')" class="btn btn-primary">حفظ</button>
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