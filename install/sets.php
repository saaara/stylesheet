<?php
ob_start();
session_start();
date_default_timezone_set(UTC);
// get the db connection
require_once"../core/config/config.php";
$step = strip_tags(addslashes($_GET['step']));
if($step=="info" || $step=="admin_info" || $step=="finish")
{
$con = mysqli_connect( DB_SERVER , DB_ADMIN ,DB_PASSW );
$select  = mysqli_select_db($con,DB_NAME);
}

function connectdb($srvername,$dbusr,$datapass,$dbsnm) 
{
$conect = mysqli_connect( $srvername , $dbusr , $datapass ); 
$sdb    = mysqli_select_db($conect, $dbsnm );

$n = 0; 
$query = mysqli_query($conect,"CREATE TABLE IF NOT EXISTS `siteinfo` ( 
`sname` VARCHAR( 255 ) NOT NULL ,
`surl` TEXT NOT NULL ,
`skeys` TEXT NOT NULL ,
`sdesc`  TEXT NOT NULL ,
`favicon` TEXT NOT NULL ,
`slogo` TEXT NOT NULL ,
`smail` VARCHAR(255) NOT NULL ,
`sphone` VARCHAR(255) NOT NULL ,
`terms` TEXT NOT NULL,
`about` TEXT NOT NULL,
`word` TEXT NOT NULL,
`privacy` TEXT NOT NULL,
`contact` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 1

$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `users` (
`id` VARCHAR(255) NOT NULL ,
`usrname` VARCHAR( 255 ) NOT NULL ,
`password` TEXT NOT NULL ,
`mail` TEXT NOT NULL ,
`phone` TEXT NOT NULL ,
`name` VARCHAR(255) NOT NULL ,
`balance` VARCHAR(255) NOT NULL ,
`pbalance` VARCHAR(255) NOT NULL ,
`ratio` VARCHAR(255) NOT NULL ,
`usrimg` TEXT NOT NULL ,
`rank` INT NOT NULL ,
`active` INT NOT NULL 
) ENGINE = MYISAM");
if($query)$n++; 
// table 2

$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `products` (
`pid` VARCHAR(255) NOT NULL ,
`name` VARCHAR(255) NOT NULL ,
`uid` VARCHAR(255) NOT NULL ,
`section` VARCHAR(255) NOT NULL ,
`ad_det` VARCHAR(255) NOT NULL ,
`oldprice` VARCHAR(255) NOT NULL ,
`newprice` VARCHAR(255) NOT NULL ,
`ratio` VARCHAR(255) NOT NULL ,
`city` VARCHAR(255) NOT NULL ,
`keys` TEXT NOT NULL ,
`desc` TEXT NOT NULL ,
`amount` INT  NOT NULL ,
`status` INT  NOT NULL ,
`visits` INT  NOT NULL ,
`date` TIMESTAMP NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 3
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `messages` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`name` VARCHAR(255) NOT NULL , 
`subject` VARCHAR(255) NOT NULL , 
`message` TEXT NOT NULL , 
`mail` VARCHAR(255) NOT NULL , 
`date` TIMESTAMP NOT NULL , 
`status` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 4
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `photos` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`pid` VARCHAR(255) NOT NULL , 
`img` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 5
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `addresses` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`user` VARCHAR(255) NOT NULL ,
`country` VARCHAR(255) NOT NULL ,
`city` VARCHAR(255) NOT NULL ,
`address` TEXT NOT NULL ,
`phone` VARCHAR(255) NOT NULL ,
`main` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 6
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `tracker` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`track` VARCHAR(255) NOT NULL ,
`uid` VARCHAR(255) NOT NULL ,
`pid` VARCHAR(255) NOT NULL ,
`status` VARCHAR(255) NOT NULL ,
`seller` VARCHAR(255) NOT NULL ,
`receipt` VARCHAR(255) NOT NULL ,
`desc` TEXT NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`q` INT NOT NULL,
`step` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 7
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `comments` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`from` VARCHAR(255) NOT NULL ,
`to` VARCHAR(255) NOT NULL ,
`comment` VARCHAR(255) NOT NULL ,
`uid` VARCHAR(255) NOT NULL ,
`rate` INT NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`status` INT NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 8
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `reports` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`from` VARCHAR(255) NOT NULL ,
`to` VARCHAR(255) NOT NULL ,
`phone` VARCHAR(255) NOT NULL ,
`type` VARCHAR(255) NOT NULL ,
`msg` VARCHAR(255) NOT NULL ,
`uid` VARCHAR(255) NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`status` INT NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 9
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `search` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`word` VARCHAR(255) NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`num` INT NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 10
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `sales` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`uid` VARCHAR(255) NOT NULL ,
`pid` VARCHAR(255) NOT NULL ,
`buyer` VARCHAR(255) NOT NULL ,
`track` VARCHAR(255) NOT NULL ,
`receipt` VARCHAR(255) NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`status` INT NOT NULL ,
`q` INT NOT NULL,
`num` INT NOT NULL ,
`qr`  VARCHAR(255) NOT NULL ,
`used` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 11
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `purchases` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`uid` VARCHAR(255) NOT NULL ,
`saler` VARCHAR(255) NOT NULL ,
`pid` VARCHAR(255) NOT NULL ,
`address` VARCHAR(255) NOT NULL ,
`shipping` VARCHAR(255) NOT NULL ,
`receipt` VARCHAR(255) NOT NULL ,
`payment` VARCHAR(255) NOT NULL ,
`paystatus` VARCHAR(255) NOT NULL ,
`sh_cost` VARCHAR(255) NOT NULL ,
`q` INT NOT NULL,
`date` TIMESTAMP NOT NULL,
`track`  VARCHAR(255) NOT NULL ,
`qr`  VARCHAR(255) NOT NULL ,
`used` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 12
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `baners` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`img` TEXT NOT NULL,
`lnk` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 13
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `offers` (
`pid` VARCHAR(255) NOT NULL ,
`name` VARCHAR(255) NOT NULL ,
`uid` VARCHAR(255) NOT NULL ,
`section` VARCHAR(255) NOT NULL ,
`ad_det` VARCHAR(255) NOT NULL ,
`oldprice` VARCHAR(255) NOT NULL ,
`newprice` VARCHAR(255) NOT NULL ,
`ratio` VARCHAR(255) NOT NULL ,
`city` VARCHAR(255) NOT NULL ,
`keys` TEXT NOT NULL ,
`desc` TEXT NOT NULL ,
`pranches` TEXT NOT NULL ,
`status` INT  NOT NULL ,
`amount` INT  NOT NULL ,
`visits` INT  NOT NULL ,
`rstatus` INT  NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`edate` TIMESTAMP NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 14
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `cart` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`pid` VARCHAR(255) NOT NULL ,
`uid` VARCHAR(255) NOT NULL ,
`q`   INT NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 15
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `sections` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`img` TEXT NOT NULL, 
`name` VARCHAR(255) NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 16
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `trans` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`uid` VARCHAR(255) NOT NULL ,
`type` VARCHAR(255) NOT NULL ,
`val` VARCHAR(255) NOT NULL ,
`title` VARCHAR(255) NOT NULL ,
`pid` VARCHAR(255) NOT NULL ,
`trans` VARCHAR(255) NOT NULL ,
`commission` VARCHAR(255) NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`status` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 17
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `withdraw` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`uid` VARCHAR(255) NOT NULL ,
`type` VARCHAR(255) NOT NULL ,
`val` VARCHAR(255) NOT NULL ,
`mail` VARCHAR(255) NOT NULL ,
`name` VARCHAR(255) NOT NULL ,
`account` VARCHAR(255) NOT NULL ,
`trans` VARCHAR(255) NOT NULL ,
`bname` VARCHAR(255) NOT NULL ,
`date` TIMESTAMP NOT NULL ,
`status` INT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 18
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `marks` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`img` TEXT NOT NULL,
`lnk` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 19
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `ssections` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`name` VARCHAR(255) NOT NULL ,
`img` TEXT NOT NULL,
`msec` VARCHAR(255) NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 20
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `favs` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`uid` VARCHAR(255) NOT NULL ,
`pid` VARCHAR(255) NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 21
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `rating` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`uid` VARCHAR(255) NOT NULL ,
`pid` VARCHAR(255) NOT NULL ,
`rate` INT NOT NULL 
) ENGINE = MYISAM");
if($query)$n++;
// table 22
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `slides` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`img` TEXT NOT NULL,
`lnk` TEXT NOT NULL,
`name` VARCHAR(255) NOT NULL,
`place` VARCHAR(255) NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 23
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `companies` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`merchant` VARCHAR(255) NOT NULL,
`name` VARCHAR(255) NOT NULL,
`ename` VARCHAR(255) NOT NULL,
`img` TEXT NOT NULL,
`address` TEXT NOT NULL,
`contact` TEXT NOT NULL,
`place` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 24
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `ads` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`ad` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 25
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `news` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`title` VARCHAR(255) NOT NULL,
`section` VARCHAR(255) NOT NULL,
`date` DATE NOT NULL,
`img` TEXT NOT NULL,
`text` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 26
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `blog_sections` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`type` VARCHAR(255) NOT NULL,
`name` VARCHAR(255) NOT NULL,
`msection` VARCHAR(255) NOT NULL,
`img` TEXT NOT NULL,
`baner` TEXT NOT NULL,
`text` TEXT NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 27
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `sponsers` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`name` VARCHAR(255) NOT NULL,
`link` VARCHAR(255) NOT NULL,
`section` VARCHAR(255) NOT NULL,
`baner` TEXT NOT NULL,
`pid` VARCHAR(255) NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 28
$query = mysqli_query($conect,"CREATE TABLE  IF NOT EXISTS `cities` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`name` VARCHAR(255) NOT NULL
) ENGINE = MYISAM");
if($query)$n++;
// table 29
$open  = fopen("../core/config/config.php",w);
$write = fwrite($open , "<?php
define(DB_SERVER   , '$srvername'); 
define(DB_ADMIN    , '$dbusr');
define(DB_PASSW    , '$datapass');
define(DB_NAME     , '$dbsnm');
?>");
$close = fclose($open);
    	if($conect && $sdb && $n == 29 && $write && $close)
	    {
		    $step2="http://".$_SERVER['SERVER_NAME']."/install/index.php?step=info";
	        header("location:".$step2."");
	        exit();
	    }
		else
	    {
	       	if(!$conect || !$sdb)
	       	{
	       		echo "there is an error while connecting to data base error : " . mysqli_error($conect);
	       	} 
	       	else if ($n != 6)
	       	{
	       		echo "sorry please check the tables number and try again";
	       	}
		}	
}

function sitesettings($file,$upl,$sn,$su,$skw,$sd,$upl2)
{ 
$con = mysqli_connect( DB_SERVER , DB_ADMIN ,DB_PASSW );
$select  = mysqli_select_db($con,DB_NAME);
$dir_name   = dirname(__FILE__);
$fname      = $_FILES[$upl]['name'];
$mname      = $_FILES[$upl]['tmp_name'];
$newname    = 'favicon.png';
$p_size     = 10000000;
$favlnk     = "http://".$_SERVER['SERVER_NAME'].'/'.$file.'/'.$newname;
$fname2      = $_FILES[$upl2]['name'];
$mname2      = $_FILES[$upl2]['tmp_name'];
$newname2    =  'logo.png';
$p_size2     = 10000000;
$imglnk   = "http://".$_SERVER['SERVER_NAME'].'/'.$file.'/'.$newname2;
$nm = 0;
	if(!empty($_FILES['siteicon'])&&$_FILES['siteicon']['error'] == 0 && $_FILES['siteicon']['size']<= $p_size)
	{     

	    $con = mysqli_connect( DB_SERVER , DB_ADMIN ,DB_PASSW );
        $select  = mysqli_select_db($con,DB_NAME); 
		if(preg_match("/^([http|https:\\/\\/])*[www\\.]*/i",$su))
		{
			$rp = preg_replace("/^([http|https:\\/\\/])*[www\\.]*/i",'',$su);
			if($rp)
			{
                $done       = move_uploaded_file($mname,"$file/".$newname); 
				$done2      = move_uploaded_file($mname2,"$file/".$newname2);  	
				$insert_db = mysqli_query($con,"INSERT INTO `siteinfo`(`sname`, `surl`, `skeys`, `sdesc`, `slogo`, `favicon`) VALUES ('$sn','$su','$skw','$sd','$imglnk','$favlnk')")or die("خطأ". mysqli_error($con));
				if($insert_db && $done && $done2)
				{
					$step3="http://".$_SERVER['SERVER_NAME']."/install/index.php?step=admin_info";
				    header("location:".$step3."");
				    exit(); 
				}
			}
		}
		else
		{
			$done       = move_uploaded_file($mname,"$file/".$newname); 
				$done2      = move_uploaded_file($mname2,"$file/".$newname2); 
				$insert_db = mysqli_query($con,"INSERT INTO `siteinfo`(`sname`, `surl`, `skeys`, `sdesc`, `slogo`, `favicon`) VALUES ('$sn','$su','$skw','$sd','$imglnk','$favlnk')")or die("لم تكتمل العملية" . mysqli_error($con));
				if($insert_db && $done && $done2)
				{
					$step3="http://".$_SERVER['SERVER_NAME']."/install/index.php?step=admin_info";
				    header("location:".$step3."");
				    exit(); 
				}
		}
		    
			
	}
	
	else 
	{
		echo "عفوا حدث خطأ اثناء تحديث بيانات الموقع";
	}
}
function adminsett($file,$upl,$adn,$adm,$admps)
{
$con = mysqli_connect( DB_SERVER , DB_ADMIN ,DB_PASSW );
$select  = mysqli_select_db($con,DB_NAME);
$dir_name    = dirname(__FILE__);
$fname      = $_FILES[$upl]['name'];
$mname      = $_FILES[$upl]['tmp_name'];
$path         = "/assets/images/team/1.png";
$p_size      = 10000000;
$imagelnk   = "http://".$_SERVER['SERVER_NAME'].$path;
$length      = strlen($admps);
$username =  str_replace(' ', '', $adn);
$hash     = "#AHMHOZ#";
$password = md5(md5($hash.$admps.$hash));
$num = rand(1,1000);
$id  = md5("amed".$num."hoz");
	if(isset($adn))
	{	 
    	$up_db      = mysqli_query($con,"INSERT INTO `users`(`id`,`usrname`, `password`, `mail`, `name`, `usrimg`, `rank`,`active`) VALUES ('$id','$username','$password','$adm','$adn','$imagelnk','1','1') ") or die(mysqli_error($connect));
    	if($up_db)
    	{
    		$step4="http://".$_SERVER['SERVER_NAME']."/install/index.php?step=finish";
            header("location:".$step4."");
            exit();
    	}
    	else
    	{
    		echo"عفواً حدث خطأ اثناء إضافة بيانات المدير";
    	}         
	}

}
?>