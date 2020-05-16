<?php 
  $conect = mysqli_connect( DB_SERVER , DB_ADMIN , DB_PASSW ); 
  $sdb    = mysqli_select_db($conect, DB_NAME );
  if(isset($_POST['admsave']))
  {
  	$email    = strip_tags(strtolower(htmlspecialchars(addslashes($_POST['adminmail'])))); 
    $name     = strip_tags(strtolower(htmlspecialchars(addslashes($_POST['adminname'])))); 
    $password = strip_tags(htmlspecialchars(addslashes($_POST['adminpass']))) ;
    $repassword = strip_tags(htmlspecialchars(addslashes($_POST['readminpass']))) ;
    $file1    = "../uploads";
    $upl1     = "admup";
    if($password == $repassword)
    {
      adminsett($file1,$upl1,$name,$email,$password);
    }
    else
    {
      echo "عفواً يجب أن يكونا كلمتي السر متطابقتين";
    }
    
  }
?>	
                   
<div class="text-center cntnr col-md-12">
  <form method="post" action="index.php?step=admin_info" enctype="multipart/form-data">
    <div class="form-group col-md-12">
      <div class="col-md-6">
        <label>البريد الإلكتروني</label>
        <input type="email"  class="form-control" placeholder="البريد الإلكتروني" name="adminmail" required/>
      </div>
      <div class="col-md-6">
        <label>اسم المدير</label>
        <input type="text" class="form-control" name="adminname" placeholder="اسم المدير" required />
      </div>
    </div> 

    <div class="form-group col-md-12">
      <div class="col-md-6">
        <label>تأكيد كلمة السر</label>
        <input type="password"  class="form-control" name="readminpass" placeholder="تأكيد الرقم السري" required />
      </div>
      <div class="col-md-6">
        <label>كلمة السر</label>
        <input type="password"  class="form-control" name="adminpass" placeholder="الرقم السري" required />
      </div>
    </div>

    <div class="form-group col-md-12">
      <div class="col-md-12">
        <button type="submit" name="admsave" class="btn praim-btn">تأكيد وفحص السيرفر والملفات</button>
      </div>
    </div>
</div>
</form>
<!-- /.tab-pane -->
<!-- /.tab-content -->
</div>