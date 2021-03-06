<?php 
include 'sub_header.php';
$type = $engine->filter_text($_GET['section']);
?>
	<div>
		<div class="rest inner-page">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						<h2 class="main-title">
							<img src="assets/images/icons/cage.svg" class="cage" alt="">
							الأقسام  
							<img src="assets/images/icons/heart.svg" class="heart" alt="">
						</h2>

						<div class="row">
							<?php 
							if(isset($type) && !empty($type))
							{
								$get_sections = $engine->get_query("SELECT * FROM `ssections` WHERE `msec` = '$type'");
								while($show_section = $get_sections->fetch_array()){?>
								<div class="col-sm-3 col-xs-12">
									<a href="offsection?section=<?=$show_section['name']?>" class="offer-section">
										<?php 
										if($show_section['img'] == ''){?>
											<i style="font-size:30px;" class="fa fa-<?=$show_section['icon']?>"></i>
										<?}else{?>
											<img src="<?=$show_section['img']?>" style="width:40px;">
										<?}?>
										<p><?=$show_section['name']?></p>
									</a>
								</div>
							<?}}else{
								$get_sections = $engine->get_query("SELECT * FROM `sections`");
								while($show_section = $get_sections->fetch_array()){?>
								<div class="col-sm-3 col-xs-12">
									<a href="?section=<?=$show_section['name']?>" class="offer-section">
										<?php 
										if($show_section['img'] == ''){?>
											<i style="font-size:30px;" class="fa fa-<?=$show_section['icon']?>"></i>
										<?}else{?>
											<img src="<?=$show_section['img']?>" style="width:40px;">
										<?}?>
										<p><?=$show_section['name']?></p>
									</a>
								</div>
							<?}}?>
							<!-- Pagination -->
							<!-- <div class="col-xs-12">
								<div class="page-navigation">
									<div class="pages-list">
										<span><i class="fas fa-chevron-right"></i></span>
										<span>1</span>
										<a href="#">2</a> 
										<a href="#">3</a> 
										<a href="#">4</a>
										<a href="#">5</a>
										<a href="#"><i class="fas fa-chevron-left"></i></a>
									</div>
								</div>
							</div> -->
							<!-- ./Pagination -->

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
	</div>
		
<?php 
include 'footer.php';
?>