<?php
include '../core.php';
$engine->checklogin();
if(isset($_POST['sout']))
{
   $engine->logout($_POST['sout']);
}
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
    <title><?=S_NAME?>! | لوحة التحكم</title>
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
    <!-- bootstrap-datetimepicker -->
    <link href="assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/vendors/summernote/summernote-bs4.css">
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Custom styles for this template -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- ajax -->
    <script src="assets/build/js/ajax.js"></script>

</head>
<!-- /header content -->
<body class="nav-md" onload="notfs('notf_num') , notfs('msg_num')">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col hidden-print">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="../home" class="site_title"><i class="fa fa-arrow-circle-right"></i> <span><?=S_NAME?>!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?=USER_IMG?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>
                            <?php
                            if(USER_RANK == 1)
                            {
                                echo "المدير";
                            }
                            else if(USER_RANK == 2)
                            {
                                echo "مشرف";
                            }
                            else if(USER_RANK == 3)
                            {
                                echo "تاجر";
                            }
                            else if(USER_RANK == 0)
                            {
                                echo "مُشتري";
                            }
                            ?>
                        </span>
                        <h2><?=USER_NAME?></h2>
                        <?if(USER_RANK ==3){?>
                        <label>الرصيد  : <?=USER_BALANCE?></label>
                        <?}?>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li>
                                <a href="../dashboard/home">
                                    <i class="fa fa-home"></i> الرئيسية
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-user"></i> البيانات الشخصية <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li><a href="profile">المعلومات الرئيسية</a></li>
                                    <?if(USER_RANK == 3){?>
                                    <li><a href="balance">الرصيد</a></li>
                                    <li><a href="addresses">العناوين</a></li>
                                    <?}?>
                                </ul>
                            </li>
                            <?if(USER_RANK == 2 || USER_RANK == 1){?>
                            <li>
                                <a>
                                    <i class="fa fa-cogs"></i> الاعدادات <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <?if(USER_RANK == 1){?>
                                    <li><a href="ssettings">إعدادات الموقع</a></li>
                                    <li><a href="moderators">الإداريين</a></li>
                                    <li><a href="sliders">السلايدر</a></li>
                                    <li><a href="sections">الأقسام</a></li>
                                    <li><a href="sub_sections">الأقسام الفرعية</a></li>
                                    <li><a href="cities">المدن</a></li>
                                    <li><a href="merchants">التُجار</a></li>
                                    <li><a href="sponsers">الرُعاة</a></li> 
                                    <?}?>
                                    <li><a href="users">المشترون</a></li>
                                    <li><a href="companies">الشركات والفروع</a></li>
                                </ul>
                            </li>
                            <?}?>
                            <li>
                                <a>
                                    <i class="fa fa-clone"></i> الفاوتشرات <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <?if(USER_RANK == 1 || USER_RANK == 3 || USER_RANK == 2){?>
                                    <li><a href="add_offers">إضافة فاوتشرات</a></li> 
                                    <!-- <li><a href="add_24">إضافة صفقات 24 ساعة</a></li> 
                                    <li><a href="all_24">صفقات 24 ساعة</a></li>  -->
                                    <li><a href="offers">الفاوتشرات</a></li>
                                    <li><a href="all_receipts">الفواتير</a></li>
                                    <?}?>
                                    <!--li><a href="track_products">تتبع الفاوتشرات</a></li-->
                                    <?if(USER_RANK != 3){?>
                                    <li><a href="my_purchases">المشتريات</a></li> 
                                    <?}?>
                                </ul>
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-align-right"></i> المقالات <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li><a href="blog_sections">الأقسام الرئيسية</a></li> 
                                    <li><a href="blog_ssections">الأقسام الفرعية</a></li>
                                    <li><a href="blogs">المقالات</a></li>
                                </ul>
                            </li>
                            <?if(USER_RANK == 1){?>
                            <li>
                                <a>
                                    <i class="fa fa-align-center"></i> الأقسام التعريفية <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <!-- <li><a href="ads">الإعلان</a></li>  -->
                                    <li><a href="about">من نحن</a></li> 
                                    <li><a href="word">كلمة رئيس الجمعية</a></li> 
                                    <li><a href="contact">تواصل معنا</a></li> 
                                    <li><a href="terms">الشروط والأحكام</a></li> 
                                    <li><a href="privacy">سياسة الاستخدام</a></li> 
                                    <!-- <li><a href="inner_baner">البنر الداخلي</a></li> 
                                    <li><a href="employee">التوظيف</a></li> 
                                    <li><a href="sub_merch">اشتراك التجار</a></li>  -->
                                </ul>
                            </li>
                            <?}if(USER_RANK == 1 || USER_RANK == 2){?>
                            <li>
                                <a>
                                    <i class="fa fa-edit"></i> المراجعات <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li><a href="comments">التعليقات</a></li>
                                    <li><a href="pending_offers">الفاوتشرات</a></li>
                                    <li><a href="pending_accounts">حسابات التجار</a></li>
                                    <?if(USER_RANK == 1){?>
                                    <li><a href="pending_trans">طلبات سحب الرصيد</a></li>
                                    <?}?>
                                </ul>
                            </li>
                            <?}?>
                            <?if(USER_RANK == 1 || USER_RANK == 2 || USER_RANK == 3){?>
                            <li>
                                <a>
                                    <i class="fa fa-inbox"></i> رسائل و شكاوي <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <?if(USER_RANK == 1 || USER_RANK == 2){?>
                                    <li><a href="messages">الرسائل</a></li>
                                    <?}?>
                                    <li><a href="reports">الشكاوي</a></li>
                                    <!-- <li><a href="back">طلبات الإرجاع</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-bar-chart-o"></i>احصائيات<span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li><a href="searches">كلمات البحث</a></li>
                                    <li><a href="sales">مبيعات</a></li>
                                    <li><a href="bestsales">الأكثر مبيعاً</a></li>
                                    <li><a href="visits">الأكثر  مشاهدة</a></li>
                                    <li><a href="closedsales">المبيعات المغلقة</a></li>
                                </ul>
                            </li>
                            <?}?>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <?if(USER_RANK == 1){?>
                    <a href="ssettings" data-toggle="tooltip" data-placement="top" title="إعدادات الموقع">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <?}
                    if(USER_RANK != 1){?>
                        <a href="profile" data-toggle="tooltip" data-placement="top" title="إعدادات  الحساب">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <?}?>
                    <a data-toggle="tooltip" data-placement="top" title="تكبير الصفحة" onclick="toggleFullScreen();">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="قفل الشاشة" class="lock_btn">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <form action="" method="post">
                        <input type="hidden" name="sout">
                        <button type="submit" name="logout" class="sout" data-toggle="tooltip" data-placement="top" title="تسجيل الخروج">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav hidden-print">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="<?=USER_IMG?>" alt=""> <?=USER_NAME?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="../home">العودة للموقع</a>
                                </li>
                                <li>
                                    <form action="" method="post">
                                        <input type="hidden" name="sout">
                                        <button type="submit" class="sign-out" name="logout">
                                            <i class="fa fa-sign-out pull-right"></i>تسجيل الخروج
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" onclick="notfs('show_notf')" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-tags"></i>
                                <span class="badge bg-green" id="notf_num"></span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <div id="show_notf">
                                
                                </div> 
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>مشاهدة كل الإشعارات</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" onclick="notfs('show_msg')" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="badge bg-green" id="msg_num"></span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <div id="show_msg">
                                
                                </div> 
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>مشاهدة كل الرسائل</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- /header content -->