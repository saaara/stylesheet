<?php 
include 'header.php';
?>
	<!-- Slider -->
	<?php 
	$get_slider = $engine->get_query("SELECT * FROM `slides`");
	$slides;
	while($show_slides = $get_slider->fetch_array())
	{
		$slides = '"'.$show_slides['img'].'",'.$slides;
		$slides = rtrim($slides, ",");
	}
	?>
	<div class="main-bg"  id="demo-1" data-zs-src='[<?=$slides?>]' data-zs-overlay="dots">
		<div class="search-block">
			<h2>حقق عرسك الأسطوري مع القفص الذهبي</h2>
			<small>جميع الخيارات بين يديك</small>
			<div class="search-inputs">
				<div class="input type">
					<div class="info">
						<span><i class="flaticon-tools-and-utensils"></i> ما الذي تبحث عنه؟</span>
						<p class="choice">قاعات زفاف</p>
					</div>
					<div class="chices-block three-cols">
						<ul>
							<?php 
							$get_sections = $engine->get_query("SELECT * FROM `ssections` ORDER BY `id` LIMIT 6");
							while($show_sections = $get_sections->fetch_array()){?> 
							<li>
								<p class="title"> 
									<i class="fa fa-<?=$show_sections['img']?>"></i>
									<span class="word"><?=$show_sections['name']?></span>
									<span class="line"></span>
								</p>
							</li>
							<?}?>
						</ul>
						<ul>
							<?php 
							$get_sections = $engine->get_query("SELECT * FROM `ssections` ORDER BY `id` LIMIT 6,12");
							while($show_sections = $get_sections->fetch_array()){?> 
							<li>
								<p class="title"> 
									<img src="<?=$show_sections['img']?>" style="width: 25px;">
									<span class="word"><?=$show_sections['name']?></span>
									<span class="line"></span>
								</p>
							</li>
							<?}?>
						</ul>
						<ul>
							<?php 
							$get_sections = $engine->get_query("SELECT * FROM `ssections` ORDER BY `id` LIMIT 6,18");
							while($show_sections = $get_sections->fetch_array()){?> 
							<li>
								<p class="title"> 
									<img src="<?=$show_sections['img']?>" style="width: 25px;">
									<span class="word"><?=$show_sections['name']?></span>
									<span class="line"></span>
								</p>
							</li>
							<?}?>
						</ul>
					</div>
				</div>
				<div class="input city">
					<div class="info">
						<span><i class="flaticon-signs"></i> المدينة</span>
						<p class="choice">الرياض</p>
					</div>
					<div class="chices-block">
						<ul>
							<?php 
							$get_citie = $engine->get_query("SELECT * FROM `cities`");
							while($show_cities = $get_citie->fetch_array()){?>
							<li>
								<p class="title">
									<span class="word"><?=$show_cities['name']?></span>
									<span class="line"></span>
								</p>
							</li>
							<?}?>
						</ul>
					</div>
				</div>
				<form action="offsection">
					<input type="hidden" name="section" class="type">
					<input type="hidden" name="city" class="city">
					<button type="submit">بحث</button>
				</form>
			</div>
			
		</div>
	</div>
	<!-- ./Slider -->	

	<!-- Under slider blocks -->
	<div class="under-slider">
		<div class="container">
			<h2 class="main-title">
				<img src="assets/images/icons/cage.svg" class="cage" alt="">
				القفص الذهبي
				<img src="assets/images/icons/heart.svg" class="heart" alt="">
			</h2>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<img src="assets/images/icons/best.svg" class="img-responsive" alt="">
					<h3>أفضل العروض</h3>
				</div>
				<div class="col-sm-4 col-xs-12">
					<img src="assets/images/icons/instructions.svg" class="img-responsive" alt="">
					<h3>نصائح وإرشادات</h3>
				</div>
				<div class="col-sm-4 col-xs-12">
					<img src="assets/images/icons/rings.svg" class="img-responsive" alt="">
					<h3> اختر الشريك</h3>
				</div>
				<div class="col-xs-12 sentence">
					<a href="offers">
						اختر أفضل العروض
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- ./Under slider blocks -->

	<!-- blog -->
	<div class="blog light-bg">
		<div class="container">
			<h2 class="main-title">
				<img src="assets/images/icons/cage.svg" class="cage" alt="">
				<?php 
				$get_bsection = $engine->get_query("SELECT * FROM `blog_sections` WHERE `type` = 'sub' ORDER BY rand() LIMIT 1");
				$show_bsection = $get_bsection->fetch_array();
				$bsection  = $show_bsection['name'];
				?>
				<?=$bsection?>
				<img src="assets/images/icons/heart.svg" class="heart" alt="">
			</h2>
			<div class="row">
				<?php 
				$get_blogs = $engine->get_query("SELECT * FROM `news` WHERE `section` = '$bsection' ORDER BY `id` LIMIT 4");
				while($show_blogs = $get_blogs->fetch_array()){?>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<a class="single-blog" href="show_article?article=<?=$show_blogs['id']?>">
						<img src="<?=$show_blogs['img']?>" class="img-responsive" alt="">
						<span class="section">
							<i class="flaticon-miscellaneous"></i> 
							<?=$show_blogs['section']?>
						</span>
						<p class="two-line">
							<?=$engine->limtxt(150,$show_blogs['text'])?>
						</p>
					</a>
				</div>
				<?}?>
				<!-- Ads -->
				<div class="col-xs-12 ads-block">
					<a href="#">
						<img src="assets/images/ads.jpg" class="img-responsive">
					</a>
				</div>
				<!-- ./Ads -->

			</div>
		</div>
	</div>
	<!-- ./blog -->

	<!-- Rest -->
	<div class="blog">
		<div class="container">
			<h2 class="main-title">
				<img src="assets/images/icons/cage.svg" class="cage" alt="">
				<?php 
				$get_bsection = $engine->get_query("SELECT * FROM `blog_sections` WHERE `type` = 'sub' ORDER BY rand() LIMIT 1");
				$show_bsection = $get_bsection->fetch_array();
				$bsection  = $show_bsection['name'];
				?>
				<?=$bsection?>
				<img src="assets/images/icons/heart.svg" class="heart" alt="">
			</h2>
			<div class="row">
				<?php 
				$get_blogs = $engine->get_query("SELECT * FROM `news` WHERE `section` = '$bsection' ORDER BY `id` LIMIT 4");
				while($show_blogs = $get_blogs->fetch_array()){?>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<a class="single-blog" href="show_article?article=<?=$show_blogs['id']?>">
						<img src="<?=$show_blogs['img']?>" class="img-responsive" alt="">
						<span class="section">
							<i class="flaticon-miscellaneous"></i> 
							<?=$show_blogs['section']?>
						</span>
						<p class="two-line">
							<?=$engine->limtxt(150,$show_blogs['text'])?>
						</p>
					</a>
				</div>
				<?}?>
				<!-- Ads -->
				<div class="col-xs-12 ads-block">
					<a href="#">
						<img src="assets/images/ads.jpg" class="img-responsive">
					</a>
				</div>
				<!-- ./Ads -->

			</div>
		</div>
	</div>
	<!-- ./Rest -->

	<!-- Offers -->
	<div class="rest light-bg">
		<div class="container">
			<h2 class="main-title">
				<img src="assets/images/icons/cage.svg" class="cage" alt="">
				اكتشف العروض 
				<img src="assets/images/icons/heart.svg" class="heart" alt="">
			</h2>
			<?php 
			$get_by_Section = $engine->get_query("SELECT DISTINCT `section` FROM `offers`");
			while($show_section   = $get_by_Section->fetch_array()){?>
			<h3 class="sub-title"><?=$show_section['section']?></h3>
			
			<div class="main-carousel">
				<?php 
				$section   = $show_section['section'];
				$get_offer = $engine->get_query("SELECT * FROM `offers` WHERE `section` = '$section'");
				while($show_offer = $get_offer->fetch_array()){?>		
				<div class="item">
					<div class="single-block">
						<div class="img-zoom">
							<a href="<?=$show_offer['pid']?>">
								<?php 
								$get_img = $engine->get_photos($show_offer['pid']);
								$show_img = $get_img->fetch_array();
								?> 
								<img src="<?=$show_img['img']?>" class="img-responsive">
							</a>
						</div>
						<p class="one-line title">
							<a href="<?=$show_offer['pid']?>">
								<?=$show_offer['name']?>
							</a>
						</p>
						<!-- Star rating -->
						<div class="star-rating">
							<input id="star-5" type="radio" name="rating-6" value="star-5" disabled>
							<label for="star-5" title="5 stars">
									<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
							</label>
							<input id="star-4" type="radio" name="rating-6" value="star-4"  disabled>
							<label for="star-4" title="4 stars">
									<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
							</label>
							<input id="star-3" type="radio" name="rating-6" value="star-3" checked disabled>
							<label for="star-3" title="3 stars">
									<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
							</label>
							<input id="star-2" type="radio" name="rating-6" value="star-2" disabled>
							<label for="star-2" title="2 stars">
									<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
							</label>
							<input id="star-1" type="radio" name="rating-6" value="star-1" disabled>
							<label for="star-1" title="1 star">
									<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
							</label>
						</div>
						<!-- ./Star rating -->
						<span class="city">
							<i class="flaticon-signs-1"></i> 
							<?=$show_offer['city']?>
						</span>
						<span class="duration">
							<i class="flaticon-interface-2"></i> 
							ينتهي: <?=counttime($show_offer['edate'])?>
						</span>
						<span class="sall">
							<i class="flaticon-commerce-and-shopping"></i> 
							 الشراء: <?=$show_offer['visits']?> مرات
						</span>
						<span class="price">
							<del><?=$show_offer['oldprice']?>SAR</del>
							<?=$show_offer['newprice']?>SAR
						</span>
						<?php 
						if($engine->isfav($show_offer['pid'])){?>
						<button class="favourite-btn done" onclick="addto_fav('<?=$show_offer['pid']?>','del')"><i class="flaticon-love-and-romance-1"></i> </button>
						<?}else{?>
						<button class="favourite-btn" onclick="addto_fav('<?=$show_offer['pid']?>','add')"><i class="flaticon-love-and-romance-1"></i> </button>
						<?}?>
					</div>
				</div>
				<?}?>
			</div>
			<?}?>			
			<div class="col-xs-12 ads-block">
				<a href="#">
					<img src="assets/images/ads.jpg" class="img-responsive">
				</a>
			</div>

		</div>
	</div>
	<!-- ./Offers -->

	<!-- honeymoon -->
	<div class="blog">
		<div class="container">
			<h2 class="main-title">
				<img src="assets/images/icons/cage.svg" class="cage" alt="">
				<?php 
				$get_bsection = $engine->get_query("SELECT * FROM `blog_sections` WHERE `type` = 'sub' ORDER BY rand() LIMIT 1");
				$show_bsection = $get_bsection->fetch_array();
				$bsection  = $show_bsection['name'];
				?>
				<?=$bsection?>
				<img src="assets/images/icons/heart.svg" class="heart" alt="">
			</h2>
			<div class="row">
				<?php 
				$get_blogs = $engine->get_query("SELECT * FROM `news` WHERE `section` = '$bsection' ORDER BY `id` LIMIT 4");
				while($show_blogs = $get_blogs->fetch_array()){?>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<a class="single-blog" href="show_article?article=<?=$show_blogs['id']?>">
						<img src="<?=$show_blogs['img']?>" class="img-responsive" alt="">
						<span class="section">
							<i class="flaticon-miscellaneous"></i> 
							<?=$show_blogs['section']?>
						</span>
						<p class="two-line">
							<?=$engine->limtxt(150,$show_blogs['text'])?>
						</p>
					</a>
				</div>
				<?}?>
				<!-- Ads -->
				<div class="col-xs-12 ads-block">
					<a href="#">
						<img src="assets/images/ads.jpg" class="img-responsive">
					</a>
				</div>
				<!-- ./Ads -->

			</div>
		</div>
	</div>
	<!-- ./honeymoon -->
<?php 
include 'footer.php';
?>