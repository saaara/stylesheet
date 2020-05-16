<?php 
    $chav = mysqli_query($con,"SELECT * FROM `users` ");
		$exsists = mysqli_num_rows($chav);
    $step4="http://".$_SERVER['SERVER_NAME']."/install/index.php?step=finish";
		if($exsists >= 1)
		{
			echo "<div class='alert alert-danger alert-dismissible col-md-12'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-ban'></i> تحذير </h4>
                          معلومات المدير موجودة بالفعل بقاعدة البيانات هل تريد تحديث هذه البيانات <br /> أو الانتقال للخطوة الأخيرة مباشرة <br /> <a href='$step4' class='btn  btn-danger'> الانتقال للخطوة الأخيرة </a>
               			 </div>";
		}
    
    if(isset($_POST['sitesave']))
	{
		$file = '../uploads';
		$upl = "siteicon";
		$upl2 = "sitelogo";

		if(!empty($upl)&&!empty($_POST['sitename'])&& !empty($_POST['siteurl']) && !empty($_POST['sitekwords']) && !empty($_POST['sitedesc']) && !empty($upl2))
		{
			sitesettings($file,$upl,$_POST['sitename'],$_POST['siteurl'],$_POST['sitekwords'],$_POST['sitedesc'],$upl2);
		}
		else
		{
			echo"عفواً لا يجب ترك أي حقل فارغاً";
		}
		
	}
?>
<div class="text-center cntnr col-md-12">
  <form method="post" action="index.php?step=info" enctype="multipart/form-data">
    <div class="form-group col-md-12">
      <div class="col-md-6">
        <label>رابط الموقع</label>
        <input type="text" class="form-control"  name="siteurl" placeholder="رابط الموقع" required/>
        <small>الرابط بدون http و https أو www</small>
      </div>
      <div class="col-md-6">
        <label>اسم الموقع</label>
        <input type="text"  class="form-control" name="sitename" placeholder="اسم الموقع" required />
      </div>
    </div>
  
    <div class="form-group col-md-12"> 
      <div class="col-md-6">
        <label>الكلمات الدليلية</label>
        <input type="text" class="form-control"  name="sitekwords" placeholder="الكلمات الدلالية للموقع" required />
        <small>افصل بين الكلمات ب   فاصلة </small>
      </div>
      <div class="col-md-6">
        <label>وصف الموقع</label>
        <textarea class="form-control" style="height:35px;" name="sitedesc" placeholder="وصف الموقع" required></textarea>
      </div>
    </div>
  
    <div class="form-group col-md-12">
      <div class="col-md-6">
        <div class="btn btn-default btn-file">
          <i class="fa fa-paperclip"></i> أيقونة الموقع
          <input type="file" name="siteicon" required/>
        </div>
      </div>
      <div class="col-md-6">
        <div class="btn btn-default btn-file">
          <i class="fa fa-paperclip"></i>صورة الموقع
          <input type="file" name="sitelogo" required/>
        </div>
      </div>
    </div>
    <div class="form-group col-md-12">
      <div class="col-md-12 text-center">
        <button type="submit" name="sitesave" class="btn praim-btn">المراجعة والحفظ</button>
      </div>
    </div>  

  </form>
</div>