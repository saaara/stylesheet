<?php
include 'header.php';
$id  = $_GET['edit'];
$smd = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$id'");
$show = $smd->fetch_array();
$sedate = date('d-m-Y h:i:s A', strtotime($show['sedate']));
$sdate = date('d-m-Y h:i:s A', strtotime($show['sdate']));
?>
        
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Add merchant
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" name="add_merchant" novalidate>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>name</label>
                                <input type="text" value="<?=$show['name']?>" name="name" data-validate-length-range="6" data-validate-words="2" required="required" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>mail</label>
                                <input type="email" name="mail" value="<?=$show['mail']?>" id="email" required="required" class="form-control col-md-12 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>Password</label>
                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>confirm password</label>
                                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>phone number</label>
                                <input type="text" value="<?=$show['phone']?>" name="phone" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>location</label>
                                <input type="text" name="location" value="<?=$show['location']?>" class="form-control col-md-12 col-xs-12" required="required">
                            </div>
                            <div class="item col-md-4 col-sm-12 col-xs-12">
                                <label>status</label>
                                <select name="active" class="form-control">
                                    <option value="0" <?if($show['active'] == 0){?> selected <?}?>>not active</option>
                                    <option value="1" <?if($show['active'] == 1){?> selected <?}?>>active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>subscribe date</label>
                                <div class=" input-group date">
                                    <input type='text' value="<?=$sdate?>" class="form-control" id='myDatepicker' name="sdate" />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="item col-md-6 col-sm-12 col-xs-12">
                                <label>end date</label>
                                <div class=" input-group date">
                                    <input type='text' value="<?=$sedate?>" class="form-control" id='myDatepicker2' name="sedate" />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center id="msg"></center>
                        </div>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr/>
                            <button onclick="add_user('update','<?=$id?>')" class="btn btn-primary">add merchant</button>
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
<script>
    $('#myDatepicker').datetimepicker();
    $('#myDatepicker2').datetimepicker();
</script>