<?php
header("Access-Control-Allow-Origin: *");
include "../core.php";
$key = $_GET['key'];
if($key == 'signup')
{
  $email    = strip_tags(strtolower(htmlspecialchars(addslashes($_GET['mail'])))); 
  $name     = strip_tags(strtolower(htmlspecialchars(addslashes($_GET['name']))));
  $pass     = strip_tags(htmlspecialchars(addslashes($_GET['pass']))) ;
  $phone    = strip_tags(htmlspecialchars(addslashes($_GET['phone']))) ;
  $q        = "SELECT * FROM users WHERE `mail` LIKE '%$email%'";
  $vem      = $engine->connect()->query($q);
  $enum     = $vem->num_rows;
  $vname    = array('login', 'signin','log in','sign in','user','password','upload','site','enter','image','picture','sql','mysqli','select' );
  if(!empty($email) && !empty($name) && !empty($pass))
  {
    if(!preg_match("([a-zA-Z0-9_]@[a-zA-Z]+[.])", $email))
    {
      $results = array('status' => 0, 'details' => 'الرجاء إدخال بريد إلكتروني صحيح');
      echo $results = json_encode($results);
    }
    else if($enum >= 1)
    {
      $engine->login($email,$pass);
    }
    else if (in_array($name, $vname) || strlen($name) < 1)
    {
      if(in_array($name, $vname))
       {
          $results = array('status' => 0, 'details' => 'يرجي اختيار اسماً صحيحاً');
          echo $results = json_encode($results);
       }
       else if (strlen($name) < 8) 
       {
          $results = array('status' => 0, 'details' => 'الرجاء إدخال اسم صحيح');
          echo $results = json_encode($results);
       }
    }
    else if (strlen($pass) < 8 )
    {
      $results = array('status' => 0, 'details' => 'كلمة المرور أقل من 8 أرقام وحروف');
      echo $results = json_encode($results);
    }
    else
    {
        $engine->signup ($email,$name,$pass,$phone);
    }
  }
  else
  {
    $results = array('status' => 0, 'details' => 'عفواً لا يجب ترك  أي الحقول فارغة');
    echo $results = json_encode($results);

  }

}//end signup

else if($key == 'fpassword')
{
  $email    = strip_tags(strtolower(htmlspecialchars(addslashes($_GET['mail']))));
  if(!empty($email))
  {
    $check    = $engine->connect()->query("SELECT * FROM `users` WHERE `mail` = '$email'");
    $num      = $check->num_rows;
    if($num >= 1)
    {
      $engine->resetpassword($email);
    }
    else
    {
      $results = array('status' => 0, 'details' => 'عفواً هذا البريد غير مسجل');
      echo $results = json_encode($results);
    }
  }
  else
  {
    $results = array('status' => 0, 'details' => 'الرجاء إدخال البريد الإلكتروني');
    echo $results = json_encode($results);
  }
}
else if($key == 'login')
{
  $email    = strip_tags(strtolower(htmlspecialchars(addslashes($_GET['mail'])))); 
  $pass     = strip_tags(htmlspecialchars(addslashes($_GET['pass'])));
  $engine->login($email,$pass);
}
?>