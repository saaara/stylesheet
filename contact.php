<?php 
include 'sub_header.php';
?>
    <div class="rest inner-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<h2 class="main-title">
						<img src="assets/images/icons/cage.svg" class="cage" alt="">
						حسابي  
						<img src="assets/images/icons/heart.svg" class="heart" alt="">
                    </h2>
                    <?php if(isset($_POST['send']))
                    {
                    	$name  = $engine->filter_text($_POST['name']);
                    	$mail  = $engine->filter_text($_POST['mail']);
                    	$phone = $engine->filter_text($_POST['phone']);
                    	$msg   = $engine->filter_text($_POST['message']);
                    	$date  = date('Y-m-d');
                    	if(!empty($name) && !empty($mail) && !empty($phone) && !empty($msg))
                    	{
                    		$insert = $engine->get_query("INSERT IGNORE INTO `messages` SET 
                    			`name` = '$name',
                    			`subject` = 'التواصل معنا',
                    			`message` = '$msg',
                    			`mail` = '$mail',
                    			`date` = '$date'
                    			");
                    		if($insert)
                    		{
                    			$engine->sucmsg('تم إرسال الرسالة للإدارة بنجاح');
                    		}
                    	}
                    	else
                    	{
                    		$engine->errmsg('الرجاء عدم ترك أي حقول فارغة');
                    	}
                    }
                    ?>
                    <form class="form-add form-group" method="post" required>

                        <div class="group half">
                            <label><i class="fas fa-user"></i> الاسم</label>
                            <input class="form-control" type="text" name="name" required>
						</div>

						<div class="group half">
                            <label><i class="fas fa-at"></i> البريد الإلكتروني</label>
                            <input class="form-control" type="email" name="mail" required>
                        </div>
            
                        <div class="group">
                            <label><i class="fas fa-phone"></i> الهاتف</label>
                            <input class="form-control" type="tel" name="phone" required>
						</div>
						
						<div class="group">
                            <label><i class="far fa-comment-dots"></i> رسالتك</label>
                            <textarea class="form-control" name="message"></textarea>
                        </div>
            
                        <button type="submit" name="send" class="add-btn">إرسال</button>
            
                    </form>

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
										<input id="star-5" type="radio" name="rating-32" value="star-5" disabled>
										<label for="star-5" title="5 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-4" type="radio" name="rating-32" value="star-4"  disabled>
										<label for="star-4" title="4 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-3" type="radio" name="rating-32" value="star-3" checked disabled>
										<label for="star-3" title="3 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-2" type="radio" name="rating-32" value="star-2" disabled>
										<label for="star-2" title="2 stars">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
										<input id="star-1" type="radio" name="rating-32" value="star-1" disabled>
										<label for="star-1" title="1 star">
												<i class="active glyphicon glyphicon-star" aria-hidden="true"></i>
										</label>
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