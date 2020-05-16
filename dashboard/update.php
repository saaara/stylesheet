<?php 
include"../core.php";
$uid = USER_ID;
$rank = USER_RANK;
$dtype = $_REQUEST['type'];
$cn    = $_REQUEST['cn'];
$wut    = $_REQUEST['req'];
$field = $_REQUEST['f'];
$spuid  = $_REQUEST['spuid'];
$slink = S_URI;
$vname = array('login', 'signin','log in','sign in','user','password','upload','site','enter','image','picture','sql','mysqli','select' );
$lnkid	= $_REQUEST['lnid'];
$orglnk	= $_REQUEST['orglnk'];
$thisusr= $_REQUEST['thisid'];

if($wut == "notf_num")
{
	$uid = USER_ID;
	if(USER_RANK == 1 || USER_RANK ==2)
	{
		$com 	= $engine->connect()->query("SELECT * FROM `comments` WHERE `status` = 0");
		$ncom 	= $com->num_rows;
		$ofr 	= $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = 0");
		$nofr 	= $ofr->num_rows;
		$pro 	= $engine->connect()->query("SELECT * FROM `products` WHERE `status` = 0");
		$npro 	= $pro->num_rows;
		$rep 	= $engine->connect()->query("SELECT * FROM `reports` WHERE `status` = 0");
		$nrep 	= $rep->num_rows;
		$sal 	= $engine->connect()->query("SELECT * FROM `sales` WHERE `status` = 0");
		$nsal 	= $sal->num_rows;
		$total 	= $ncom+$nmsg+$nofr+$npro+$nrep+$nsal;
	}
	else if(USER_RANK == 3)
	{
		$com 	= $engine->connect()->query("SELECT * FROM `comments` WHERE (`status` = 0 AND `uid` = '$uid')");
		$ncom 	= $com->num_rows;
		$rep 	= $engine->connect()->query("SELECT * FROM `reports` WHERE (`status` = 0 AND `uid` = '$uid')");
		$nrep 	= $rep->num_rows;
		$sal 	= $engine->connect()->query("SELECT * FROM `sales` (`status` = 0 AND `uid` = '$uid')");
		$nsal 	= $sal->num_rows;
		$total 	= $ncom+$nrep+$nsal;
	}
	echo $total;
}

if($wut == "msg_num")
{
	$uid = USER_ID;
	if(USER_RANK == 1 || USER_RANK ==2)
	{
		$msg 	= $engine->connect()->query("SELECT * FROM `messages` WHERE `status` = 0");
		$nmsg 	= $msg->num_rows;
		$total 	= $nmsg;
	}
	echo $total;
}
if($wut == "show_notf")
{
	$uid = USER_ID;
	if(USER_RANK == 1 || USER_RANK ==2)
	{
		$com 	= $engine->connect()->query("SELECT * FROM `comments` WHERE `status` = 0");
		$ncom 	= $com->num_rows;
		$msg 	= $engine->connect()->query("SELECT * FROM `messages` WHERE `status` = 0");
		$nmsg 	= $msg->num_rows;
		$ofr 	= $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = 0");
		$nofr 	= $ofr->num_rows;
		$pro 	= $engine->connect()->query("SELECT * FROM `products` WHERE `status` = 0");
		$npro 	= $pro->num_rows;
		$rep 	= $engine->connect()->query("SELECT * FROM `reports` WHERE `status` = 0");
		$nrep 	= $rep->num_rows;
		$sal 	= $engine->connect()->query("SELECT * FROM `sales` WHERE `status` = 0");
		$nsal 	= $sal->num_rows;
		if($ncom != 0){?>
		<li>
            <a href="comments">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>تعليقات جديدة</span>
                </span>
                <span class="message">
                	لديك  <?=$ncom?> تعليق بحاجة للمراجعة
                </span>
            </a>
        </li>
        <?}
        if($nmsg != 0){?>
        <li>
            <a href="messages">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>رسائل جديدة</span>
                </span>
                <span class="message">
                	لديك  <?=$nmsg?> رسالة بواردة غير مقروءة
                </span>
            </a>
        </li>
        <?}
        if($nofr != 0 || $npro != 0){?>
        <li>
            <a href="pending_offers">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>منتجات حديثة</span>
                </span>
                <span class="message">
                	لديك  <?=$nofr+$npro?> منتج جديد مضاف يحتاج للمراجعة
                </span>
            </a>
        </li>
        <?}
        if($nrep != 0){?>
        <li>
            <a href="reports">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>شكاوى ضد التجار</span>
                </span>
                <span class="message">
                	قم بالضغط هنا لعرض الشكاوي المقدمة ضد التجار
                </span>
            </a>
        </li>
        <?}
	}
	else if(USER_RANK == 3)
	{
		$com 	= $engine->connect()->query("SELECT * FROM `comments` WHERE (`status` = 0 AND `uid` = '$uid')");
		$ncom 	= $com->num_rows;
		$rep 	= $engine->connect()->query("SELECT * FROM `reports` WHERE (`status` = 0 AND `uid` = '$uid')");
		$nrep 	= $rep->num_rows;
		$sal 	= $engine->connect()->query("SELECT * FROM `sales` (`status` = 0 AND `uid` = '$uid')");
		$nsal 	= $sal->num_rows;
		if($ncom != 0){?>
		<li>
            <a href="comments">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>تعليقات جديدة</span>
                </span>
                <span class="message">
                	لديك  <?=$ncom?> تعليق بحاجة للمراجعة
                </span>
            </a>
        </li>
        <?}
        if($nrep != 0){?>
        <li>
            <a href="reports">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>هناك شكوى ضدك</span>
                </span>
                <span class="message">
                	ققدم أحدهم شكوى خاصة بأحد منتجاتك 
                </span>
            </a>
        </li>
        <?}
        if($nsal != 0){?>
        <li>
            <a href="reports">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>اشترى أحدهم منتجك</span>
                </span>
                <span class="message">
                	ققام شخص ما بشراء منتج خاص بك
                </span>
            </a>
        </li>
        <?}
	}
}
if($wut == "show_msg")
{
	$uid = USER_ID;
	if(USER_RANK == 1 || USER_RANK ==2)
	{
		$msg 	= $engine->connect()->query("SELECT * FROM `messages` WHERE `status` = 0");
		$nmsg 	= $msg->num_rows;
        if($nmsg != 0){?>
        <li>
            <a href="messages">
                <span class="image">
                    <img src="assets/build/images/img.jpg"alt="Profile Image"/>
                </span>
                <span>
                    <span>رسائل جديدة</span>
                </span>
                <span class="message">
                	لديك  <?=$nmsg?> رسالة بواردة غير مقروءة
                </span>
            </a>
        </li>
        <?} 
	}
}
else if($wut == "msgs")
{
	$q = "SELECT * FROM `messages` WHERE (`to` = '$uid' AND `status` = 0)";
	$smd = $engine->connect()->query($q);
	$num = $smd->num_rows;
	if($num >= 1)
	{?>
		<span class="label label-rouded label-warning pull-right"><?=$num?></span>
	<?}
}

else if($wut == "edit_site")
{
	$name   	= $_REQUEST['name'];
	$lnk    	= $_REQUEST['lnk'];
	$desc   	= htmlentities($_REQUEST['desc']);
	$keys   	= $_REQUEST['keys'];
	$phone  	= $_REQUEST['phone'];
	$mail   	= $_REQUEST['mail'];
	if(filter_var($lnk, FILTER_VALIDATE_URL))
	{
		$results = array('status' => 0, 'details' => 'قم بإضافة اسم الدومين فقط بدون https:// أو www أو http');
	}
	else
	{
		if(!empty($name) && !empty($lnk) && !empty($desc) && !empty($keys) && !empty($phone) && !empty($mail))
		{
			$q = "UPDATE `siteinfo` SET `sname` = '$name' , `surl` = '$lnk' , `skeys` = '$keys' , `sdesc` = '$desc' , `sphone` = '$phone' , `smail` = '$mail'";
			$upd = $engine->connect()->query($q);
			if($upd)
			{
				$results = array('status' => 1, 'details' => 'تم تعديل بيانات الموقع بنجاح');
			}
		}
		else
		{
			$results = array('status' => 0, 'details' => 'الرجاء إدخال جميع بيانات المدرسة');
		}
	}
	echo $results = json_encode($results);
}
else if($wut == "addresses")
{
	$country    = addslashes(htmlspecialchars($_REQUEST['country']));
	$city       = addslashes(htmlspecialchars($_REQUEST['city']));
	$addr       = addslashes(htmlspecialchars($_REQUEST['addr']));
	$phone      = addslashes(htmlspecialchars($_REQUEST['phone']));
	$main       = addslashes(htmlspecialchars($_REQUEST['main']));
	$uid        = USER_ID;
	
	if(!empty($country) && !empty($city) && !empty($addr) && !empty($phone))
	{
		if($main == 1)
		{
			$qup = "UPDATE `addresses` SET `main` = '0' WHERE `user` = '$uid'";
			$smdup = $engine->connect()->query($qup);
		}
		$q       = "INSERT IGNORE INTO `addresses` SET `user` = '$uid' , `country` = '$country' , `city` = '$city', `phone` = '$phone', `main` = '$main', `address` = '$addr'";
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			$results = array('status' => 1, 'details' => 'تم إضافة  العنوان بنجاح');
		}
	}
	else
	{
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_news")
{
	$type   = $_REQUEST['type'];
	$name   = $_REQUEST['n'];
	$txt    = $_REQUEST['txt'];
	$id      = $_REQUEST['id'];
	if(!empty($name) && !empty($txt))
	{
		if($type == 'add')
		{
			$q       = "INSERT IGNORE INTO `newsfeed` SET `title` = '$name' , `txt` = '$txt'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `newsfeed` SET `title` = '$name' , `txt` = '$txt'";
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			$results = array('status' => 1, 'details' => 'تم إضافة  الخبر بنجاح');
		}
	}
	else
	{
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_favs")
{
	$uid      = USER_ID;
	$pid      = $_REQUEST['pid'];
	$type     = $_REQUEST['type'];
	if(!empty($pid) && !empty($uid))
	{
		$q       = "INSERT IGNORE INTO `favs` SET `uid` = '$uid', `pid` = '$pid'";
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			if($type == 'btn')
			{?>
				<a onclick="del_fav('<?=$pid?>','btn')" id="fvbtn<?=$pid?>">
		            <i class="flaticon-heart" style="color:red;"></i> 
		            إزالة من قائمة المفضلة
		        </a>
			<?}
			else
			{?>
				<a onclick="del_fav('<?=$pid?>')" style="color:red;">
                    <i class="flaticon-heart"></i>
                </a>
			<?}
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "del_favs")
{
	$uid      = USER_ID;
	$pid      = $_REQUEST['pid'];
	$type     = $_REQUEST['type'];
	if(!empty($pid) && !empty($uid))
	{
		$q       = "DELETE FROM `favs` WHERE `pid` = '$pid' AND `uid` = '$uid'";
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			if($type == 'btn')
			{?>
				<a onclick="addfavs('<?=$pid?>','btn')" id="fvbtn<?=$pid?>">
		            <i class="flaticon-heart"></i> 
		            إضافة إلى قائمة المفضلة
		        </a>
			<?}
			else
			{?>
				<a onclick="addfavs('<?=$pid?>')">
		            <i class="flaticon-heart"></i> 
		        </a>
			<?}
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "gfavs")
{
	$uid  = USER_ID;
	if(isset($_SESSION['email']) && isset($_SESSION['password']))
	{
		$smd = $engine->connect()->query("SELECT * FROM `favs` WHERE `uid` = '$uid'");
		while($show = $smd->fetch_array())
			{
				$pid    = $show['pid'];
				$gp     = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
				$showp  = $gp->fetch_array();
				$qim    = "SELECT * FROM `photos` WHERE `pid` = '$pid'";
				$smdim  = $engine->connect()->query($qim);
				$showim = $smdim->fetch_array();
			?>
			<div class="col-sm-6 col-xs-12" id="favs<?=$show['id']?>">
                <div class="product">
                    <button class="remove" onclick="del('favs','<?=$show['id']?>')">إزالة <i class="glyphicon glyphicon-trash"></i></button>
                    <div class="new-product">
                        <span>جديد</span>
                    </div>
                    <div class="product-img">
                        <a href="<?=$showim['pid']?>"><img class="img-responsive" src="<?=$showim['img']?>"></a>
                    </div>
                    <div class="product-text">
                        
                        <h2 class="product-title"><a href="#"><?=$showp['name']?></a>
                        <span class="dots pull-right">...</span></h2>
                        
                        <div class="price">
                            <span class="old-rpice"><del><?=$showp['oldprice'].' '.DCR?></del></span>
                            <span class="new-price"><?=$showp['newprice'].' '.DCR?></span>
                        </div>
                        <div class="brought pull-right">
                            المشترى : <?=$showp['visits']?>
                        </div>
                    </div>
                    <div class="overlay">

                        <h2 class="product-title"><a href="#"><?=$showp['name']?></a>
                            
                        <div class="price">
                            <span class="old-rpice"><del><?=$showp['oldprice'].' '.DCR?></del></span>
                            <span class="new-price"><?=$showp['newprice'].' '.DCR?></span>
                        </div>
                        <div class="brought pull-right">
                            المشترى : <?=$showp['visits']?>
                        </div>
                    </div>
                </div> 
            </div>
		<?}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'الرجاء تسجيل الدخول لتستطيع عرض المحفوظات');
		echo $results = json_encode($results);
	}
}
else if($wut == "gcart")
{
	$uid  = USER_ID;
	if(isset($_SESSION['email']) && isset($_SESSION['password']))
	{
		$smd = $engine->connect()->query("SELECT * FROM `cart` WHERE `uid` = '$uid'");
		while($show = $smd->fetch_array())
			{
				$pid    = $show['pid'];
				$gp     = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
				$showp  = $gp->fetch_array();
				$qim    = "SELECT * FROM `photos` WHERE `pid` = '$pid'";
				$smdim  = $engine->connect()->query($qim);
				$showim = $smdim->fetch_array();
				$gcart  = $engine->connect()->query("SELECT * FROM `cart` WHERE `pid` = '$pid' AND `uid` = '$uid'");
				$showcrt = $gcart->fetch_array();
			?>
			<div class="cart-product">
                <button class="remove" onclick="del_cart('<?=$showp['pid']?>')">إزالة <i class="glyphicon glyphicon-trash"></i></button>
                <div class="info">
                    <img src="<?=$showim['img']?>" class="img-responsive">
                    <p><?=$showp['name']?></p>
                </div>
                <div class="price">
                	<form name="cq<?=$showp['pid']?>"> 
	                    <span class="total" id="total<?=$showp['pid']?>"><?=$showp['newprice']*$showcrt['q']?></span>
	                    <div class="value-button decrease-btn" onclick="ch_q('decrease','<?=$showp['pid']?>','<?=$showp['newprice']?>')">-</div>
	                    <input type="number" name="qntty<?=$showp['pid']?>" value="<?=$showcrt['q']?>" min="0" disabled />
	                    <div class="value-button increase-btn" value="Increase Value" onclick="ch_q('increase','<?=$showp['pid']?>','<?=$showp['newprice']?>')">+</div>
	                    <span class="stander" value="<?=$showp['pid']?>"><?=$showp['newprice']?></span>
	                </form>
                </div>
            </div>
		<?}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'الرجاء تسجيل الدخول لتستطيع عرض المحفوظات');
		echo $results = json_encode($results);
	}
}
else if($wut == "ch_q")
{
	$pid        = $_REQUEST['pid'];
	$q          = $_REQUEST['q'];
	$uid 		= USER_ID;
	$q       	= "UPDATE `cart` SET `q` = '$q' WHERE `pid` = '$pid' AND `uid` = '$uid'";
	$smd 		= $engine->connect()->query($q);
}
else if($wut == "add_book")
{
	$type       = $_REQUEST['type'];
	$name       = $_REQUEST['n'];
	$lnk        = $_REQUEST['l'];
	$grade      = $_REQUEST['g'];
	$subj       = $_REQUEST['s'];
	$teacher    = $_REQUEST['teacher'];
	$id         = $_REQUEST['id']; 
	if(!empty($name) && !empty($lnk)&& !empty($grade)&& !empty($subj))
	{
		if($type == 'add')
		{
			$q       = "INSERT IGNORE INTO `books` SET `name` = '$name' , `grade` = '$grade', `teacher` = '$teacher', `lnk` = '$lnk', `subj` = '$subj'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `books` SET `name` = '$name' , `grade` = '$grade', `teacher` = '$teacher', `lnk` = '$lnk', `subj` = '$subj' WHERE `id` = '$id'";
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة  الكتاب بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_subject")
{
	$type       = $_REQUEST['type'];
	$name       = $_REQUEST['n'];
	$teacher    = $_REQUEST['t'];
	$grade      = addslashes($_REQUEST['g']);
	$id         = $_REQUEST['id'];
	if(!empty($name) && !empty($teacher) && !empty($grade))
	{
		if($type == 'add')
		{
			$q       = "INSERT IGNORE INTO `subjcts` SET `sname` = '$name' , `teacher` = '$teacher' , `grades` = '$grade' ";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `subjcts` SET `sname` = '$name' , `teacher` = '$teacher' , `grades` = '$grade' WHERE `id` = '$id'";
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة  المادة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "add_rate")
{
	$type       = $_REQUEST['type'];
	$id         = $_REQUEST['id'];
	$to         = $_REQUEST['to'];
	$q1         = $_REQUEST['q1'];
	$q2         = $_REQUEST['q2'];
	$q3         = $_REQUEST['q3'];
	$q4         = $_REQUEST['q4'];
	$q5         = $_REQUEST['q5'];
	$q6         = $_REQUEST['q6'];
	$qrt        = "SELECT * FROM `users` WHERE `name` = '$to'";
	$smdrt      = $engine->connect()->query($qrt);
	$show       = $smdrt->fetch_array();
	if(!empty($to) && !empty($q1) && !empty($q2))
	{
		if($type == 'add')
		{
			$to      = $show['usrname'];
			$q       = "INSERT IGNORE INTO `rates` SET `rto` = '$to' , `q1` = '$q1' , `q2` = '$q2' , `q3` = '$q3' , `q4` = '$q4' , `q5` = '$q5' , `q6` = '$q6' , `type` = 'question' ";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `rates` SET `rto` = '$to' , `q1` = '$q1' , `q2` = '$q2' , `q3` = '$q3' , `q4` = '$q4' , `q5` = '$q5' , `q6` = '$q6' , `type` = 'question' WHERE `id` = '$id'";
		}
		$smd     = $engine->connect()->query($q);
		$qrt        = "SELECT * FROM `users` WHERE `usrname` = '$to'";
		$smdrt      = $engine->connect()->query($qrt);
		$show       = $smdrt->fetch_array();
		$to    = $show['id'];
		$title = "أضافت الإدارة تقيم لك";
		$msg   = "لقد قامت الإدارة بإضافة <br/> استفتاء جديد عنك <br/> لمشاهدة الاستفتاء اذهب <br/> للصفحة الشخصية الخاصة بك";
		$s_ntf = $engine->connect()->query("INSERT INTO `notf` (`to`,`title`,`txt`) VALUES ('$to','$title','$msg')");
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة  الاستفتاء بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً يجب أن تضيف سؤالين على الأقل');
	}
	echo $results = json_encode($results);
}

else if($wut == "add_sponser")
{
	$name       = $_REQUEST['name'];
	$section    = $_REQUEST['section'];
	$img 	    = $_REQUEST['img'];
	$link 	    = $_REQUEST['link'];
	if(!empty($name) && !empty($section) && !empty($link) && !empty($img))
	{
		
		$q       = "INSERT IGNORE INTO `sponsers` SET `name` = '$name' , `link` = '$link' , `baner` = '$img' , `section` = '$section'";
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة  الراعي بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب ترك الحقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "add_product")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$name       = addslashes(htmlspecialchars($_REQUEST['name']));
	$price      = addslashes(htmlspecialchars($_REQUEST['price']));
	$oprice     = addslashes(htmlspecialchars($_REQUEST['oldprice']));
	$addet      = addslashes(htmlspecialchars($_REQUEST['addet']));
	$desc       = addslashes(htmlspecialchars($_REQUEST['desc']));
	$sec        = addslashes(htmlspecialchars($_REQUEST['sec']));
	$tags       = addslashes(htmlspecialchars($_REQUEST['tags']));
	$ratio      = addslashes(htmlspecialchars($_REQUEST['ratio']));
	$amount     = addslashes(htmlspecialchars($_REQUEST['amount']));
	$uid        = USER_ID;
	$date       = date('Y-m-d G:i:s');
	if(USER_RANK == 1 || USER_RANK == 2)
	{
		$status = 1;
	}
	else
	{
		$status = 0;
	}
	if(!empty($name) && !empty($pid) && !empty($price) && !empty($addet) && !empty($desc))
	{
		if($type == 'add')
		{
			$q       = "INSERT IGNORE INTO `products` SET `pid` = '$pid', `name` = '$name', `uid` = '$uid', `section` = '$sec', `ad_det` = '$addet', `keys` = '$tags' , `desc` = '$desc' , `status` = '$status' , `oldprice` = '$oprice' , `newprice` = '$price',`amount` = '$amount',`ratio`='$ratio'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `products` SET `name` = '$name', `section` = '$sec' , `ad_det` = '$addet' , `keys` = '$tags' , `desc` = '$desc' , `status` = '$status' , `oldprice` = '$oprice' , `newprice` = '$price',`amount` = '$amount',`ratio`='$ratio' WHERE `pid` = '$pid'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة  المنتج بنجاح سيتم عرضه أولا على الإدارة للمراجعة وعند الموافقة عليه سيظهر تلقائياً');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "add_offers")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$name       = addslashes(htmlspecialchars($_REQUEST['name']));
	$price      = addslashes(htmlspecialchars($_REQUEST['price']));
	$oldprice   = addslashes(htmlspecialchars($_REQUEST['oldprice']));
	$addet      = htmlentities($_REQUEST['addet']);
	$desc       = htmlentities($_REQUEST['desc']);
	$sec        = addslashes(htmlspecialchars($_REQUEST['sec']));
	$tags       = addslashes(htmlspecialchars($_REQUEST['tags']));
	$edate      = addslashes(htmlspecialchars($_REQUEST['edate']));
	$date      	= addslashes(htmlspecialchars($_REQUEST['date']));
	$rstatus   	= addslashes(htmlspecialchars($_REQUEST['rstatus']));
	$cities  	= addslashes(htmlspecialchars($_REQUEST['cities']));
	$edate      = date('Y-m-d G:i:s', strtotime($edate));
	$date       = date('Y-m-d G:i:s', strtotime($date));
	$uid        = USER_ID;
	if(USER_RANK == 1 || USER_RANK == 2)
	{
		$status = 1;
	}
	else
	{
		$status = 0;
	}
	if(!empty($name) && !empty($pid) && !empty($price) && !empty($edate) && !empty($addet) && !empty($desc) && !empty($oldprice) && intval($oldprice) && intval($price))
	{
		if($type == 'add')
		{
			$q       = "INSERT IGNORE INTO `offers` SET `pid` = '$pid', `name` = '$name', `uid` = '$uid', `section` = '$sec', `ad_det` = '$addet', `keys` = '$tags' , `desc` = '$desc' , `status` = '$status' , `oldprice` = '$price' , `newprice` = '$oldprice',`edate` = '$edate',`date` = '$date', `rstatus` = '$rstatus', `city` = '$cities'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `offers` SET `pid` = '$pid', `name` = '$name', `section` = '$sec', `ad_det` = '$addet', `keys` = '$tags' , `desc` = '$desc' , `status` = '$status' , `oldprice` = '$price' , `newprice` = '$oldprice',`edate` = '$edate',`date` = '$date', `rstatus` = '$rstatus', `city` = '$cities' WHERE `pid` = '$pid'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			if(USER_RANK == 1 || USER_RANK == 2)
			{
				$results = array('status' => 1, 'details' => 'تم إضافة  العرض بنجاح');
			}
			else
			{
				$results = array('status' => 1, 'details' => 'تم إضافة  العرض بنجاح سيتم عرضه أولا على الإدارة للمراجعة وعند الموافقة عليه سيظهر تلقائياً');
			}
		}
	}
	else
	{
		if(!intval($oldprice) || !intval($price))
		{
			
			$results = array('status' => 0, 'details' => 'الرجاء إدخال سعر وخصم صحيحين');
		}
		else
		{
			
			$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
		}
	}
	echo $results = json_encode($results);
}

else if($wut == "add_deal")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$name       = addslashes(htmlspecialchars($_REQUEST['name']));
	$price      = addslashes(htmlspecialchars($_REQUEST['price']));
	$oldprice   = addslashes(htmlspecialchars($_REQUEST['oldprice']));
	$addet      = $_REQUEST['addet'];
	$desc       = $_REQUEST['desc'];
	$sec        = addslashes(htmlspecialchars($_REQUEST['sec']));
	$tags       = addslashes(htmlspecialchars($_REQUEST['tags']));
	$ratio      = addslashes(htmlspecialchars($_REQUEST['ratio']));
	$amount     = addslashes(htmlspecialchars($_REQUEST['amount']));
	$edate      = addslashes(htmlspecialchars($_REQUEST['edate']));
	$date      	= addslashes(htmlspecialchars($_REQUEST['date']));
	$rstatus   	= addslashes(htmlspecialchars($_REQUEST['rstatus']));
	$pranches  	= addslashes(htmlspecialchars($_REQUEST['pranches']));
	$cities  	= addslashes(htmlspecialchars($_REQUEST['cities']));
	$edate 		= date('Y-m-d');
	$edate      = date('Y-m-d', strtotime($edate. '+1day'));
	$date       = date('Y-m-d G:i:s', strtotime($date));
	$uid        = USER_ID;
	if(USER_RANK == 1 || USER_RANK == 2)
	{
		$status = 1;
	}
	else
	{
		$status = 0;
	}
	if(!empty($name) && !empty($pid) && !empty($price) && !empty($edate) && !empty($addet) && !empty($desc) && !empty($oldprice) && intval($oldprice) && intval($price))
	{
		if($type == 'add')
		{
			$q       = "INSERT IGNORE INTO `offers` SET `pid` = '$pid', `name` = '$name', `uid` = '$uid', `section` = '$sec', `ad_det` = '$addet', `keys` = '$tags' , `desc` = '$desc' , `status` = '$status' , `oldprice` = '$price' , `newprice` = '$oldprice',`amount` = '$amount',`ratio`='$ratio',`edate` = '$edate',`date` = '$date', `rstatus` = '$rstatus', `pranches` = '$pranches', `cities` = '$cities'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `offers` SET `pid` = '$pid', `name` = '$name', `section` = '$sec', `ad_det` = '$addet', `keys` = '$tags' , `desc` = '$desc' , `status` = '$status' , `oldprice` = '$price' , `newprice` = '$oldprice',`amount` = '$amount',`ratio`='$ratio',`edate` = '$edate',`date` = '$date', `rstatus` = '$rstatus', `pranches` = '$pranches', `cities` = '$cities' WHERE `pid` = '$pid'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة  العرض بنجاح سيتم عرضه أولا على الإدارة للمراجعة وعند الموافقة عليه سيظهر تلقائياً');
		}
	}
	else
	{
		if(!intval($oldprice) || !intval($price))
		{
			
			$results = array('status' => 0, 'details' => 'الرجاء إدخال سعر وخصم صحيحين');
		}
		else
		{
			
			$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
		}
	}
	echo $results = json_encode($results);
}

else if($wut == "add_ad")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$ad         = $_REQUEST['ad'];
	$uid        = USER_ID;
	if(!empty($ad))
	{
		if($type == 'add')
		{
			$check   = $engine->connect()->query("SELECT * FROM `ads`");
			$show_ad = $check->num_rows;
			if($show_ad < 1)
			{
				$q       = "INSERT IGNORE INTO `ads` SET `ad` = '$ad'";
			}
			else
			{
				$q       = "UPDATE `ads` SET `ad` = '$ad'";
			}
		}
		if($type == 'update')
		{
			$q       = "UPDATE `ads` SET `ad` = '$ad'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة الإعلان بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_pages")
{
	$type       = $_REQUEST['type'];
	$text       = htmlentities($_REQUEST['text']);
	if(!empty($text))
	{
		$q       = "UPDATE `siteinfo` SET $type = '$text'";
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_msub")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$terms      = $_REQUEST['terms'];
	$uid        = USER_ID;
	if(!empty($terms))
	{
		if($type == 'add')
		{
			$q       = "UPDATE `siteinfo` SET `msub` = '$terms'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `siteinfo` SET `msub` = '$terms'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_emp")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$terms      = $_REQUEST['terms'];
	$uid        = USER_ID;
	if(!empty($terms))
	{
		if($type == 'add')
		{
			$q       = "UPDATE `siteinfo` SET `emp` = '$terms'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `siteinfo` SET `emp` = '$terms'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_htuse")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$terms      = $_REQUEST['terms'];
	$uid        = USER_ID;
	if(!empty($terms))
	{
		if($type == 'add')
		{
			$q       = "UPDATE `siteinfo` SET `htuse` = '$terms'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `siteinfo` SET `htuse` = '$terms'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة كيفية الاستخدام بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_privacy")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$terms      = $_REQUEST['terms'];
	$uid        = USER_ID;
	if(!empty($terms))
	{
		if($type == 'add')
		{
			$q       = "UPDATE `siteinfo` SET `privacy` = '$terms'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `siteinfo` SET `privacy` = '$terms'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة كيفية الاستخدام بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_inbaner")
{
	$type       = $_REQUEST['type'];
	$pid        = addslashes(htmlspecialchars($_REQUEST['pid']));
	$baner      = $_REQUEST['baner'];
	$uid        = USER_ID;
	if(!empty($baner))
	{
		if($type == 'add')
		{
			$q       = "UPDATE `siteinfo` SET `baner` = '$baner'";
		}
		if($type == 'update')
		{
			$q       = "UPDATE `siteinfo` SET `baner` = '$baner'";
			
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم إضافة البانر الداخلي بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "upd_profile")
{
	$id         = USER_ID;
	$name       = $_REQUEST['n'];
	$mail       = $_REQUEST['m'];
	$mpassword  = $_REQUEST['ps'];
    $hash       = "#AHMHOZ#";
    $password   = md5(md5($hash.$mpassword.$hash));
	$num        = rand(1,1000);
	
	if(!empty($name) && !empty($mail) && !empty($password))
	{
		if(!empty($mpassword))
		{
			$q       = "UPDATE `users` SET  `password` = '$password', `name` = '$name' , `mail` = '$mail' WHERE `id` = '$id'";
			$_SESSION['password'] = $password ;
			$_SESSION['email'] = $mail ;
		}
		else
		{
			$q       = "UPDATE `users` SET `name` = '$name' , `mail` = '$mail' WHERE `id` = '$id'";
			$_SESSION['email'] = $mail ;
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم  تعديل البيانات بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "edt_user")
{
	$id         = $_REQUEST['id'];
	$name       = $_REQUEST['n'];
	$mail       = $_REQUEST['m'];
	$mpassword  = $_REQUEST['ps'];
	$active     = $_REQUEST['active'];
	$balance    = $_REQUEST['balance'];
    $hash       = "#AHMHOZ#";
    $password   = md5(md5($hash.$mpassword.$hash));
	$num        = rand(1,1000);
	
	if(!empty($name) && !empty($mail) && !empty($password))
	{
		if(!empty($mpassword))
		{
			$q       = "UPDATE `users` SET  `password` = '$password', `name` = '$name' , `mail` = '$mail', `balance` ='$balance', `active` = '$active' WHERE `id` = '$id'";
		}
		else
		{
			$q       = "UPDATE `users` SET `name` = '$name' , `mail` = '$mail', `balance` ='$balance', `active` = '$active' WHERE `id` = '$id'";
		}
		$smd     = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم  تعديل البيانات بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_tracker")
{
	$track      = $_REQUEST['track'];
	$status     = $_REQUEST['status'];
	$desc       = $_REQUEST['desc'];
	$step       = $_REQUEST['step'];
	$qt1        = "SELECT DISTINCT `pid` FROM `tracker` WHERE `track` = '$track'";
    $smdt1      = $engine->connect()->query($qt1);
    while($showt1   = $smdt1->fetch_array())
    {
    	$ptid       = $showt1['pid'];
    	$qgt        = $engine->connect()->query("SELECT * FROM `tracker` WHERE `pid` = '$ptid'");
    	$showqgt    = $qgt->fetch_array();
    	$track      = $showqgt['track'];
    	$qt         = "SELECT * FROM `tracker` WHERE `track` = '$track'";
    	$smdt       = $engine->connect()->query($qt);
    	$showt      = $smdt->fetch_array();
	    $uid        = $showt['uid'];
	    $pid        = $showt['pid'];
	    $seller     = $showt['seller'];
	    $receipt    = $showt['receipt'];
		if(!empty($track) && !empty($status) && !empty($desc) && !empty($step))
		{
			$q       = "INSERT IGNORE INTO `tracker` SET `track` = '$track' , `uid` = '$uid' , `pid` = '$pid', `status` = '$status' , `desc` = '$desc' , `step` = '$step' , `seller` = '$seller',`receipt` = '$receipt'";
			$smd     = $engine->connect()->query($q);
			$upd     = "UPDATE `sales` SET `status` = '$step' WHERE (`receipt` = '$receipt' AND `buyer` = '$uid')";
			$smdup   = $engine->connect()->query($upd);
			if($step == 3)
			{
				$upd2     = "UPDATE `purchases` SET `paystatus` = 'مكتملة ' WHERE (`receipt` = '$receipt' AND `uid` = '$uid')";
				$smdup2   = $engine->connect()->query($upd2);
				$qp       = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
				$showp    = $qp->fetch_array();
				$price    = $showp['newprice'];
				$mratio   = $showp['ratio'];
				$ratio    = $showp['ratio']/100;
				$balance  = $price - $ratio*$price;
				$qbalance = "INSERT INTO `trans` (`uid`,`type`,`val`,`title`,`pid`,`status`,`commission`) VALUES ('$seller','in','$balance','الربح من بيع المنتج : ','$pid','1','$mratio')";
				$smdbalance = $engine->connect()->query($qbalance);
				$ub       = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
				$gub      = $ub->fetch_array();
				$ubalance = $gub['balance'] + $balance;
				$pbalance = $gub['pbalance'];
				if($pbalance >= $balance)
				{
					$pbalance = $pbalance-$balance;
				}
				$snb      = $engine->connect()->query("UPDATE `users` SET `balance` = '$ubalance', `pbalance` = '$pbalance' WHERE `id` = '$seller'");

			}
			if($smd && $smdup)
			{
				
				$results = array('status' => 1, 'details' => 'تم تحديث الحالة بنجاح');
			}
		}
		else
		{
			
			$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
		}
	}
	echo $results = json_encode($results);
}
else if($wut == "track_status")
{
	$track      = $_REQUEST['track'];
	if(!empty($track))
	{
		$q    = "SELECT * FROM `tracker` WHERE `track` = '$track' ORDER BY `id` DESC";
		$smd  = $engine->connect()->query($q);
		$num  = $smd->num_rows;
		$show = $smd->fetch_array();
		$step = $show['step'];
		if($num >= 1)
		{
			include 'tracker_status.php';
		}
		else
		{
			
			$results = array('status' => 0, 'details' => 'عفواً هذا الرقم غير صحيح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "acc_comm")
{
	$id      = $_REQUEST['id'];
	if(!empty($id))
	{
		$q    = "UPDATE `comments` SET `status` = 1 WHERE `id` = '$id'";
		$smd  = $engine->connect()->query($q);
		if($smd)
		{
			$results = array('status' => 1, 'details' => 'تم الموافقة على التعليق بنجاح');
		}
		else
		{
			
			$results = array('status' => 0, 'details' => 'عفواً  هناك خطأ ما ');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "acc_pro")
{
	$id      = $_REQUEST['id'];
	$ratio   = $_REQUEST['ratio'];
	$table   = $_REQUEST['type'];
	if(!empty($id) && !empty($ratio))
	{
		$q    = "UPDATE $table SET `status` = 1, `ratio` = '$ratio' WHERE `pid` = '$id'";
		$smd  = $engine->connect()->query($q);
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم الموافقة على  المنتج بنجاح');
		}
		else
		{
			
			$results = array('status' => 0, 'details' => 'عفواً  هناك خطأ ما ');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن  تضع نسبة الموقع من المنتج');
	}
	echo $results = json_encode($results);
}
else if($wut == "sub_payment")
{
	$ptype      = $_REQUEST['ptype'];
	$shipping   = $_REQUEST['shipping'];
	$sh_cost    = $_REQUEST['sh_cost'];
	$track      = substr(sha1(mt_rand()),19,14);
	$uid        = USER_ID;
	$qc         = $engine->connect()->query("SELECT * FROM `cart` WHERE `uid` = '$uid'");
	$qadr       = $engine->connect()->query("SELECT * FROM `addresses` WHERE (`user` = '$uid' AND `main` = 1)");
	$showadr    = $qadr->fetch_array();
	$adrid      = $showadr['id'];
	$receipt    = substr(sha1(mt_rand()),19,14);
	if($ptype == 1)
	{
		$ptype     = 'الدفع عند الاستلام';
		$paystatus = 'غير مكتملة بعد';
	}
	while ($showc = $qc->fetch_array()) {
		$pid      = $showc['pid'];
		$pq       = $showc['q'];
		$qseller  = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
		$nm       = $qseller->num_rows;
		if($nm == 0)
		{
			$qseller  = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
		}
		$shseller = $qseller->fetch_array();
		$seller   = $shseller['uid'];
		$purchase = $engine->connect()->query("INSERT INTO `purchases` (`uid`,`pid`,`track`,`shipping`,`address`,`payment`,`paystatus`,`q`,`sh_cost`,`receipt`) VALUES ('$uid','$pid','$track','$shipping','$adrid','$ptype','$paystatus','$pq','$sh_cost','$receipt')");
		$sales    = $engine->connect()->query("INSERT INTO `sales` (`uid`,`pid`,`track`,`status`,`buyer`,`receipt`,`q`) VALUES ('$seller','$pid','$track',0,'$uid','$receipt','$pq')");
		$tracker  = $engine->connect()->query("INSERT INTO `tracker` (`track`,`uid`,`pid`,`status`,`desc`,`step`,`seller`,`receipt`,`q`) VALUES ('$track','$uid','$pid','قيد المراجعة','سيتم مراجعة المنتجات ثم الشحن','0','$seller','$receipt','$pq')");
	}
	if($purchase && $sales && $tracker)
	{
		
		$results = array('status' => 1, 'details' => 'تم تأكيد الشراء بنجاح, سيتم مراجعة المنتج ومن ثم الإرسال وسيتم إبلاغكم بذلك');
		$emcart = $engine->connect()->query("DELETE FROM `cart` WHERE `uid` = '$uid'");
	}
	echo $results = json_encode($results);
}

else if($wut == "delete")
{
	$type    = $_REQUEST['type'];
	$id      = $_REQUEST['id'];
	if(!empty($id))
	{
		$q       = "DELETE FROM $type WHERE `id` = '$id'";
		$smd     = $engine->connect()->query($q);
		$q2      = "DELETE FROM $type WHERE `pid` = '$id'";
		$smd2     = $engine->connect()->query($q2);
		if($smd ||$smd2)
		{
			
			$results = array('status' => 1, 'details' => 'تم الحذف بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_baner")
{
	$img    = $_REQUEST['img'];
	$lnk    = $_REQUEST['lnk'];
	if(!empty($img) && !empty($lnk))
	{
		$q       = "INSERT INTO `baners` (`img`,`lnk`) VALUES ('$img','$lnk')";
		$smd     = $engine->connect()->query($q) or die("ERROR");
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_slider")
{
	$name   = $_REQUEST['name'];
	$img    = $_REQUEST['img'];
	$lnk    = $_REQUEST['lnk'];
	if(!empty($img) && !empty($lnk))
	{
		$q       = "INSERT INTO `slides` (`img`,`lnk`,`name`) VALUES ('$img','$lnk','$name')";
		$smd     = $engine->connect()->query($q) or die("ERROR");
		if($smd)
		{
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_mark")
{
	$img    = $_REQUEST['img'];
	$lnk    = $_REQUEST['lnk'];
	if(!empty($img) && !empty($lnk))
	{
		$q       = "INSERT INTO `marks` (`img`,`lnk`) VALUES ('$img','$lnk')";
		$smd     = $engine->connect()->query($q) or die("ERROR");
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_section")
{
	$name    = $_REQUEST['name'];
	$img     = $_REQUEST['img'];
	$type    = $_REQUEST['type'];
	$id      = $_REQUEST['id'];
	if(!empty($name))
	{
		if($type == 'add')
		{
			$q       = "INSERT INTO `sections` (`name`, `img`) VALUES ('$name', '$img')";
		}
		else if($type == 'update')
		{
			$q       = "UPDATE `sections` SET `name`= '$name', `img` = '$img' WHERE `id` = '$id'";
		}
		$smd     = $engine->connect()->query($q) or die("ERROR");
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "add_subsection")
{
	$name    = $_REQUEST['name'];
	$msec    = $_REQUEST['msec'];
	$img     = $_REQUEST['img'];
	$type    = $_REQUEST['type'];
	$id      = $_REQUEST['id'];
	if(!empty($name)&& !empty($msec))
	{
		if($type == 'add')
		{
			$q       = "INSERT INTO `ssections` (`name`,`msec`,`img`) VALUES ('$name','$msec','$img')";
		}
		else if($type == 'update')
		{
			$q       = "UPDATE `ssections` SET `name` = '$name', `msec` = '$msec', `img` = '$img' WHERE `id` = '$id'";
		}
		$smd     = $engine->connect()->query($q) or die("ERROR");
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تمت الإضافة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "rnk")
{
	$type    = $_REQUEST['type'];
	$id      = $_REQUEST['id'];
	if(!empty($id))
	{
		$q       = "UPDATE `users` SET `rank` = '$type' WHERE `id` = '$id'";
		$smd     = $engine->connect()->query($q) or die("ERROR");
		if($smd)
		{
			
			$results = array('status' => 1, 'details' => 'تم تغيير الرتبة بنجاح');
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}

else if($wut == "add_cart")
{
	$pid       = $_REQUEST['pid'];
	$type      = $_REQUEST['type'];
	$uid       = USER_ID;
	$qcheck    = $engine->connect()->query("SELECT * FROM `cart` WHERE (`uid` = '$uid' AND `pid` = '$pid')");
	$showq     = $qcheck->fetch_array();
	$nm        = $qcheck->num_rows; 
	if(!empty($pid))
	{
		if(isset($_SESSION['email']) && isset($_SESSION['password']))
		{
			if($nm <= 0)
			{
				$insert = $engine->connect()->query("INSERT IGNORE INTO `cart` SET `pid` = '$pid',`uid` = '$uid', `q` = 1");
			}
			else
			{
				$q = $showq['q']+1;
				$insert = $engine->connect()->query("UPDATE `cart` SET `pid` = '$pid',`uid` = '$uid', `q` = '$q' WHERE (`uid` = '$uid' AND `pid` = '$pid')");
			}
			if($insert)
			{
				if($type == 'btn'){?>
					<button type="button" onclick='del_cart("<?=$pid?>","btn")' class="btn btn-danger">حذف من السلة</button>
				<?}else{
					
					$results = array('status' => 1, 'details' => 'تم إضافة المنتج للعربة');
				}
			}
		}
		else
		{
			if($type == 'btn')
			{
				echo "الرجاء تسجيل الدخول أولاً";
			}
			else{
				
				$results = array('status' => 0, 'details' => 'الرجاء تسجيل الدخول أولاً');
			}
		}
	}
	echo $results = json_encode($results);
}
else if($wut == "n_quant")
{
	$pid       = $_REQUEST['pid'];
	$q         = $_REQUEST['q'];
	$uid       = USER_ID; 
	if(!empty($pid) && !empty($q))
	{
		$engine->connect()->query("UPDATE `cart` SET `pid` = '$pid',`uid` = '$uid', `q` = '$q' WHERE (`uid` = '$uid' AND `pid` = '$pid')");
	}
}
else if($wut == "activate")
{
	$id    = $_REQUEST['id'];
	$qp      = "UPDATE `users` SET `active` = 1 WHERE `id` = '$id'";
	$smdp    = $engine->connect()->query($qp);
	if($smdp)
	{
		
		$results = array('status' => 1, 'details' => 'تم التفعيل بنجاح');
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً هناك خطأ ما');
	}
	echo $results = json_encode($results);
}
else if($wut == "del_cart")
{
	$pid     = $_REQUEST['name'];
	$type    = $_REQUEST['type'];
	$uid     = USER_ID;
	if(!empty($pid) || !empty($uid))
	{
		$one = $engine->connect()->query("DELETE FROM `cart` WHERE (`pid` = '$pid' AND `uid` = '$uid')");
		if($one)
		{
			if($type == 'btn')
			{?>
				<button type="button" onclick="add_cart('<?=$pid?>','btn')" class="btn btn-danger">إضافة للسلة</button>
			<?}
			else
			{
				
				$results = array('status' => 1, 'details' => 'تم حذف المنتج من السلة بنجاح');
			}
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا يجب أن تترك أي حقول فارغة');
	}
	echo $results = json_encode($results);
}
else if($wut == "send_msg")
{
	$msg       = $_REQUEST['msg'];
	$to        = $_REQUEST['to'];
	$uid       = USER_ID;
	$dt        = date('Y-m-d');
	$qi        = "INSERT INTO `messages` (`frm`,`to`,`msg`,`time`) VALUES ('$uid','$to','$msg','$dt')";
	$ins       = $engine->connect()->query($qi);
	if($ins)
	{
		$qsmsg = "SELECT * FROM `messages` WHERE (`frm` = '$to' AND `to` = '$uid' OR `frm` = '$uid' AND `to` = '$to')  ORDER BY `time` ASC";
        $smd_smsg = $engine->connect()->query($qsmsg);
        $q_read   = "UPDATE `messages` SET `status` = 1  WHERE (`frm` = '$to' AND `to` = '$uid')";
        $smd_read = $engine->connect()->query($q_read);
        while($show_msg = $smd_smsg->fetch_array()){
            if($show_msg['frm'] == $uid){?>
            <div class="ms-frm">
                <span><?=$show_msg['msg']?></span><br/>
                <small><?=$show_msg['time']?></small>
            </div>
            <?}
            if($show_msg['to'] == $uid){?>
            <div class="ms-to">
                <span><?=$show_msg['msg']?></span><br/>
                <small><?=$show_msg['time']?></small>
            </div>
            <div id="end"></div>
        <?}}?>
	<?}
}

else if($wut == "add_comm")
{
	$comment     = addslashes(htmlspecialchars($_REQUEST['comment']));
	$rating      = $_REQUEST['rating'];
	$uid         = $_REQUEST['uid'];
	$pid         = $_REQUEST['pid'];
	$thisid      = USER_ID;
	if(!empty($comment) && !empty($rating))
	{
		if($thisid == $uidd)
		{
			
			$results = array('status' => 0, 'details' => 'عفواً لا يمكتك التعليق على منتجك');
		}
		else
		{
			$q = "INSERT INTO `comments` (`from`,`to`,`comment`,`rate`,`status`,`uid`) VALUES ('$thisid','$pid','$comment','$rating',0,'$uid')";
			$smd = $engine->connect()->query($q);
			if($smd)
			{?>
				<div class="col-md-12 col-xs-12 comm">
					<div class="col-md-11 col-xs-11 c-cont">
						<div class="col-md-3 col-xs-3">
							الآن
						</div>
						<div class="col-md-9 col-xs-9 text-right">
							<b><?=USER_NAME?></b>
						</div>
						<div class="col-md-12 col-xs-12">
							<?=$comment?>
						</div>
					</div>
					<div class="col-md-1 col-xs-1 com-img text-left">
						<img src="<?=USER_IMG?>">
					</div>
				</div>
			<?}
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً يجب تقييم المنتج');
	}
	echo $results = json_encode($results);
}



else if($wut == "pwithdraw")
{
	$mail    	= addslashes(htmlspecialchars($_REQUEST['mail']));
	$amount  	= addslashes(htmlspecialchars($_REQUEST['amount']));
	$uid     	= USER_ID;
	$nb 		= USER_BALANCE - $amount;
	$trans		= rand(0,99999999999);
	if(!empty($mail) && !empty($amount))
	{
		if(USER_BALANCE == 0 || USER_BALANCE < $amount)
		{
			
			$results = array('status' => 0, 'details' => 'عفواً رصيدك لا يكفي لسحب هذا المبلغ');
		}
		else if($amount < 20)
		{
			
			$results = array('status' => 0, 'details' => 'عفواً أقل مبلغ يمكنك سحبه هو 20 '.DCRC.'');
		}
		else
		{
			$q1 = $engine->connect()->query("UPDATE `users` SET `balance` = '$nb' WHERE `id` = '$uid'");
			$q2 = $engine->connect()->query("INSERT INTO `withdraw` (`uid`,`type`,`mail`,`status`,`val`,`trans`) VALUES ('$uid','paypal','$mail',0,'$amount','$trans')");
			$q3 = $engine->connect()->query("INSERT INTO `trans` (`uid`,`type`,`status`,`val`,`trans`,`title`) VALUES ('$uid','out',0,'$amount','$trans','إرسال رصيد لبايبال')");
			if($q1 && $q2 && $q3)
			{
				
				$results = array('status' => 1, 'details' => 'تم إرسال طلب سحب رصيد وسيتم مراجعته في خلال 24 ساعة وإرسال المبلغ اوتوماتيكياً');
			}
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا تترك أي حقل فارغ');
	}
	echo $results = json_encode($results);
}
else if($wut == "bwithdraw")
{
	$name    	= addslashes(htmlspecialchars($_REQUEST['name']));
	$account  	= addslashes(htmlspecialchars($_REQUEST['account']));
	$amount  	= addslashes(htmlspecialchars($_REQUEST['amount']));
	$bname   	= addslashes(htmlspecialchars($_REQUEST['bname']));
	$uid     	= USER_ID;
	$nb 		= USER_BALANCE - $amount;
	$trans		= rand(0,99999999999);
	if(!empty($account) && !empty($amount) && !empty($name))
	{
		if(USER_BALANCE == 0 || USER_BALANCE < $amount)
		{
			
			$results = array('status' => 0, 'details' => 'عفواً رصيدك لا يكفي لسحب هذا المبلغ');
		}
		else if($amount < 20)
		{
			
			$results = array('status' => 0, 'details' => 'عفواً أقل مبلغ يمكنك سحبه هو 20 '.DCRC.'');
		}
		else
		{
			$q1 = $engine->connect()->query("UPDATE `users` SET `balance` = '$nb' WHERE `id` = '$uid'");
			$q2 = $engine->connect()->query("INSERT INTO `withdraw` (`uid`,`type`,`name`,`status`,`val`,`trans`,`account`,`bname`) VALUES ('$uid','bank','$name',0,'$amount','$trans','$account','$bname')");
			$q3 = $engine->connect()->query("INSERT INTO `trans` (`uid`,`type`,`status`,`val`,`trans`,`title`) VALUES ('$uid','out',0,'$amount','$trans','إرسال رصيد  حسابك البنكي')");
			if($q1 && $q2 && $q3)
			{
				
				$results = array('status' => 1, 'details' => 'تم إرسال طلب سحب رصيد وسيتم مراجعته في خلال 24 ساعة وإرسال المبلغ اوتوماتيكياً');
			}
		}
	}
	else
	{
		
		$results = array('status' => 0, 'details' => 'عفواً لا تترك أي حقل فارغ');
	}
	echo $results = json_encode($results);
}

else if($wut == "g_name")
{
	$name    	= addslashes(htmlspecialchars($_REQUEST['name']));
	if(!empty($name))
	{
		$smd = $engine->connect()->query("SELECT * FROM `users` WHERE (`name` LIKE '%$name%' AND `rank` <> 1 AND `rank` <> 2)");
		while ($show = $smd -> fetch_array())
		{?>
			<li onclick="choose('<?=$show[id]?>')">
				<img src="<?=$show['usrimg']?>">
				<?=$show['name']?>		
			</li>
		<?}
	}
	else
	{
		$results = array('status' => 0, 'details' => 'عفواً لا تترك أي حقل فارغ');
	}
	echo $results = json_encode($results);
}

?>