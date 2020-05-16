<?php
include '../core.php';
$engine->havesession();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title><?=S_NAME?>! | تسجيل الدخول</title>

    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">
    <link href="assets/build/css/style.css" rel="stylesheet"> 
    <!-- ajax -->
    <script src="assets/build/js/ajax.js"></script>
</head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <a class="hiddenanchor" id="reset"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form name="signin">
              <h1>تسجيل الدخول</h1>
              <div id="lmsg"></div>
              <div>
                <input type="text" class="form-control" name="mail" placeholder="البريد الإلكتروني" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="كلمة المرور" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" onclick="login()">تسجيل دخول</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-arrow-circle-right"></i> <?=S_NAME?>!</h1>
                  <p>©<?=date('Y')?> جميع الحقوق محفوظة</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>ایجاد حساب</h1>
              <div>
                <input type="text" class="form-control" placeholder="نام کاربری" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="ایمیل" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="رمز ورود" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">ارسال</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">در حال حاضر عضو هستید؟
                  <a href="#signin" class="to_register"> ورود </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©1397 تمامی حقوق محفوظ. Gentelella Alela! یک قالب بوت استرپ 3. حریم خصوصی و شرایط</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        <div id="rest_pass" class="animate form rest_pass_form">
          <section class="login_content">
            <!-- /password recovery -->
            <form action="index.html">
              <h1>بازیابی رمز عبور</h1>
              <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="ایمیل" />
                <div class="form-control-feedback">
                  <i class="fa fa-envelope-o text-muted"></i>
                </div>
              </div>
              <button type="submit" class="btn btn-default btn-block">بازیابی رمز عبور </button>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">جدید در سایت؟
                  <a href="#signup" class="to_register"> ایجاد حساب </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©1397 تمامی حقوق محفوظ. Gentelella Alela! یک قالب بوت استرپ 3. حریم خصوصی و شرایط</p>
                </div>
              </div>
            </form>
            <!-- Password recovery -->
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
