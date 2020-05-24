<?php 
include 'sub_header.php';
$id = $engine->filter_text($_GET['article']);
$get_article = $engine->get_query("SELECT * FROM `news` WHERE `id` = '$id'");
$show_article = $get_article->fetch_array();
$articles_num = $get_article->num_rows;
if(!isset($id) || empty($id) || $articles_num <= 0)
{
	$locat = 'home';
	header("location: ".$locat." ");
}
?>
		<!-- Offer Details -->
		<div class="rest inner-page">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						
						<div class="offer-details">
							<div class="img-inner">
								<img src="<?=$show_article['img']?>" class="img-responsive">
							</div>
							<div class="info">
								<span class="section">
									<i class="flaticon-miscellaneous"></i> 
									<?=$show_article['section']?>
								</span>
								<p class="one-line title">
									<a href="#">
										<?=$show_article['title']?>
									</a>
								</p>
							</div>	
							<div class="paragraph">
								<p>
									<?=html_entity_decode($show_article['text'])?>
								</p>
							</div>						
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
										if($engine->isfav($pid)){?>
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
		<!-- ./Offer Details -->

<?php 
include 'footer.php';
?>