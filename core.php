<?php
error_reporting(1);
ini_set('display_errors', 1);
$servertimezone = 'Africa/Cairo';
date_default_timezone_set($servertimezone);
session_start();
ob_start();

require_once 'core/config/config.php';
require_once 'core/engine.php';
$engine = new engine();

$q = "SELECT * FROM `siteinfo`";
$smd = $engine->connect()->query($q) or die('ERROR');
$showsinfo = $smd->fetch_array();
if($_SERVER['SERVER_NAME'] == 'localhost')
{
  $sc_name = basename(dirname(__FILE__), '.php');  
  define(S_URI,"http://".$_SERVER['SERVER_NAME'].'/'.$sc_name);
}
else
{
  if(isset($showsinfo['surl']))
  {
    define(S_URI,"https://".$showsinfo['surl']);
  }
  else
  {
    define(S_URI,"http://".$_SERVER['SERVER_NAME']);
  }
}
if($showsinfo)
{
define(S_DOMAIN, $showsinfo['surl']);
define(IMG_PATH, "uploads");
define(S_NAME, $showsinfo['sname']);
define(S_KEYS, $showsinfo['skeys']);
define(S_DESC, $showsinfo['sdesc']);
define(S_IMG, $showsinfo['slogo']);
define(S_ICON, $showsinfo['favicon']);
if($showsinfo['dc'] == 'SAR')
{
  define(DCR,'ر.س');
}
else
{
  define(DCR, $showsinfo['dc']);
}
define(S_PHONE, $showsinfo['sphone']);
define(S_MAIL, $showsinfo['smail']);  
define(PRIVACY, $showsinfo['privacy']);  
define(HTUSE, $showsinfo['htuse']);  
define(MSUB, $showsinfo['msub']);  
define(EMP, $showsinfo['emp']);  
define(ANDROID, $showsinfo['android']);  
define(S_TERMS, $showsinfo['terms']); 
define(S_ABOUT, $showsinfo['about']); 
define(S_WORD, $showsinfo['word']); 
define(S_PRIVACY, $showsinfo['privacy']); 
define(S_CONTACT, $showsinfo['contact']); 
define(BANER, $showsinfo['baner']);  
define(IOS, $showsinfo['ios']);
if(DCR == "SAR")
{
  define(DCRC, 'ر.س');
}
}
else
{
    die ("Sorry We couldn't Get The main Table");
}

if(isset($_SESSION['email']) && isset($_SESSION['password']))
{
	$user = $_SESSION['email']; 
	$sl   = $engine->connect()->query("SELECT * FROM users WHERE mail LIKE '%$user%'");
	$us_data = $sl-> fetch_array();
	define(USER_UNAME,    $us_data['usrname']);
	define(USER_ID,       $us_data['id']);
  define(USER_NAME,     $us_data['name']);
  define(USER_MAIL,     $us_data['mail']);
  define(USER_RANK,     $us_data['rank']);
  define(USER_RATIO,    $us_data['ratio']);
  define(USER_IMG,      $us_data['usrimg']); 
  define(USER_ACTIVE,  $us_data['country']);
  define(USER_BALANCE,  $us_data['balance']);
  define(USER_PBALANCE,  $us_data['pbalance']);
}
else
{
  if(!isset($_SESSION['uid'])){
    $uid = rand(0,99999);
    $_SESSION['uid'] = $uid;
  }
  define(USER_IMG, "assets/images/user.png");
  define(USER_ID,  $_SESSION['uid']);
}
 
if(isset($_POST['eng']))
  {
    $lang = $_SESSION['lang'] = "eng";
    $lang = "eng";
  }
  else if (isset($_POST['ar'])) 
  {
    $_SESSION['lang'] = "ar";
    $lang = "ar";
  }
  else 
  {
    if(isset($_SESSION['lang']))
    {
        $lang = $_SESSION['lang'];
    }
    else
    {
        $lang = $_SESSION['lang'] = "eng";
        $lang = "eng";
    }
  }


  function counttime($date)
  { 
    $ndate = strtotime($date);
    $time = usertime(time());
    $time = strtotime($time);
    $time = $time - $ndate; 
    $tokens = array (
      86400 => 'أيام',
      3600 => 'ساعات',
      60 => 'دقائق',
      1 => 'ثوانِ'
    );
    if($time==0 || $time<4)
    {
      return date('Y-m-d', strtotime($date));
    }
    elseif($time>3 && $time < 604800)
    {
      foreach ($tokens as $unit => $text) 
      {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return 'منذ ' .$numberOfUnits .' '.$text;
      }
    }
    else
    {
      return ' يوم '.date('Y-m-d', strtotime($date));
    }
  }// end counttime
  function usertime($date)
  { 
    if($_SESSION['tzname']!="")
    {
      $tz = new DateTimeZone($_SESSION['tzname']);
      $dtStr = date("c", $date);
      $date = new DateTime($dtStr);
      $date->setTimeZone($tz);
      return $date->format('d.m.Y H:i:s');
    }
    else
    {
      return date('d.m.Y H:i:s',$date);
    } 
  }//end usertime
?>
