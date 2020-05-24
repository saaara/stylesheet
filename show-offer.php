<?php 
include 'sub_header.php';
$pid = $engine->filter_text($_GET['p']);
$get_offer = $engine->get_query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
$show_offer = $get_offer->fetch_array();
$offers_num = $get_offer->num_rows;
$get_photo  = $engine->get_photos($pid);
$show_photo = $get_photo->fetch_array();
$visits =$show_offer['visits'] + 1;
$update_visits = $engine->get_query("UPDATE `offers` SET `visits` = '$visits' WHERE `pid` = '$pid'");
if(!isset($pid) || empty($pid) || $offers_num <= 0)
{
	$locat = 'offers';
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
								<img src="<?=$show_photo['img']?>" class="img-responsive">
								<?php 
								if($engine->isfav($pid)){?>
								<button class="favourite-btn done" onclick="addto_fav('<?=$pid?>','del')"><i class="flaticon-love-and-romance-1"></i> </button>
								<?}else{?>
								<button class="favourite-btn" onclick="addto_fav('<?=$pid?>','add')"><i class="flaticon-love-and-romance-1"></i> </button>
								<?}?>
							</div>
							<div class="info">
								<p class="one-line title">
									<a href="#">
										<?=$show_offer['name']?>
									</a>
								</p>
								<!-- Star rating -->
								<div class="star-rating">
									<?=$engine->rate($show_offer['pid'])?>
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
									<del>300SAR</del>
									225SAR
								</span>
							</div>	
							<div class="paragraph">
								<h3>تفاصيل العرض</h3>
								<p>
									<?=html_entity_decode($show_offer['desc'])?>
								</p>
							</div>	
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			
								<div class="panel panel-default"> 
									<div class="panel-heading" role="tab" id="heading-one" >
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
											تفاصيل العرض
											<i class="fas fa-chevron-down"></i>
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse in" id="collapse-one" role="tablist" aria-labelledby="heading-one">
										<div class="panel-body">
											<p class="para-block">
												<?=html_entity_decode($show_offer['desc'])?> 
											</p>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default"> 
									<div class="panel-heading" role="tab" id="heading-two">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-two" aria-expanded="true" aria-controls="collapse-two">
											أماكن الحصوص على كوبون
											<i class="fas fa-chevron-down"></i>
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="collapse-two" role="tablist" aria-labelledby="heading-two">
										<div class="panel-body">
											<div class="copon">
												<?php 
												$mid = $show_offer['uid'];
					                            $pranches = $show_offer['pranches'];
					                            $gcomp = $engine->connect()->query("SELECT * FROM `companies` WHERE `merchant` = '$mid' AND `name` LIKE '%$pranches%'");
					                            while($shcomp = $gcomp->fetch_array()){?>
					                            <div class="panel-body">
					                            	<h3>الفرع</h3>
					                                <p class="no-margin">
					                                	<?=$shcomp['name']?>
													</p>
					                                <h3>العنوان</h3>
					                                <p class="product-para">
					                                	<?=html_entity_decode($shcomp['address'])?>
					                                </p>
					                                <h3>التواصل</h3>
					                                <p class="product-para">
					                                	<?=html_entity_decode($shcomp['contact'])?>
					                                </p>
					                                <div class="show-map">
					                                    <a class="btn btn-primary btn-xs" title="View Location" target="_blank" href="https://www.google.com/maps/place/<?=$shcomp['place']?>"></i>&nbsp;عرض على الخريطة</a>
					                                </div>
					                            </div>
					                            <?}?> 

												<!-- <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->

											</div>
										</div>
									</div>
								</div>
								
		
								<div class="panel panel-default"> 
									<div class="panel-heading" role="tab" id="heading-three">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-three" aria-expanded="true" aria-controls="collapse-three">
											الشروط والأحكام
											<i class="fas fa-chevron-down"></i>
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="collapse-three" role="tablist" aria-labelledby="heading-three">
										<div class="panel-body">
											<p class="para-block">
												<?=html_entity_decode(S_TERMS)?>
											</p>
										</div>
									</div>
								</div>
		
		
							
							</div>

							<form>
								<span>أضف تقييماً: </span>
								<!-- Star rating -->
								<div class="star-rating">
									<input id="star-5" type="radio" name="rating-0" value="star-5">
									<label for="star-5" title="5 stars">
										<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
									</label>
									<input id="star-4" type="radio" name="rating-0" value="star-4">
									<label for="star-4" title="4 stars">
										<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
									</label>
									<input id="star-3" type="radio" name="rating-0" value="star-3">
									<label for="star-3" title="3 stars">
										<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
									</label>
									<input id="star-2" type="radio" name="rating-0" value="star-2">
									<label for="star-2" title="2 stars">
										<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
									</label>
									<input id="star-1" type="radio" name="rating-0" value="star-1">
									<label for="star-1" title="1 star">
										<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
									</label>
								</div>
								<!-- ./Star rating -->
								<button type="button" onclick="addto_cart('<?=$pid?>','add')">أضف إلى السلة</button>
							</form>						
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
		<!-- ./Offer Details -->
<?php 
include 'footer.php';
?>