<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
require_once "core.php";
$key = addslashes(htmlspecialchars($_REQUEST['key']));
$req = addslashes(htmlspecialchars($_REQUEST['req']));
$uid = addslashes(htmlspecialchars($_REQUEST['id']));
if(isset($uid)) 
{
	$sl   = $engine->connect()->query("SELECT * FROM users WHERE `id` LIKE '%$uid%'");
	$us_data = $sl->fetch_array();
	$_SESSION['pass'] = $us_data['password'];
	$_SESSION['rank'] = $us_data['rank'];
	define(USER_UNAME,    $us_data['usrname']);
	define(USER_ID,       $us_data['id']);
	define(USER_NAME,     $us_data['name']);
	define(USER_MAIL,     $us_data['mail']);
	define(USER_RANK,     $us_data['rank']);
	define(USER_IMG,      $us_data['usrimg']); 
	define(USER_ACTIVE,  $us_data['country']);
	define(USER_BALANCE,  $us_data['balance']);
	define(USER_PBALANCE,  $us_data['pbalance']);
}
$upass = $_SESSION['pass'];
$urnk = $_SESSION['rank'];
if(isset($key) && $key == 'b555a3c23542867d108be9592df75f5f' && !empty($req))
{
	if($req == 'login')
	{
		$email     	= addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['user'] ))); 
	    $upassword	= htmlspecialchars(addslashes($_REQUEST['password'])); 
	    $hash     = "#AHMHOZ#";
		$npassword = md5(md5($hash.$upassword.$hash));
		if(!empty($email) && !empty($upassword))
		{
		 $check = $engine-> connect()->query("SELECT * FROM users WHERE (`mail`  = '$email' AND `password` = '$npassword')");
		 $ius   = $check-> num_rows;
		 if($ius <= 0)
		 {
		 	$check = $engine-> connect()->query("SELECT * FROM users WHERE (`usrname`  = '$email' AND `password` = '$npassword')");
			$ius   = $check->num_rows;
		 }
		 if($ius >= 1)
		 { 
		  	$_gett   = $check-> fetch_array();
		  	$id      = $_gett['id'];
		  	$uname   = $_gett['usrname'];
		  	$rnk     = $_gett['rank'];
		  	$name    = $_gett['name'];
		  	$ustatus = $_gett['active'];
		  	$img     = $_gett['usrimg'];
		    if($_gett['mail'] == $email || $_gett['usrname'] == $email && $npassword == $_gett['password'])
		    {     
		    	$_SESSION['id'] = $id;
				$_SESSION['pass'] = $npassword;
				$_SESSION['rank'] = $rnk;
		        $response = array();
				$response['posts'] = array('status' => '1','id' => $id, 'password'=>$npassword, 'name' => $name, 'rank'=> $rnk, `status` => $ustatus, 'u_name' => $uname, 'img' => $img);
				$response = json_encode($response);
		    }
		    else
		    {
		    	$response = array();
				$response['posts'] = array('status' => '0','details' => 'email or password is not correct' );
				$response = json_encode($response);
		    }
		    
		 }
		 else 
		    {
		      	$response = array();
				$response['posts'] = array('status' => '0','details' => 'email or password is not correct' );
				$response = json_encode($response);
		    }
		}
		else
		{
			$response = array();
			$response['posts'] = array('status' => '0','details' => 'empty data' );
			$response = json_encode($response);
		}
	}// end login
	else if($req == 'signup')
	{
		$email     	= addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['user'] ))); 
		$name     	= addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['name'] )));
		$type     	= addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['type'] ))); 
		$phone     	= addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['phone'] ))); 
	    $upassword	= htmlspecialchars(addslashes($_REQUEST['password'])); 
	    $hash     = "#AHMHOZ#";
		$password = md5(md5($hash.$upassword.$hash));
		$username = str_replace(' ', '_', $name);
		$vun      = $engine->connect()->query("SELECT * FROM users WHERE usrname = '$username' ");
		$vunn     = $vun-> num_rows;
		$num = rand(1,1000);
		$id  = md5("amed".$num."hoz");
		$img = S_URI."/assets/images/user.png";
		if($type == 0)
		{
			$active = 0;
		}
		else if($type == 2)
		{
			$active = 0;
		}
		else if($type == 3)
		{
			$active = 0;
		}
		
		if(!empty($email) && !empty($upassword))
		{
			if($vunn >= 1 )
			{
				$num       = rand(1,1000);
				$nusername =   $username.$num;
				$addusr   = $engine->connect()->query("INSERT INTO users (`id`,`mail`,`usrname`,`password`,`name`,`usrimg`,`rank`,`active`, `phone`) values ('$id','$email' ,'$nusername' ,'$password', '$name','$img','$type','$active', '$phone') ");
			}
			else
			{
				$addusr   = $engine->connect()->query("INSERT INTO users (`id`,`mail`,`usrname`,`password`,`name`,`usrimg`,`rank`,`active`, `phone`) values ('$id','$email' ,'$username' ,'$password', '$name','$img','$type','$active', '$phone') ");
			}
			if($addusr)
			{
				if($type == 3)
				{
					$status = 1;
					$det    = 'شكراً لانضمامك معنا في فاوتشر التجار, يرجى انتظار تفعيل الإدارة';
				}
				else if ($type == 2)
				{
					$status = 1;
					$det    = 'شكراً لانضمامك معنا في فاوتشر يرجى تفعيل عضويتك عبر البريد الإلكتروني المرسل لكم';
					$engine->thnx_msg($email);
				}
				else
				{
					$status = 1;
					$det    = 'شكراً لانضمامك معنا في فاوتشر يرجى تفعيل عضويتك عبر البريد الإلكتروني المرسل لكم';
					$engine->thnx_msg($email);
				}
			}
			else
			{
				$status = 0;
				$det    = 'خطأ أثناء التسجيل';
			}
		}
		else
		{
			$status = 0;
			$det    = 'لا تترك اي حقول فارغة';
		}
		$response = array();
		$response['posts'] = array('status' => $status,'details' => $det );
		$response = json_encode($response);
	}// end signup
	else if($req == 'add_cart')
	{
		$pid    = addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['pid'] ))); 
	    $uid	= htmlspecialchars(addslashes($_REQUEST['uid'])); 
	    if(!empty($pid) && !empty($uid))
	    {
	    	$qcheck    = $engine->connect()->query("SELECT * FROM `cart` WHERE (`uid` = '$uid' AND `pid` = '$pid')");
			$showq     = $qcheck->fetch_array();
			$nm        = $qcheck->num_rows;
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
				$response = array();
				$response['posts'] = array('status' => '1','details' => 'added to cart' );
				$response = json_encode($response);
			}
	    }
		else
		{
			$response = array();
			$response['posts'] = array('status' => '0','details' => 'empty data' );
			$response = json_encode($response);
		}
	}// end add to cart

	else if($req == 'used_voucher')
	{
		$qr     = addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['qrcode'] )));  
	    if(!empty($qr))
	    {
	    	$check  = $engine->connect()->query("SELECT * FROM `purchases` WHERE `qr` = '$qr'");
	    	$ch_num = $check->num_rows;
	    	if($ch_num >= 1)
	    	{
				$insert = $engine->connect()->query("UPDATE `purchases` SET `used` = '1' WHERE `qr` = '$qr'");
				if($insert)
				{
					$response = array();
					$response['posts'] = array('status' => '1','details' => 'تم استخدام الفاوتشر بنجاح');
					$response = json_encode($response);
				}
			}
			else
			{
				$response = array();
				$response['posts'] = array('status' => '0','details' => 'هذا الكود غير موجود ربما يكون مستخدم من قبل');
				$response = json_encode($response);
			}
	    }
		else
		{
			$response = array();
			$response['posts'] = array('status' => '0','details' => 'الرجاء إدخال الكود' );
			$response = json_encode($response);
		}
	}// end change q

	else if($req == 'changeq')
	{
		$pid    = addslashes(htmlspecialchars(str_replace(' ', '',$_REQUEST['pid'] ))); 
	    $uid	= htmlspecialchars(addslashes($_REQUEST['uid'])); 
	    $qtype	= htmlspecialchars(addslashes($_REQUEST['type'])); 
	    if(!empty($pid) && !empty($uid))
	    {
	    	$qcheck    = $engine->connect()->query("SELECT * FROM `cart` WHERE (`uid` = '$uid' AND `pid` = '$pid')");
			$showq     = $qcheck->fetch_array();
			$q         = $showq['q'];
			if($qtype == 'add')
			{
				$q  = $q+1;
				$insert = $engine->connect()->query("UPDATE `cart` SET  `q` = '$q' WHERE (`uid` = '$uid' AND `pid` = '$pid')");
			}
			else
			{
				if($q == 1)
				{
					$insert = $engine->connect()->query("DELETE FROM `cart` WHERE `uid` = '$uid' AND `pid` = '$pid'");
				}
				else
				{
					$q = $showq['q'];
					$q = $q-1;
					$insert = $engine->connect()->query("UPDATE `cart` SET  `q` = '$q' WHERE (`uid` = '$uid' AND `pid` = '$pid')");
				}
			}
			if($insert)
			{
				$response = array();
				$response['posts'] = array('status' => '1','details' => 'added to cart', 'q' => $q);
				$response = json_encode($response);
			}
	    }
		else
		{
			$response = array();
			$response['posts'] = array('status' => '0','details' => 'empty data' );
			$response = json_encode($response);
		}
	}// end change q

	else if($req == 'vouchers')
	{
		$uid   = $_REQUEST['uid'];
		$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = '1' ORDER BY `date` DESC");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$pid  = $show['pid'];
			$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$voucher = $show['oldprice']-$show['newprice'];
			$voucher = round($voucher/$show['oldprice']*100);

			$id   	 = $show['pid'];
			$img  	 = $shim['img'];
			$name 	 = $show['name'];
			$price 	 = $show['newprice'];
			$voucher = $voucher;
			$edate   = date('d/m',strtotime($show['edate']));
			$visits  = $show['visits'];
			$check_fav = $engine->connect()->query("SELECT * FROM `favs` WHERE `uid` = '$uid' AND `pid` = '$pid'");
			$fav_num   = $check_fav->num_rows;
			$rslts[$inc]  = (array('id' => $id, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits, 'faved' => $fav_num)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end voucher

	else if($req == 'my_vouchers')
	{
		$uid   = addslashes(htmlspecialchars($_REQUEST['uid']));
		$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE `uid` = '$uid' AND `status` = '1' ORDER BY `date` DESC");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$pid  = $show['pid'];
			$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$voucher = $show['oldprice']-$show['newprice'];
			$voucher = round($voucher/$show['oldprice']*100);

			$id   	 = $show['pid'];
			$img  	 = $shim['img'];
			$name 	 = $show['name'];
			$price 	 = $show['newprice'];
			$voucher = $voucher;
			$edate   = date('Y-m-d',strtotime($show['edate']));;
			$section = $show['section'];
			$visits  = $show['visits'];
			$rslts[$inc]  = (array('id' => $id, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits, 'section' => $section)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end my vouchers

	else if($req == 'notfs')
	{
		$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = '1' ORDER BY `date` DESC");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$pid  = $show['pid'];
			$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$voucher = $show['oldprice']-$show['newprice'];
			$voucher = round($voucher/$show['oldprice']*100);

			$id   	 = $show['pid'];
			$img  	 = $shim['img'];
			$name 	 = $show['name'];
			$price 	 = $show['newprice'];
			$voucher = $voucher;
			$edate   = date('d/m',strtotime($show['edate']));
			$visits  = $show['visits'];
			$rslts[$inc]  = (array('id' => $id, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end voucher

	else if($req == 'gbsec')
	{
		$type  = $_REQUEST['type'];
		if($type == 'new')
		{
			$date  = date('Y-m-d G:i:s');
			$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE (`status` = '1' AND `date` = '$date') ORDER BY `date` DESC");
		}
		else if($type == 'sales')
		{
			$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE (`status` = '1') ORDER BY `visits`");
		}
		else if($type == 'hours')
		{
			$date  = date('Y-m-d G:i:s');
			$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE (`status` = '1' AND `date` LIKE '%$date%') ORDER BY `date` DESC");
		}
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$pid  = $show['pid'];
			$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$voucher = $show['oldprice']-$show['newprice'];
			$voucher = round($voucher/$show['oldprice']*100);

			$id   	 = $show['pid'];
			$img  	 = $shim['img'];
			$name 	 = $show['name'];
			$price 	 = $show['newprice'];
			$voucher = $voucher;
			$edate   = date('d/m',strtotime($show['edate']));
			$visits  = $show['visits'];
			$rslts[$inc]  = (array('id' => $id, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end get_bsec

	else if($req == 'del_cart')
	{
		$pid   = addslashes($_REQUEST['pid']);
		$uid   = addslashes($_REQUEST['uid']);
		$qitem = $engine->connect()->query("DELETE FROM `cart` WHERE `uid` = '$uid' AND `pid` = '$pid'");
		$response = [];
		if($qitem)
		{
			$response['posts'] = array('status' => '1','details' => 'Deleted!');
		}
		else
		{
			$response['posts'] = array('status' => '0','details' => 'Error!');
		}
		$response = json_encode($response);
	} // end del cart

	else if($req == 'ex_pages')
	{
		$type  = addslashes($_REQUEST['type']);
		$response = [];
		$q = "SELECT * FROM `siteinfo`";
		$smd = $engine->connect()->query($q) or die('ERROR');
		$showsinfo = $smd->fetch_array();
		$txt = $showsinfo[$type];
		$response['posts'] = array('txt' => $txt);
		$response = json_encode($response);
	} // end ex_pages

	else if($req == 'staticts')
	{
		$uid   = addslashes($_REQUEST['uid']);
		$q     = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
		$gusr  = $q->fetch_array();
		if($gusr['balance'] == '')
		{
			$balance = 0;
		}
		else
		{
			$balance = $gusr['balance'];
		}
		if($gusr['ratio'] == '')
		{
			$ratio   = 0;
		}
		else
		{
			$ratio   = $gusr['ratio'];
		}
		$response = [];
		$response['posts'] = array('name' => $gusr['name'],'img' => $gusr['usrimg'],'mail' => $gusr['mail'],'balance' => $balance, 'ratio' => $ratio);
		$response = json_encode($response);
	} // end del cart
	else if($req == 'del_fav')
	{
		$pid   = addslashes($_REQUEST['pid']);
		$uid   = addslashes($_REQUEST['uid']);
		$qitem = $engine->connect()->query("DELETE FROM `favs` WHERE `uid` = '$uid' AND `pid` = '$pid'");
		$response = [];
		if($qitem)
		{
			$response['posts'] = array('status' => '1','details' => 'Deleted!');
		}
		else
		{
			$response['posts'] = array('status' => '0','details' => 'Error!');
		}
		$response = json_encode($response);
	} // end del fav
	else if($req == 'add_rate')
	{
		$pid   = addslashes($_REQUEST['pid']);
		$uid   = addslashes($_REQUEST['uid']);
		$rate  = addslashes($_REQUEST['stars']);
		$response = [];
		$check = $engine->connect()->query("SELECT * FROM `rating` WHERE (`pid` = '$pid' AND `uid` = '$uid')");
		$num   = $check->num_rows;
		if(!empty($pid) && !empty($uid) && !empty($rate))
		{
			if($num >= 1)
			{
				$response['posts'] = array('status' => '1','details' => 'added!');
			}
			else
			{
				$qitem = $engine->connect()->query("INSERT IGNORE INTO `rating` SET `uid` = '$uid', `pid` = '$pid', `rate` = '$rate'");
				if($qitem)
				{
					$response['posts'] = array('status' => '1','details' => 'added!');
				}
				else
				{
					$response['posts'] = array('status' => '0','details' => 'Error!');
				}
			}
		}
		else
		{
			$response['posts'] = array('status' => '0','details' => 'empty data!');
		}
		$response = json_encode($response);
	} // end add rate 
	else if($req == 'add_fav')
	{
		$pid   = addslashes($_REQUEST['pid']);
		$uid   = addslashes($_REQUEST['uid']);
		$check = $engine->connect()->query("SELECT * FROM `favs` WHERE `uid` = '$uid' AND `pid` = '$pid'");
		$num   = $check->num_rows;
		if($num <= 0)
		{
			$qitem = $engine->connect()->query("INSERT IGNORE INTO `favs` SET  `uid` = '$uid' , `pid` = '$pid'");
			$response = [];
			if($qitem)
			{
				$response['posts'] = array('status' => '1','details' => 'added successfully!');
			}
			else
			{
				$response['posts'] = array('status' => '0','details' => 'Error!');
			}
		}
		else
		{
			$response['posts'] = array('status' => '1','details' => 'added successfully!');
		}
		$response = json_encode($response);
	} // end add_fav
	else if($req == 'search')
	{
		$key   = addslashes($_REQUEST['k']);
		$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = '1' AND `name` LIKE '%$key%' ORDER BY `date` DESC");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$pid  = $show['pid'];
			$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$voucher = $show['oldprice']-$show['newprice'];
			$voucher = round($voucher/$show['oldprice']*100);

			$id   	 = $show['pid'];
			$img  	 = $shim['img'];
			$name 	 = $show['name'];
			$price 	 = $show['newprice'];
			$voucher = $voucher;
			$edate   = date('d/m',strtotime($show['edate']));
			$visits  = $show['visits'];
			$rslts[$inc]  = (array('id' => $id, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end search vouchers
	else if($req == 'baners')
	{

        $smd = $engine->connect()->query("SELECT * FROM `slides` ORDER BY `id` DESC");
        $response = [];
	    $inc = 0;
	    $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
        while($show = $smd->fetch_array())
        {
			$pid 	 = $show['id'];
			$img   	 = $show['img'];
			$lnk 	 = $show['lnk'];
			$rslts[$inc]  = (array('id' => $pid, 'img' => $img, 'lnk' => $lnk));
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end baners
	else if($req == 'purchases')
	{
		$uid = $_REQUEST['uid'];
        $smd = $engine->connect()->query("SELECT * FROM `purchases` WHERE `uid` = '$uid' ORDER BY `date` DESC");
        $response = [];
	    $inc = 0;
	    $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
        while($show = $smd->fetch_array())
        {
        	$pid   = $show['pid'];
			$puid  = $show['uid'];
			$qp    = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
			$showp = $qp->fetch_array();
	        $qu    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$puid'");
	        $showu = $qu->fetch_array();
	        $qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$rslts[$inc]  = (array('id' => $pid, 'name' => $showp['name'], 'price' => $showp['newprice'], 'date' => counttime($show['date']), 'track' => $show['qr'], 'pay_status' => $show['paystatus'], 'payment' => $show['payment'], 'img' => $shim['img']));
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end my purchases
	else if($req == 'sales')
	{
		$uid = $_REQUEST['uid'];
        $smd = $engine->connect()->query("SELECT * FROM `purchases` WHERE `saler` = '$uid' ORDER BY `date` DESC");
        $response = [];
	    $inc = 0;
	    $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
        while($show = $smd->fetch_array())
        {
        	$pid   = $show['pid'];
			$puid  = $show['uid'];
			$qp    = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
			$showp = $qp->fetch_array();
	        $qu    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$puid'");
	        $showu = $qu->fetch_array();
	        $qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$rslts[$inc]  = (array('id' => $pid, 'name' => $showp['name'], 'price' => $showp['newprice'], 'date' => counttime($show['date']), 'track' => $show['qr'], 'pay_status' => $show['paystatus'], 'payment' => $show['payment'], 'img' => $shim['img']));
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end my sales
	else if($req == 'bysection')
	{
		$sec   = $_REQUEST['sec'];
		$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = '1' AND `section` = '$sec' ORDER BY `date` DESC");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$pid  = $show['pid'];
			$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim = $qimg->fetch_array();
			$voucher = $show['oldprice']-$show['newprice'];
			$voucher = round($voucher/$show['oldprice']*100);

			$id   	 = $show['pid'];
			$img  	 = $shim['img'];
			$name 	 = $show['name'];
			$price 	 = $show['newprice'];
			$voucher = $voucher;
			$edate   = date('d/m',strtotime($show['edate']));
			$visits  = $show['visits'];
			$rslts[$inc]  = (array('id' => $id, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end bysection
	else if($req == 'show_voucher')
	{
		$uid   = $_REQUEST['uid'];
		$id    = $_REQUEST['id'];
		$qitem = $engine->connect()->query("SELECT * FROM `offers` WHERE `status` = '1' AND `pid` = '$id'");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		$show = $qitem->fetch_array();
		$pid  = $show['pid'];
		$qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
		while($shim = $qimg->fetch_array())
		{
			$img[$inc] = (array('img'=>$shim['img'])); 
			$inc++;
		}
		$cmp = 0;
		$mid      = $show['uid'];
		$pranches = $show['pranches'];
        $gcomp = $engine->connect()->query("SELECT * FROM `companies` WHERE `merchant` = '$mid' AND `name` LIKE '%$pranches%'");
		while($shcomp = $gcomp->fetch_array())
		{
			$comp[$cmp] = (array('name'=>$shcomp['name'],'address'=>$shcomp['address'],'contact'=>$shcomp['contact'], 'map' => $shcomp['map'])); 
			$cmp++;
		}
		$voucher = $show['oldprice']-$show['newprice'];
		$voucher = round($voucher/$show['oldprice']*100);
		$id   	 = $show['pid'];
		$oprice  = $show['oldprice'];
		$name 	 = $show['name'];
		$price 	 = $show['newprice'];
		$voucher = $voucher;
		$edate   = date('d/m',strtotime($show['edate']));
		$visits  = $show['visits'];
		$section = $show['section'];
		$ad_det  = strip_tags($show['ad_det']);
		$desc    = strip_tags($show['desc']);
		$check = $engine->connect()->query("SELECT * FROM `rating` WHERE (`pid` = '$id' AND `uid` = '$uid')");
		$rnum   = $check->num_rows;
		$check_fav = $engine->connect()->query("SELECT * FROM `favs` WHERE `uid` = '$uid' AND `pid` = '$pid'");
		$fav_num   = $check_fav->num_rows;
		if($show['rstatus'] == 1)
		{
			$rstatus = S_URI.'/assets/images/phonev.png';
		}
		else
		{
			$rstatus = S_URI.'/assets/images/accept.png';
		}
		if($rnum >= 1)
		{
			$showra = $check->fetch_array();
			$urate  = $showra['rate'];
			$rated  = 1;
		}
		else
		{
			$urate  = 0;
			$rated  = 0;
		}
		$rslts   = (array('id' => $id, 'imgs'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits, 'section' => $section, 'ad_det' => $ad_det, 'desc' => $desc,'urate' => $urate, 'rated' => $rated, 'comp' => $comp, 'loved' => $fav_num, 'old_price' => $oprice, 'rstatus' => $rstatus)); 
		$response['posts'] = $rslts;
		$inc++;
		$response = json_encode($response);
	} // end show voucher
	else if($req == 'mycart')
	{
		$uid   = $_REQUEST['uid'];
		$qitem = $engine->connect()->query("SELECT * FROM `cart` WHERE `uid` = '$uid'");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
        $tq = 0;
		while($show = $qitem->fetch_array())
		{
			$id   	 = $show['id'];
			$pid   	 = $show['pid']; 
			$q   	 = $show['q'];
			$gp      = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
			$showp   = $gp->fetch_array();
			$gimg    = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim    = $gimg->fetch_array();
			$voucher = $showp['oldprice']-$showp['newprice'];
			$voucher = round($voucher/$showp['oldprice']*100);
			$img  	 = $shim['img'];
			$name 	 = $showp['name'];
			$price 	 = $showp['newprice'];
			$voucher = $voucher;
			$tprice  = $showp['newprice']*$show['q'];
			$edate   = date('d/m',strtotime($showp['edate']));
			$visits  = $showp['visits'];
			$nprice  = $showp['newprice']*$show['q'];
			$tq      = $nprice+$tq;
			$rslts[$inc]  = (array('id' => $pid, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits,'q' => $q, 'tprice' => $tprice)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response['total'] = array('tprice' => $tq);
		$response = json_encode($response);
	} // end mycart
	else if($req == 'myfav')
	{
		$uid   = $_REQUEST['uid'];
		$qitem = $engine->connect()->query("SELECT * FROM `favs` WHERE `uid` = '$uid'");
		$response = [];
        $inc = 0;
        $response['userdata'] = array('uid' => $uid,'urank' => $urnk );
		while($show = $qitem->fetch_array())
		{
			$id   	 = $show['id'];
			$pid   	 = $show['pid'];
			$gp      = $engine->connect()->query("SELECT * FROM `offers` WHERE `pid` = '$pid'");
			$showp   = $gp->fetch_array();
			$gimg    = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
			$shim    = $gimg->fetch_array();
			$voucher = $showp['oldprice']-$showp['newprice'];
			$voucher = round($voucher/$showp['oldprice']*100);
			$img  	 = $shim['img'];
			$name 	 = $showp['name'];
			$price 	 = $showp['newprice'];
			$voucher = $voucher;
			$tprice  = $showp['newprice']*$show['q']+$tprice;
			$edate   = date('d/m',strtotime($showp['edate']));
			$visits  = $showp['visits'];
			$rslts[$inc]  = (array('id' => $pid, 'img'=> $img , 'name'=> $name, 'price' => $price, 'voucher' => $voucher, 'edate' => $edate, 'visits' => $visits, 'tprice' => $tprice)); 
			$response['posts'] = $rslts;
			$inc++;
		}
		$response = json_encode($response);
	} // end myfavs
	else
	{
		$locat = S_URI;
		header("location: ".$locat." ");
	}
}
else
{
	$locat = S_URI;
	header("location: ".$locat." ");
}
echo $response;
?>