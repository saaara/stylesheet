<?php
class engine 
{
	
	function __construct ()
	{
		if(DB_SERVER =="" && DB_ADMIN =="" &&DB_PASSW =="" && DB_NAME =="")
		{
			$location_install="http://".$_SERVER['SERVER_NAME']."/install";
			header("location:".$location_install."");
			exit();
		}
	}
 
 	public function connect()
	{
		$connect = new mysqli( DB_SERVER  ,  DB_ADMIN  , DB_PASSW , DB_NAME);
		if($connect -> connect_error)
		{
			$location_install="http://".$_SERVER['SERVER_NAME']."/install";
			header("location:".$location_install."");
			exit();
		}
		return $connect;
	}

	public function users ()
	{
		$q = "SELECT * FROM `users`";
		$smd = $this->connect()->query($q) or die('ERROR');
		echo $num = $smd-> num_rows . "</br>";
		while($show = $smd->fetch_array())
		{
			echo $show['usrname'];
		}

	}

	//sign up function 
	function signup ($email,$name,$password,$type,$ratio,$phone)
	{   
	    $locat    = S_URI . "/meet";
	    $hash     = "#AHMHOZ#";
	    $password = md5(md5($hash.$password.$hash));
		$username = str_replace(' ', '_', $name);
		$vun      = $this->connect()->query("SELECT * FROM users WHERE usrname = '$username' ");
		$vunn     = $vun-> num_rows;
		$num = rand(1,1000);
		$id  = md5("amed".$num."hoz");
		$img = S_URI."/assets/images/user.png";
		$ip  = $_SERVER['REMOTE_ADDR'];
		if($type == 0)
		{
			$active = 1;
		}
		else if($type == 2)
		{
			$active = 1;
		}
		else
		{
			$active = 0;
		}
		if($vunn >= 1 )
		{
			$num       = rand(1,1000);
			$nusername =   $username.$num;
			$addusr   = $this->connect()->query("INSERT INTO users (`id`,`mail`,`usrname`,`password`,`name`,`usrimg`,`rank`,`active`, `ratio`,`phone`) values ('$id','$email' ,'$nusername' ,'$password', '$name','$img','$type','$active', '$ratio','$phone') ");
		} 
		else
		{
			$addusr   = $this->connect()->query("INSERT INTO users (`id`,`mail`,`usrname`,`password`,`name`,`usrimg`,`rank`,`active`, `ratio`,`phone`) values ('$id','$email' ,'$username' ,'$password', '$name','$img','$type','$active','$ratio','$phone') ");
		}
		if($addusr)
		{
			if($type == 3)
			{
				$results = array('status' => 1, 'details' => 'تم التسجيل بنجاح وسيتم تعليق تشغيل حسابك حتى يتم مراجعته');
			}
			else if ($type == 2)
			{
				$results = array('status' => 1, 'details' => 'تم إنشاء حساب المشرف بنجاح');
			}
			else
			{
				$_SESSION['email'] = $email ;
			 	$_SESSION['password'] = $password ; 
			 	$_SESSION['startlogin'] = time();
				$results = array('status' => 1, 'details' => 'تم التسجيل في الموقع بنجاح');
			}
		}
		else
		{
			$results = array('status' => 0, 'details' => 'عفواً هناك خطأ ما');
		}
		echo $results = json_encode($results);
	}//end signup

//have session
	function havesession()
	{
		$mail = $_SESSION['email'];
		$pass = $_SESSION['password'];
		$q = $this->connect()->query("SELECT * FROM users WHERE `mail` = '$mail' AND `password` = '$pass' ");
		$num = $q-> num_rows;
		if(isset($_SESSION['email']) && isset($_SESSION['password']) && $num >= 1)
		{
			// $locat = $locat = S_URI."/dashboard";
			// header("location: ".$locat." ");
			return true;
		}
		else
		{
			return false;
		}
	}//end have session

//have session
	function permissions($admin,$moderator,$merchant,$user)
	{
		$this->checklogin();
		$rank = USER_RANK;
		if($admin == 0 AND $rank == 1)
		{
			$locat = $locat = S_URI.'/dashboard';
			header("location: ".$locat." ");
		}
		if($moderator == 0 AND $rank == 2)
		{
			$locat = $locat = S_URI.'/dashboard';
			header("location: ".$locat." ");
		}
		if($merchant == 0 AND $rank == 3)
		{
			$locat = $locat = S_URI.'/dashboard';
			header("location: ".$locat." ");
		}
		if($user == 0 AND $rank == 0)
		{
			$locat = $locat = S_URI;
			header("location: ".$locat." ");
		}
	}//end have session

//check login 
	function checklogin()
	{
		$mail    = htmlspecialchars(strip_tags(addslashes($_SESSION['email'])));
		$pass    = htmlspecialchars(strip_tags(addslashes($_SESSION['password'])));
		$q = $this-> connect()->query("SELECT * FROM users WHERE `mail` = '$mail' AND `password` = '$pass' ");
		$num = $q-> num_rows;
		if(!isset($_SESSION['email']) || !isset($_SESSION['password']) || $num <= 0)
		{
			$locat = $locat = S_URI;
			header("location: ".$locat." "); 
		}		
	}// end check login

// logout function 
	function logout($logout)
	{
		$usr  = USER_ID;
		if(isset($_SESSION['email']) || isset($_SESSION['password']))
		  $s_d = session_destroy();	
		  $u_s = session_unset();     // unset $_SESSION variable for the request`s page 
		  echo "<script>FB.logout();</script>";
		  if($s_d || $u_s)
		  {
			$locat = S_URI;
			header("location: ".$locat." ");
			exit();
		  }
		  else
		  {
		  	$u_s   = session_unset();
		  	if($u_s)
		  	{
		  		$locat = S_URI;
				header("location: ".$locat." ");
		  	}
		  }
		 
	}// end logout 

// login function 
	function login($email,$upassword)
	{
	    $email     	= addslashes(htmlspecialchars(str_replace(' ', '',$email ))); 
	    $upassword	= htmlspecialchars(addslashes($upassword));
	    $hash     	= "#AHMHOZ#";
		$npassword 	= md5(md5($hash.$upassword.$hash));
	    $locat   	= S_URI . "/dashboard";
		if(!empty($email) && !empty($upassword))
		{
		 $check = $this-> connect()->query("SELECT * FROM `users` WHERE (`mail`  = '$email' && `password` = '$npassword')");
		 $ius   = $check-> num_rows;
		 if($ius >= 1)
		 { 
		  	$_get  = $check-> fetch_array();
		    if($_get['mail'] == $email && $npassword == $_get['password'] && $_get['active'] != 0)
		    {     
		        $_SESSION['email'] = $email ;
		        $_SESSION['password'] = $npassword ;
		        if($_SESSION['email'] && $_SESSION['password'])
		        {
		        	$results = array('status' => 1, 'details' => 'تم تسجيل الدخول بنجاح');
		        }

		    }
		    else
		    {
		    	if($_get['active'] = 0)
		    	{
		    		$results = array('status' => 0, 'details' => 'عفواً لازال حسابك قيد المراجعة');
		    	}
		    	else
		    	{
		    		$results = array('status' => 0, 'details' => 'عفواً البريد الإلكتروني أو كلمة المرور غير صحيحة');
		    	}
		    }
		    
		 }
		 else 
		    {
		      $results = array('status' => 0, 'details' => 'عفواً البريد الإلكتروني أو كلمة المرور غير صحيحة');
		    }
		}
		else
		{
			$results = array('status' => 0, 'details' => 'عفواً البريد الإلكتروني أو كلمة المرور غير صحيحة');
		}
		echo $results = json_encode($results);
	}// end login 


// date format 
	function hijridt()
	{ 
		
		$month  = date(m);
		$myear  = date(Y);
		$hjyear = $myear - 579;
		return   $month.' - '.$hjyear; 
	}// end date format

// get language for multiple langs 
	function getlang($var)
	{
		if(isset($_SESSION['lang']))
		{
			$lang = $_SESSION['lang'];
			if($lang == "ar")
			{
				include("lang/ar.php");
				echo $lang[$var];
			}
			else if($lang == "eng")
			{
				include("lang/eng.php");
				echo $lang[$var];
			}
	    }
		else
		{
			include("lang/eng.php");
			echo $lang[$var];
		}
	}


// reset password 
	function resetpassword($email) 
	{
		$from       = "<info@".S_DOMAIN.">";
		$headers    = 'Reply-To: '. $from . "\r\n" ;
		$headers   .= 'From:'.$from . "\r\n";
		$headers   .='X-Mailer: PHP/7.2.0';
		$headers   .= "MIME-Version: 1.0\r\n";
		$headers   .= "Content-type: text/html; charset=UTF-8\r\n";
		$checkmail = $this->connect()->query("SELECT * FROM `users` WHERE `mail` = '$email'");
		$ifisset   = $checkmail-> num_rows;
		$newpass   = rand(1,999999999)."AMEHNPS"; // new password that will be sent for User 
		$hash     = "#AHMHOZ#";
		$password = md5(md5($hash.$newpass.$hash)); // new password after enc for DB
		$message   = "<div style=\" width:100%; background:#F2F2F2; border-radius:4px; padding:20px; text-align:center\"> 
		<img src=".S_IMG." style=\" width:200px; height:70px;\"/> <br/>
		 مرحباً, " .$email. "<br/> لقد قمنا بتغيير كلمة المرور الخاصة بك لذلك يمكنك استخدام كلمة المرور هذه لتسجيل الدخول <br/> <input type='text' value=".$newpass ." style='padding:4px; width:90%; height:25px; border-radius:4px;' /> <br/> إذا واجهتك أي مشاكل الرجاء الاتصال بنا </div>" ;
		$message   = str_replace("\n.", "\n..", $message);
		$to        = $email;
		$subject   = "Reset Password";
		$send= mail($to,$subject,$message,$headers); 
		if($send)
		{
			    $reseps = $this->connect()->query("UPDATE `users` SET `password`='$password' WHERE `mail` = '$email' ");
			    if($reseps)
			    {
			    	$this->sucmsg('لقد تم إرسال كلمة المرور الجديدة إلى البريد الإلكتروني الذي أدخلته');
			    }
			    else
			    {
			    	$this->errmsg('عفواً هناك خطأ ما');
			    }  
		}
		else
		{
		    $this->errmsg('عفواً لا يمكن إرسال البريد');
		}

	}// enbd reset password

// thnx message
	function thnx_msg($email) 
	{
		$from       = "<info@".S_DOMAIN.">";
		$headers    = 'Reply-To: '. $from . "\r\n" ;
		$headers   .= 'From:'.$from . "\r\n";
		$headers   .='X-Mailer: PHP/7.2.0';
		$headers   .= "MIME-Version: 1.0\r\n";
		$headers   .= "Content-type: text/html; charset=UTF-8\r\n";
		$checkmail = $this->connect()->query("SELECT * FROM `users` WHERE `mail` = '$email'");
		$ifisset   = $checkmail-> num_rows;
		$gud       = $checkmail->fetch_array();
		$uid       = $gud['id'];
		$date = date('d F Y H:i', strtotime(' + 120 minutes '));
		$date = strtotime($date);
		$newpass   = rand(1,999999999)."AMEHNPS"; // new password that will be sent for User 
		$hash     = "#AHMHOZ#";
		$password = md5(md5($hash.$newpass.$hash)); // new password after enc for DB
		$lnk       = S_URI.'/activate?ameh='.$password.'&u='.$uid.'&d='.$date;
		$message   = "<div style=\" width:100%; background:#F2F2F2; border-radius:4px; padding:20px; text-align:center\"> 
		<img src=".S_IMG." style=\" width:200px; height:70px;\"/> <br/>
		 مرحباً, " .$email. "<br/> شكراً لانضمامك لدى فاوتشر, لتفعيل الحساب الخاص بك يرجى اتباع الرابط التالي <br/> <a href=".$lnk." target='_blank' style='margin:20px;'>".$lnk."</a> <br/> إذا واجهتك أي مشاكل الرجاء الاتصال بنا </div>" ;
		$message   = str_replace("\n.", "\n..", $message);
		$to        = $email;
		$subject   = "Thank you For register with Voucher";
		$send= mail($to,$subject,$message,$headers); 
	}// enthnks message

// status function 
	function stats($table)
	{
		if($table == 'messages')
		{
			$q = $this->connect()->query("SELECT * FROM `messages`");
			echo $num = $q-> num_rows;
		}
		if($table == 'quotes')
		{
			$q = $this->connect()->query("SELECT * FROM `quotes`");
			echo $num = $q-> num_rows;
		}
		if($table == 'arts')
		{
			$q = $this->connect()->query("SELECT * FROM `arts`");
			echo $num = $q-> num_rows;
		}
	}// end status function 

// edit site function 
	function editsite($link,$name,$keys,$desc,$dcr,$phone,$mail,$locat)
	{
		
		if(!empty($link) && !empty($name) && !empty($keys) && !empty($desc))
		{
			if(preg_match("/^([http|https:\\/\\/])*[www\\.]*/i",$link))
				{
					$rp = preg_replace("/^([http|https:\\/\\/])*[www\\.]*/i",'',$link);
					if($rp)
					{
						$update = $this->connect()->query("UPDATE `siteinfo` SET `sname` = '$name' , `surl` = '$link' , `skeys` = '$keys' , `sdesc` = '$desc' , `dc` = '$dcr' , `sphone` = '$phone' , `smail` = '$mail' , `locat` = '$locat'");
						if($update)
						{?>
							<div class="alert alert-success">
					            <button type="button" aria-hidden="true" class="close">×</button>
					            <span>
				                <b> Done - </b> Your site has been edited "</span>
					        </div>
						<?}
					}
				}
		}
		else
		{?>
			<div class="alert alert-danger">
	            <button type="button" aria-hidden="true" class="close">×</button>
	            <span>
	            <b> Error - </b> Please insert data</span>
	        </div>
		<?}
	}// end site edite 

// messages (success and error)
	function errmsg($msg)
	{?>
	<div class="alert alert-danger col-md-12">
	    <button type="button" aria-hidden="true" class="close">×</button>
	    <span>
	    <b> خطأ - </b><?=$msg?></span>
	</div>
	<?}

	function sucmsg($msg)
	{?>
	<div class="alert alert-success col-md-12">
	    <button type="button" aria-hidden="true" class="close">×</button>
	    <span>
	    <b> عملية ناجحة- </b><?=$msg?></span>
	</div>
	<?}// end messages

// add portfolio 
	function addproduct($name,$keys,$section,$desc,$img1,$img2,$img3,$img4,$img5,$img6,$img7)
	{
		if( !empty($name)  && !empty($section) && !empty($desc) && !empty($img1))
		{
			$rnum  = rand(0,9999);
			$pid = str_replace(' ', '_', $name);
			$uid = USER_ID;
			$today = date('Y-m-d');
			$insertp = $this->connect()->query("INSERT INTO `products` 
			(`pid`,`pname`,`psection`,`pkeys`,`pdesc`,`pimg1`,`pimg2`,`pimg3`,`pimg4`,`pimg5`,`pimg6`,`pimg7`,`uid`,`date`) VALUES ('$pid','$name','$section','$keys','$desc','$img1','$img2','$img3','$img4','$img5','$img6','$img7','$uid','$today')");
			if($insertp)
			{
				$this->sucmsg('project added');
			}
			else
			{
				$this->errmsg('there was an error');
			}
			
		}
		else
		{
			
			if(empty($name))
			{
				$this->errmsg('عفواً لا يجب ترك اسم المنتج فارغاً');
			}
			else if(empty($section))
			{
				$this->errmsg('عفواً أختر القسم التابع له هذا المنتج');
			}
			else if(empty($desc))
			{
				$this->errmsg('عفواً لا يجب ترك وصف المنتج فارغاً');
			}
			else if(empty($img1))
			{
				$this->errmsg('يجب إضافة صورة واحدة على الأقل للمنتج');
			}
		}
	}// end add project 

// add article 
	function addart($name,$keys,$desc,$img1)
	{
		if( !empty($name)  && !empty($desc) && !empty($img1))
		{
			$pid = str_replace(' ', '_', $name);
			$uid = USER_ID;
			$today = date('Y-m-d');
			$insertp = $this->connect()->query("INSERT INTO `blog` 
			(`id`,`name`,`descr`,`tag`,`date`,`img`) VALUES ('$pid','$name','$desc','$keys','$today','$img1')");
			if($insertp)
			{
				$this->sucmsg('article added');
			}
			else
			{
				$this->errmsg('there was an error');
			}
			
		}
		else
		{
			
			if(empty($name))
			{
				$this->errmsg('عفواً لا يجب ترك اسم المنتج فارغاً');
			}
			else if(empty($desc))
			{
				$this->errmsg('عفواً لا يجب ترك وصف المنتج فارغاً');
			}
			else if(empty($img1))
			{
				$this->errmsg('يجب إضافة صورة واحدة على الأقل للمنتج');
			}
		}
	}// end add article

// show all projects
	function showprods($slink)
	{
		$thisid = USER_ID;
		$q = $this->connect()->query("SELECT * FROM `products`  ORDER BY pid DESC");
	?>
		<table class="table">
		    <thead class="text-primary rtl">
		        <td class="col-md-4">Project name</td>
		        <td class="col-md-4">Section</td>
		        <td class="col-md-4">more options</td>
		    </thead>
		    <tbody>
		        <?
		            while ($show = $q-> fetch_array()) {
		           	$pid = $show['pid'];
	           	?> 
		        <tr id="usr<?=$pid?>">
		            <td class="col-md-4"><a href="<?=S_URI?>/<?=$show['pid']?>" rel="tooltip" title="Show" target="_blank"><?=$show['pname']?></a></td>
		            <td class="col-md-4"><?=$show['psection']?></td>
		            <td class="col-md-4" id="loader<?=$pid?>">
		                <button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-xs" onclick="delany('<?=$slink?>','<?=$pid?>','delad')">
		                    <i class="material-icons">close</i>
		                </button>
		                <form action="editpost" method="get">
		                	<input type="hidden" name="gpid" value="<?=$pid?>">
			                <button type="submit" rel="tooltip" title="Edit" class="btn btn-success btn-xs">
			                    <i class="material-icons">mode_edit</i>
			                </button>
			            </form>
		            </td>
		        </tr>
		        <?}?>
		    </tbody>
		</table>
	<?}

// show all quotes
	function showquotes()
	{
		$thisid = USER_ID;
		$q = $this->connect()->query("SELECT * FROM `payments`  ORDER BY id DESC");
	?>
		<table class="table">
		    <thead class="text-primary rtl">
		        <td class="col-md-2">customer mail</td>
		        <td class="col-md-2">name</td>
		        <td class="col-md-2">phone</td>
		        <td class="col-md-2">price</td>
		        <td class="col-md-2">date</td>
		        <td class="col-md-1">status</td>
		        <td class="col-md-1">options</td>
		    </thead>
		    <tbody>
		        <?
		            while ($show = $q-> fetch_array()) {
		           	$pid = $show['id'];
	           	?> 
		        <tr id="usr<?=$pid?>">
		            <td class="col-md-2">
		            	<?=$show['mail']?>
		            </td>
		            <td class="col-md-2">
		            	<?=$show['name']?>
		            </td>
		            <td class="col-md-2">
		            	<?=$show['phone']?>
		            </td>
		            <td class="col-md-2">
		            	<?=$show['cost']?>		
		            </td>
		            <td class="col-md-2">
		            	<?=$show['date']?>		
		            </td>
		            <td class="col-md-1">
		            	<?php
		            		if($show['status'] == 0)
		            		{
		            			echo "unpaid";
		            		}
		            		else
		            		{
		            			echo "paid";
		            		}
		            	?>
		            </td>
		            <td class="col-md-1" id="loader<?=$pid?>">
		                <button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-xs" onclick="delany('<?=$slink?>','<?=$pid?>','delpay')">
		                    <i class="material-icons">close</i>
		                </button>
		            </td>
		        </tr>
		        <?}?>
		    </tbody>
		</table>
	<?}



// show all articles
	function showart($slink)
	{
		$thisid = USER_ID;
		$q = $this->connect()->query("SELECT * FROM `blog`  ORDER BY id DESC");
	?>
		<table class="table">
		    <thead class="text-primary rtl">
		        <td class="col-md-3">article name</td>
		        <td class="col-md-3">Tag</td>
		        <td class="col-md-3">Date</td>
		        <td class="col-md-3">more options</td>
		    </thead>
		    <tbody>
		        <?
		            while ($show = $q-> fetch_array()) {
		           	$pid = $show['pid'];
	           	?> 
		        <tr id="usr<?=$pid?>">
		            <td class="col-md-3"><a href="<?=S_URI?>/art?art=<?=$show['id']?>" rel="tooltip" title="Show" target="_blank"><?=$show['name']?></a></td>
		            <td class="col-md-3"><?=$show['tag']?></td>
		            <td class="col-md-3"><?=$show['date']?></td>
		            <td class="col-md-3" id="loader<?=$pid?>">
		                <button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-xs" onclick="delany('<?=$slink?>','<?=$pid?>','delart')">
		                    <i class="material-icons">close</i>
		                </button>
		                <form action="editpost" method="get">
		                	<input type="hidden" name="gpid" value="<?=$pid?>">
			                <button type="submit" rel="tooltip" title="Edit" class="btn btn-success btn-xs">
			                    <i class="material-icons">mode_edit</i>
			                </button>
			            </form>
		            </td>
		        </tr>
		        <?}?>
		    </tbody>
		</table>
	<?}// end show all articles


// edit portfolio function 
	function edtpro($name,$keys,$section,$desc,$img1,$img2,$img3,$img4,$img5,$img6,$img7,$pid)
	{
		if( !empty($name)  && !empty($section) && !empty($desc))
		{
			$desc  = strip_tags(htmlspecialchars(addslashes($desc)));
			$rnum  = rand(0,9999);
			$uid = USER_ID;
			$today = date('Y-m-d');

			if(empty($img1))
			{
				$q =  "UPDATE `products` SET  `pname` = '$name' , `psection` = '$section' , `pkeys` = '$keys' , `pdesc` = '$desc' , `date` = '$today'  WHERE `pid` = '$pid'";
			}
			else if(isset($img1))
			{
				$q = "UPDATE `products` SET   `pname` = '$name' , `psection` = '$section' , `pkeys` = '$keys' , `pdesc` = '$desc' , `date` = '$today' , `pimg1` = '$img1' , `pimg2` = '$img2' , `pimg3` = '$img3' , `pimg4` = '$img4' , `pimg5` = '$img5' , `pimg6` = '$img6' , `pimg7` = '$img7'  WHERE `pid` = '$pid'";
			}
			$insertp = $this->connect()->query($q);
			if($insertp)
			{
				$this->sucmsg('Your post has been edited');
			}
			else
			{
				$this->errmsg('sorry there is something wrong');
			}
		}
		else
		{
			if(empty($name))
			{
				$this->errmsg('عفواً لا يجب ترك اسم المنتج فارغاً');
			}
			else if(empty($section))
			{
				$this->errmsg('عفواً أختر القسم التابع له هذا المنتج');
			}
			else if(empty($desc))
			{
				$this->errmsg('عفواً لا يجب ترك وصف المنتج فارغاً');
			}
			else if(empty($img1))
			{
				$this->errmsg('يجب إضافة صورة واحدة على الأقل للمنتج');
			}
		}
	}// edit portfolio function 

// requesta quote function 
	function request_quote($name,$phone,$mail,$subj,$msg,$wtype,$wpages,$whost,$hspace,$rdnotes)
	{
		if(!empty($name) && !empty($phone) && !empty($mail) && !empty($subj) && !empty($msg))
		{
			if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				$this->errmsg('please insert a correct E-mail');
			}
			if($subj == 'web' && !isset($whost))
			{
				$this->errmsg('please select hosting type for your site');
			}
			if($subj == 'host' && !intval($hspace))
			{
				$this->errmsg('please insert an integer value for hosting space');
			}
			else
			{
				$q = "INSERT INTO `quote` (`name`,`phone`,`mail`,`type`,`message`,`wtype`,`wpages`,`whost`,`hspace`,`rdnotes`)      VALUES ('$name','$phone','$mail','$subj','$msg','$wtype','$wpages','$whost','$hspace','$rdnotes')" or die("ERROR");
				$smd = $this->connect()->query($q);
				if($smd)
				{
					$this->sucmsg('your request has been sent , we will reply as soon as possible');
				}
				else
				{
					$this->errmsg('Sorry there is something wrong');
				}
			}
		}
		else
		{
			$this->errmsg('please fill all fields');
		}
	}// end request quotes

// text limitation function 
	function limtxt($num,$string)
	{
		if (strlen($string) > $num) {
	    $stringCut = substr($string, 0, $num);
	    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).' ...'; 
		}
		echo $string;
	}// end text limitation



// send mail
	function send_mail($email,$message,$req)
	{
		$from       = "<invoices@".S_DOMAIN.">";
		$headers    = 'Reply-To: '. $from . "\r\n" ;
		$headers   .= 'From:'.$from . "\r\n";
		$headers   .='X-Mailer: PHP/' . phpversion();
		$headers   .= "MIME-Version: 1.0\r\n";
		$headers   .= "Content-type: text/html; charset=UTF-8\r\n";
		$to        = $email;
		$subject   = "Invoice your request : ".$req;
		if(!empty($email)) 
		{
		   $send= mail($to,$subject,$message,$headers); 
		   
		   if($send)
		   {
		   	  $this->sucmsg('You invoice mail has been sent to user successfuly');  
		   }
		   else
		   {
			    $this->errmsg('sorry your invoice mail wasnt sent');
		   }
		}
		else
		{
			 	$this->errmsg('please inter a valid E-mail');
		}
	}// enbd send mail

	function rate($pid)
	{
		
		$qr    = "SELECT * FROM `comments` WHERE (`to` = '$pid' AND `status` = 1)";
		$smdr  = $this->connect()->query($qr);
		$showr = $smdr->fetch_array();
		$num   = $showr['rate'];

		if($num == 0)
		{
			echo"
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
			";
		}
		else if($num == 1)
		{
			echo"
				<i class='fa fa-star fa-gold'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
			";
		}
		else if($num == 2)
		{
			echo"
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
			";
		}
		else if($num == 3)
		{
			echo"
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='far fa-star'></i>
				<i class='far fa-star'></i>
			";
		}
		else if($num == 4)
		{
			echo"
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='far fa-star'></i>
			";
		}
		else if($num == 5)
		{
			echo"
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
				<i class='fa fa-star fa-gold'></i>
			";
		}
	}
// avrg rate
	function avgrate($usr)
	{
		$q 		 = "SELECT * FROM `comments` WHERE `to` = '$usr'";
		$smd     = $this->connect()->query($q);
		$num 	 = $smd->num_rows;
		$sum 	 = "SELECT SUM(rate) AS total FROM `comments` WHERE `to` = '$usr'";
		$smds    = $this->connect()->query($sum);
		$row     = $smds->fetch_array();
		$total   = $row['total'];
		if($total != 0 || $num != 0)
		{
			$avg     = round($total/$num);
		}
		else
		{
			$avg = 0;
		}
		echo $this->rate($avg) .'( '.$avg.' )';

	}
// get slides 
	function gslides($place,$type)
	{
		$q 		 = "SELECT * FROM `slides` WHERE `place` = '$place'";
		$smd     = $this->connect()->query($q);
		$show    = $smd->fetch_array();
		return   $show[$type];
	}
// get query
	function get_query($query)
	{
		return $this->connect()->query($query);
	}
// get photos
	function get_photos($pid)
	{
		return $this->get_query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
	}
// is in favourites
	function isfav($pid,$uid="")
	{
		if(!isset($uid) || empty($uid))
		{
			$uid = USER_ID;
		}
		$check = $this->get_query("SELECT * FROM `favs` WHERE `pid` = '$pid' AND `uid` = '$uid'");
		$num 	= $check->num_rows;
		return $num <= 0 ? false : true;
	}
// text filtration
	function filter_text($text)
	{
		return addslashes(htmlspecialchars(strip_tags($text)));
	}	
}//end class


?>
