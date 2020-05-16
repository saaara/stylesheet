<?php
include 'header.php';
$engine->permissions(1,1,0,0);
?>     
<!-- page content -->
<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>الرسائل
                    <small>جميع الرسائل الواردة</small>
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-3 mail_list_column">
                                <button id="compose" class="btn btn-sm btn-success btn-block" type="button"> رسالة جديدة
                                </button>
                                <?php
                                $q = "SELECT * FROM `messages`";
                                $smd = $engine->connect()->query($q);
                                while ($show = $smd->fetch_array()) {?>
                                <a href="?message=<?=$show['id']?>">
                                    <div class="mail_list <?if($show['status'] == 0){?>active<?}?>">
                                        <div class="right">
                                            <?if($show['status'] == 0){?>
                                                <i class="fa fa-circle"></i>
                                            <?}?>
                                            <?if($show['status'] == 1){?>
                                                <i class="fa fa-circle-o"></i>
                                            <?}?>
                                        </div>
                                        <div class="left">
                                            <h3><?=$show['name']?>
                                                <small><?=counttime($show['date']);?></small>
                                            </h3>
                                            <p><?=$show['subject']?></p>
                                        </div>
                                    </div>
                                </a>
                                <?}?>
                            </div>
                            <!-- /MAIL LIST -->
                            <?php
                            $mid  = $_GET['message'];
                            if(isset($mid)){
                                $qm    = "SELECT * FROM `messages` WHERE `id` = '$mid'";
                                $smdm  = $engine->connect()->query($qm);
                                $showm = $smdm->fetch_array();
                                $qup   = $engine->connect()->query("UPDATE `messages` SET `status` = 1 WHERE `id` = '$mid'");
                            ?>
                            <!-- CONTENT MAIL -->
                            <div class="col-sm-9 mail_view" id="messages<?=$mid?>">
                                <div class="inbox-body">
                                    <div class="mail_heading row">
                                        <div class="col-md-8">
                                            <div class="btn-group">
                                                <button class="btn btn-danger btn-flat" data-placement="top" data-toggle="tooltip"data-original-title="حذف" onclick="del('messages','<?=$mid?>')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-left">
                                            <p class="date"><?=counttime($showm['date']);?></p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4><?=$showm['subject']?></h4>
                                        </div>
                                    </div>
                                    <div class="sender-info">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong class="col-md-6"><?=$showm['name']?></strong>
                                                <a href="" class="col-md-6 text-left"><?=$showm['mail']?></a><hr/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-mail">
                                        <p>
                                            <?=$showm['message']?>
                                        </p><hr/>
                                    </div>
                                </div>

                            </div>
                            <!-- /CONTENT MAIL -->
                            <?}
                            else if(!isset($mid)){?>
                            <div class="col-sm-9 mail_view" style="padding-top: 50px;">
                                <center>اضغط على الرسالة التي تريد عرضها من الشريط الجانبي</center>
                            </div>
                            <?}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- compose -->
<div class="compose col-md-6 col-xs-12">
    <div class="compose-header">
        إرسال رسالة
        <button type="button" class="close compose-close">
            <span>×</span>
        </button>
    </div>

    <div class="compose-body">
        <div id="alerts"></div>
        <div class="col-md-14 form-group">
            <input type="text" class="form-control" placeholder="البريد الإلكتروني" name="">
        </div>
        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b
                        class="caret"></b></a>
                <ul class="dropdown-menu">
                </ul>
            </div>

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                        class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a data-edit="fontSize 5">
                            <p style="font-size:17px">كبير</p>
                        </a>
                    </li>
                    <li>
                        <a data-edit="fontSize 3">
                            <p style="font-size:14px">متوسط</p>
                        </a>
                    </li>
                    <li>
                        <a data-edit="fontSize 1">
                            <p style="font-size:11px">صغير</p>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="insertunorderedlist" title="لیست نقطه‌ای"><i class="fa fa-list-ul"></i></a>
                <a class="btn" data-edit="insertorderedlist" title="لیست عددی"><i class="fa fa-list-ol"></i></a>
                <a class="btn" data-edit="outdent" title="کاهش دندانه (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                <a class="btn" data-edit="indent" title="دندانه (Tab)"><i class="fa fa-indent"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="justifyleft" title="چپ چین (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                <a class="btn" data-edit="justifycenter" title="وسط چین (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                <a class="btn" data-edit="justifyright" title="راست چین (Ctrl/Cmd+R)"><i
                        class="fa fa-align-right"></i></a>
                <a class="btn" data-edit="justifyfull" title="جاستیفای (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="لینک عظیم"><i class="fa fa-link"></i></a>
                <div class="dropdown-menu input-append">
                    <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                    <button class="btn" type="button">افزودن</button>
                </div>
                <a class="btn" data-edit="unlink" title="حذف لینک عظیم"><i class="fa fa-cut"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" title="افزودن تصویر (ویا فقط بکشید و رها کنید)" id="pictureBtn"><i
                        class="fa fa-picture-o"></i></a>
                <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage"/>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="undo" title="لغو عمل قبلی (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                <a class="btn" data-edit="redo" title="بازگردانی عمل لغو شده (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
            </div>
        </div>

        <div id="editor" class="editor-wrapper"></div>
    </div>

    <div class="compose-footer">
        <button id="send" class="btn btn-sm btn-success" type="button">ارسال</button>
    </div>
</div>
<!-- /compose -->
<!-- /page content -->

<!--footer-->
<?include 'footer.php';?>
<!-- bootstrap-wysiwyg -->
<script src="assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="assets/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="assets/vendors/google-code-prettify/src/prettify.js"></script>