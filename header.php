<?php 
include 'core.php';
if(isset($_POST['signout']))
{
	$engine->logout($_POST['signout']);
}
$uid = USER_ID;
?>
<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Internet Explorer Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>الرئيسية</title>
		<link rel="icon" href="assets/images/cage.png">

		<link rel="stylesheet" href="assets/css/flaticon.css">
		<link rel="stylesheet" href="assets/css/bootstrap-arabic.css">
		<link rel="stylesheet" href="assets/css/flickity.min.css">
		<link rel="stylesheet" href="assets/css/zoomslider.css">
        <link rel="stylesheet" href="assets/css/all.css">
		<link rel="stylesheet" href="assets/css/style.css">
        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
       	<script src="assets/js/respond.min.js"></script>
        <![endif]-->
	</head>
	<body>
		<div id="divcont">
			<div id="cont">
				<header>
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-sm-2 col-xs-12">
								<a href="home">
									<img src="assets/images/logo-white.png" class="img-responsive logo">
								</a>
							</div>
							<div class="col-lg-9 col-sm-10 col-xs-12">
								
								<!-- Navbar -->
								<nav class="navbar navbar-default">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>

									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
										<ul class="nav navbar-nav">
											<li class="active"><a href="home">الرئيسية <span class="sr-only">(current)</span></a></li>
											<li><a href="offers">العروض</a></li>
											<li class="dropdown">
												<a href="#" data-toggle="dropdown" class="dropdown-toggle">المدونة <span class="caret"></span></a>

												<ul class="dropdown-menu">
													<li>
														<a href="#" data-toggle="dropdown" class="dropdown-toggle">
															<i class="fas fa-caret-right"></i> 
															قالوا عن الزواج
														</a>
														<ul class="dropdown-menu">
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
														</ul>
													</li>
													<li>
														<a href="#" data-toggle="dropdown" class="dropdown-toggle">
															<i class="fas fa-caret-right"></i> 
															شهر العسل
														</a>
														<ul class="dropdown-menu">
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
														</ul>
													</li>
													<li>
														<a href="#" data-toggle="dropdown" class="dropdown-toggle">
															<i class="fas fa-caret-right"></i> 
															قسم أساسي 										
														</a>
														<ul class="dropdown-menu">
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
															<li><a href="blogs-in-sub.html">قسم فرعي</a></li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#" data-toggle="dropdown" class="dropdown-toggle">تعرف علينا <span class="caret"></span></a>

												<ul class="dropdown-menu">
													<li>
														<a href="about-us">من نحن</a>
													</li>
													<li>
														<a href="boss-speech">كلمة الرئيس</a>
													</li>
													<li>
														<a href="printed">الدليل المطبوع</a>
													</li>
													<li>
														<a href="conditions">الشروط والأحكام</a>
													</li>
												</ul>
											</li>
											<li><a href="contact">تواصل معنا</a></li>
										</ul>
									</div>
								</nav>
								<!-- ./Navbar -->


								<div class="book_btn">
									<div class="account">
										<?if($engine->havesession()){?>
										<button>
											<i class="far fa-user-circle"></i> <?=USER_NAME?>
										</button>
										<ul>
											<li>
												<a href="profile">حسابي</a>
											</li>
											<li>
												<a href="my-sells">مشترياتي</a>
											</li>
											<li>
												<a href="favourite">مفضلتي</a>
											</li>
											<li>
												<form method="post">
													<button name="signout" class="logout">تسجيل خروج</button>
												</form>
											</li>
										</ul>
										<?}else{?>
											<button data-toggle="modal" data-target="#exampleModalLong">
												<i class="flaticon-interface"></i> تسجيل الدخول
											</button>
										<?}?>
									</div>

									<!-- Shopping Cart -->  
									<a class="cart-btn">
										<img src="assets/images/icons/cart.svg">
										<span class="number">
											<?php
											$get_num = $engine->get_query("SELECT * FROM `cart` WHERE `uid` = '$uid'");
											echo $get_num->num_rows;
											?>
										</span>
									</a> 
									<div class="cart-block">
										<h2>عربة الشراء</h2>
										<div class="list">
											<?php 
											$total = 0;
											$get_cart = $engine->get_query("SELECT * FROM `cart` WHERE `uid` = '$uid'");
											while($show_cart = $get_cart->fetch_array())
											{
												$pid = $show_cart['pid'];
												$get_product = $engine->get_query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
												$show_product = $get_product->fetch_array();
												$item_total   = $show_product['newprice'] * $show_cart['amount'];
												$total = $total + $item_total;
											?>
											<div class="cart-product">
												<button class="remove"><i class="glyphicon glyphicon-trash"></i> </button>
												<div class="info">
													<a href="offer-details.html">
														<img src="assets/images/zoomslider/01.jpg" class="img-responsive">
													</a>
													<div class="info-block">
														<a href="offer-details.html">
															<p><?=$show_product['name']?></p>
														</a>
														<!-- Star rating -->
														<div class="star-rating">
															<input id="star-5-66" type="radio" name="rating-66" value="star-5" disabled>
															<label for="star-5-66" title="5 stars">
																	<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
															</label>
															<input id="star-4-66" type="radio" name="rating-66" value="star-4"  disabled>
															<label for="star-4-66" title="4 stars">
																	<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
															</label>
															<input id="star-3-66" type="radio" name="rating-66" value="star-3" checked disabled>
															<label for="star-3-66" title="3 stars">
																	<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
															</label>
															<input id="star-2-66" type="radio" name="rating-66" value="star-2" disabled>
															<label for="star-2-66" title="2 stars">
																	<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
															</label>
															<input id="star-1-66" type="radio" name="rating-66" value="star-1" disabled>
															<label for="star-1-66" title="1 star">
																	<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
															</label>
														</div>
														<!-- ./Star rating -->
														<span class="city">
															<i class="flaticon-signs-1"></i> 
															<?=$show_product['city']?>
														</span>
														<span class="duration">
															<i class="flaticon-interface-2"></i> 
															ينتهي في <?=counttime($show_product['edate'])?>
														</span>
														<span class="sall">
															<i class="flaticon-commerce-and-shopping"></i> 
															الشراء: <?=$show_cart['amount']?> مرات
														</span>

													</div>

												</div>
												<div class="price">
													<span class="stander" value="129">
														AED <?=$show_product['newprice']?>
													</span>
													<div class="value-button decrease-btn" value="Decrease Value">-</div>
													<input type="number" value="0" min="0" disabled />
													<div class="value-button increase-btn" value="Increase Value">+</div>
													<span class="total">
														AED <?=$show_product['newprice'] * $show_cart['amount']?>
													</span>
												</div>
											</div>
											<?}?>
										</div>
										<div class="total-shopping">
											<div class="total-amount">
												<p>مجموع الطلب:</p>
												<span class="total-shopping-price">AED <?=$total?></span>
											</div>
											<ul>
												<li>
													<a href="payment" class="btn-buy"><i class="flaticon-shopping-cart"></i> أشتري</a>
												</li>
												<li>
													<button class="close-cart">واصل التسوق</button>
												</li>
											</ul>                                            
										</div>
									</div>
									<div class="alloverlay"></div>
									<!-- ./Shopping Cart -->

								</div>

								<!-- Login & Sign Up-->
								<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>

											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">
														<i class="flaticon-interface"></i> 
														تسجيل الدخول
													</a>
													<a class="nav-item nav-link" id="nav-signup-tab" data-toggle="tab"   href="#nav-signup" role="tab" aria-controls="nav-signup" aria-selected="false">
													<i class="flaticon-profile"></i>
														إنشاء حساب
													</a>
												</div>
											</nav>

											<!-- Tab panes -->
											<div class="tab-content" id="nav-tabContent">
												<div class="tab-pane fade active in" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
													<form class="form-group login-form" name="signin">
														<input class="form-control" type="text" name="mail" placeholder="اسم المستخدم" required>
														<input class="form-control" type="password" name="password" placeholder="كلمة المرور" required>
														<p class="forget-password">
															<i class="far fa-lightbulb"></i> هل نسيت كلمة المرور؟
														</p>
														<button type="button" class="btn btn-block" onclick="login()">تسجيل دخول</button>
													</form>
													<div class="signup-social row">
														<div class="col-sm-4 col-xs-12">
															<a title="Sign up using gmail" class="google-login-link" href="#">
																Gmail  <i class="fas fa-envelope"></i>
															</a>
														</div>
														<div class="col-sm-4 col-xs-12">
															<a title="Sign up using facebook" class="facebook-login-link" href="#">
															Facebook   <i class="fab fa-facebook-f"></i> 
															</a>
														</div>
														<div class="col-sm-4 col-xs-12">
															<a title="Sign up using twitter" class="twitter-login-link" href="#">
																Twitter <i class="fab fa-twitter"></i>
															</a>
														</div>
													</div>
													
													<form class="form-group password-show">
														<input class="form-control" type="email" placeholder="البريد الإلكتروني" required>
														<button type="submit" class="btn btn-block">إرسال</button>
													</form>

												</div>
												<div class="tab-pane fade" id="nav-signup" role="tabpanel" aria-labelledby="nav-signup-tab">
													<form class="form-group signup-form">
														<input class="form-control" type="text" placeholder="الاسم" required>
														<input class="form-control" type="text" placeholder="اسم المستخدم" required>
														<input class="form-control" type="enail" placeholder="البريد الإلكتروني" required>
														<input class="form-control" type="password" placeholder="كلمة المرور" required>
														<input class="form-control" type="password" placeholder="تأكيد كلمة المرور" required>
														<input class="form-control" type="tel" placeholder="رقم الهاتف" required>
														<button type="submit" class="btn btn-primary btn-block">إنشاء حساب</button>
													</form>
													<div class="signup-social row">
														<div class="col-sm-4 col-xs-12">
															<a title="Sign up using gmail" class="google-login-link" href="#">
																Gmail  <i class="fas fa-envelope"></i>
															</a>
														</div>
														<div class="col-sm-4 col-xs-12">
															<a title="Sign up using facebook" class="facebook-login-link" href="#">
															Facebook   <i class="fab fa-facebook-f"></i> 
															</a>
														</div>
														<div class="col-sm-4 col-xs-12">
															<a title="Sign up using twitter" class="twitter-login-link" href="#">
																Twitter <i class="fab fa-twitter"></i>
															</a>
														</div>
													</div>

												</div>
											</div>
										
										</div>
									</div>
									</div>
								</div>
								<!-- ./Login & Sign Up-->

							</div>
						</div>
					</div>
				</header>