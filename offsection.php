<?php 
include 'sub_header.php';
$section = $engine->filter_text($_GET['section']);
if(!isset($section) || empty($section) || !filter_var ( $section, FILTER_SANITIZE_STRING))
{
	$locat = 'offers';
	header("location: ".$locat." ");
}
?>
	<div class="rest inner-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<h2 class="main-title">
						<img src="assets/images/icons/cage.svg" class="cage" alt="">
						<?=$section?> 
						<img src="assets/images/icons/heart.svg" class="heart" alt="">
					</h2>

					<div class="row">
						<?php
						$get_offers = $engine->get_query("SELECT * FROM `offers` WHERE `section` = '$section'");
						while($show_offer = $get_offers->fetch_array()){?>
						<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12">
							<div class="item">
								<div class="single-block">
									<div class="img-zoom">
										<a href="<?=$show_offer['pid']?>">
											<?php 
											$get_photos = $engine->get_photos($show_offer['pid']);
											$show_photo = $get_photos->fetch_array();
											?>
											<img src="<?=$show_photo['img']?>" class="img-responsive">
										</a>
									</div>
									<p class="one-line title">
										<a href="offer-details.html">
											<?=$show_offer['name']?>
										</a>
									</p>
									<!-- Star rating -->
									<div class="star-rating">
										<input id="star-5" type="radio" name="rating-20" value="star-5" disabled>
										<label for="star-5" title="5 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-4" type="radio" name="rating-20" value="star-4"  disabled>
										<label for="star-4" title="4 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-3" type="radio" name="rating-20" value="star-3" checked disabled>
										<label for="star-3" title="3 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-2" type="radio" name="rating-20" value="star-2" disabled>
										<label for="star-2" title="2 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-1" type="radio" name="rating-20" value="star-1" disabled>
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
										ينتهي خلال <?=counttime($show_offer['edate'])?>
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
									<button class="favourite-btn done" onclick="addto_fav('<?=$pid?>','del')"><i class="flaticon-love-and-romance-1"></i> </button>
									<?}else{?>
									<button class="favourite-btn" onclick="addto_fav('<?=$pid?>','add')"><i class="flaticon-love-and-romance-1"></i> </button>
									<?}?>
								</div>
							</div>
						</div>
						<?}?>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="side-bar">
						<h3>أفضل العروض</h3>
						<?php 
						$get_offers = $engine->get_query("SELECT * FROM `offers` ORDER BY `date` DESC LIMIT 7");
						while($show_offers = $get_offers->fetch_array()){?>
						<div class="item">
							<div class="single-block">
								<div class="col-sm-4 col-xs-12">
									<div class="img-zoom">
										<a href="<?=$show_offers['pid']?>">
											<?php 
											$get_image = $engine->get_photos($show_offers['pid']);
											$show_image = $get_image->fetch_array();
											?>
											<img src="<?=$show_image['img']?>" class="img-responsive">
										</a>
									</div>
								</div>
								<div class="col-sm-8 col-xs-12">
									<p class="one-line title">
										<a href="<?=$show_offers['pid']?>">
											<?=$show_offers['name']?>
										</a>
									</p>
									<!-- Star rating -->
									<div class="star-rating">
										<?=$engine->rate($show_offers['pid'])?>
									</div>
									<!-- ./Star rating -->
									<span class="city">
										<i class="flaticon-signs-1"></i> 
										<?=$show_offers['city']?>
									</span>
									<span class="duration">
										<i class="flaticon-interface-2"></i> 
										ينتهي خلال <?=counttime($show_offers['edate'])?>
									</span>
									<span class="sall">
										<i class="flaticon-commerce-and-shopping"></i> 
										الشراء: <?=$show_offers['visits']?> مرات
									</span>
									<span class="price">
										<del><?=$show_offers['oldprice']?>SAR</del>
										<?=$show_offers['newprice']?>SAR
									</span>
									<?php 
									if($engine->isfav($show_offers['pid'])){?>
									<button class="favourite-btn done" onclick="addto_fav('<?=$pid?>','del')"><i class="flaticon-love-and-romance-1"></i> </button>
									<?}else{?>
									<button class="favourite-btn" onclick="addto_fav('<?=$pid?>','add')"><i class="flaticon-love-and-romance-1"></i> </button>
									<?}?>
								</div>
							</div>
						</div>
						<?}?>
						<h3>آخر المدونات</h3>

						<?php 
						$get_articles = $engine->get_query("SELECT * FROM `news`");
						while($show_articles = $get_articles->fetch_array()){?>
						<a href="show_article?article=<?=$show_article['id']?>" class="single-blog">
							<div class="col-sm-4 col-xs-12">
								<img src="<?=$show_article['img']?>" class="img-responsive" alt="">
							</div>
							
							<div class="col-sm-8 col-xs-12">
								<span class="section">
									<i class="flaticon-miscellaneous"></i> 
									<?=$show_article['section']?>
								</span>
								<p class="two-line">
									<?=$show_article['title']?>
								</p>
							</div>
						</a>
						<?}?>

					</div>
				</div>
			</div>
		</div>
	</div>	
<?php 
include 'footer.php';
?>