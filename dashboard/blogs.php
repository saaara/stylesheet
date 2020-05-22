<?php
include 'header.php';
$engine->permissions(1,0,0,0);
?>         
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المقالات
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                    <form name="form">
                        <div class="form-group col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>العنوان</label>
                                <input type="text" name="name" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>القسم</label>
                                <select name="sec" class="form-control">
                                    <?php
                                    $q = "SELECT * FROM `blog_sections` WHERE `type` = 'sub'";
                                    $smd = $engine->connect()->query($q);
                                    while($show = $smd->fetch_array()){?>
                                    ?>
                                    <option value="<?=$show['name']?>"><?=$show['name']?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>المقال</label>
                                <textarea class="textarea" name="desc" placeholder="أدخل النص هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>الصورة</label>
                                <div class="col-md-12 row">
                                    <div class=" col-md-8">
                                        <div id="err1"></div>
                                        <div id="msg1"></div>      
                                    </div>
                                    <div class="btn p-type btn-file col-md-4">
                                        <i class="fa fa-paperclip"></i> اختر صور
                                        <input type="file" id="pimg1"  name="files1[]" multiple onchange="upload_baner()"/>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="msg"></div>
                            <div class="col-md-12 row">
                                <button class="btn btn-primary" onclick="add_news('add')">إضافة</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="msg"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12" id="divcont">
            <div class="x_panel" id="cont">
                <div class="x_title">
                    <h2>جميع  المقالات
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
                            <th>الصورة</th>
                            <th>العنوان</th>
                            <th>القسم</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?
                            $qrc = "SELECT * FROM `news` ORDER BY `date` DESC";
                            $smdrc = $engine->connect()->query($qrc);
                            while ($showrc = $smdrc->fetch_array())
                            {?>
                            <tr id="ssections<?=$showrc['id']?>">
                                <th><img class="circle" style="width:110px;" src="<?=$showrc['img']?>"/></th>
                                <th><?=$showrc['title']?></th>
                                <th><?=$showrc['section']?></th>
                                <th>
                                    <button class="btn btn-danger btn-flat" onclick="del('news','<?=$showrc[id]?>')"><i class="fa fa-trash"></i>
                                    </button>
                                    <a href="blogs_edit?edit=<?=$showrc['id']?>" class="btn btn-success btn-flat"><i class="fa fa-edit"></i></a>
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
<!-- Summernote -->
<script src="assets/vendors/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>