<?php
include "../core.php";
$num = $_GET['num'];
$uid = USER_ID;
$pp  = $_GET['whr'];
$s_url = S_URI;
$spuid = $_GET['spuid'];
$date  = $engine->hijridt();
$month  = date(m);

if($num == 1)
{
   
if (isset($_FILES['files1']) && !empty($_FILES['files1'])) {
    $no_files = count($_FILES["files1"]['name']);
    $pid = md5(rand(0,999));
    for ($i = 0; $i < $no_files; $i++) {
        $pic       = $_FILES["files1"]["name"][$i];
        $type      = $_FILES["files1"]['type'][$i];
        $mname     = $_FILES["files1"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = S_URI."/uploads/".$newname."";
        $errors     = $_FILES["files1"]["error"][$i]; 
        $timgs  =  array('image/png',"image/jpg", "image/jpeg");
        if ($_FILES["files1"]["error"][$i] > 0) {
            echo "خطأ: " . $_FILES["files1"]["error"][$i] . "<br>";
        } else {
                  $move = move_uploaded_file($_FILES["files1"]["tmp_name"][$i], '../uploads/' . $newname);
                  $q    = "INSERT INTO `photos` (`pid`,`img`) VALUES ('$pid','$imgurl')";
                  $smd  = $engine->connect()->query($q);
                  if($move && in_array($type, $timgs) && $smd)
                  {?>   
                    <img class='thump' src='<?=$imgurl?>'/>
                  <?}
                }
        }
    }
  echo "<input type='hidden' name='pid' value=".$pid.">";
}
  // end of 1

if($num == 2)
{
   
if (isset($_FILES['files1']) && !empty($_FILES['files1'])) {
    $no_files = count($_FILES["files1"]['name']);
    $pid = md5(rand(0,999));
    for ($i = 0; $i < $no_files; $i++) {
        $pic       = $_FILES["files1"]["name"][$i];
        $type      = $_FILES["files1"]['type'][$i];
        $mname     = $_FILES["files1"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = S_URI."/uploads/".$newname."";
        $errors     = $_FILES["files1"]["error"][$i]; 
        $timgs  =  array('image/png',"image/jpg", "image/jpeg", "image/svg+xml");
        if ($_FILES["files1"]["error"][$i] > 0) {
            echo "خطأ: " . $_FILES["files1"]["error"][$i] . "<br>";
        } else {
                  $move = move_uploaded_file($_FILES["files1"]["tmp_name"][$i], '../uploads/' . $newname);
                  if($move && in_array($type, $timgs) && $smd)
                  {?>   
                    <img src='<?=$imgurl?>' class='circle'/>
                    <input type="hidden" name="img" value="<?=$imgurl?>">
                  <?}
                }
        }
    }
}
//end of 2
//update profile picture 
else if($pp == "pp")
{
    $no_files = count($_FILES["file"]['name']);
    for ($i = 0; $i < $no_files; $i++) 
    {
        $pic       = $_FILES["file"]["name"][$i];
        $type      = $_FILES["file"]['type'][$i];
        $mname     = $_FILES["file"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = S_URI."/uploads/".$newname."";
        $errors     = $_FILES["file"]["error"][$i]; 
        $timgs  =  array('image/png',"image/jpg", "image/jpeg");
        if ($_FILES["file"]["error"][$i] > 0) 
        {
            echo "خطأ: " . $_FILES["file"]["error"][$i] . "<br>";
        } 
        else 
        {
                $move = move_uploaded_file($_FILES["file"]["tmp_name"][$i], '../uploads/' . $newname);
                if($move && in_array($type, $timgs))
                {
                    $q  = "UPDATE `users`  SET `usrimg`='$imgurl' Where `id` = '$uid'";
                     $insert = $engine->connect()->query($q);
                     if($insert)
                     {
                       echo "<img class='us-thump' src='$imgurl' /> " ;
                     }
                     else
                    {
                        echo"<div class='error'>ERROR</div>";
                    }
                
            }
        }
        
    }
    
}
// endo of updating profile picture 


//update sp profile picture 

else if($pp == "spp")
{
    $uid = $spuid;
    $no_files = count($_FILES["file"]['name']);
    for ($i = 0; $i < $no_files; $i++) 
    {
        $pic       = $_FILES["file"]["name"][$i];
        $type      = $_FILES["file"]['type'][$i];
        $mname     = $_FILES["file"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = S_URI."/uploads/".$newname."";
        $errors     = $_FILES["file"]["error"][$i]; 
        $timgs  =  array('image/png',"image/jpg", "image/jpeg");
        if ($_FILES["file"]["error"][$i] > 0) 
        {
            echo "خطأ: " . $_FILES["file"]["error"][$i] . "<br>";
        } 
        else 
        {
                $move = move_uploaded_file($_FILES["file"]["tmp_name"][$i], '../uploads/' . $newname);
                if($move && in_array($type, $timgs))
                {
                     $q = "UPDATE `users`  SET `usrimg`='$imgurl' Where `id` = '$uid'";
                     $insert = $engine->connect()->query($q);
                     if($insert)
                     {
                       echo "<img class='us-thump' src='$imgurl' /> " ;
                     }
                     else
                    {
                        echo"<div class='error'>ERROR</div>";
                    }
                
            }
        }
        
    }
    
}

// end of update profile picture 
else if($pp == "sp")
{
  $no_files = count($_FILES["file"]['name']);
    for ($i = 0; $i < $no_files; $i++) 
    {
        $pic       = $_FILES["file"]["name"][$i];
        $type      = $_FILES["file"]['type'][$i];
        $mname     = $_FILES["file"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = S_URI."/uploads/".$newname."";
        $errors     = $_FILES["file"]["error"][$i]; 
        $timgs  =  array('image/png',"image/jpg", "image/jpeg");
        if ($_FILES["file"]["error"][$i] > 0) 
        {
            echo "خطأ: " . $_FILES["file"]["error"][$i] . "<br>";
        } 
        else 
        {
            $move = move_uploaded_file($_FILES["file"]["tmp_name"][$i], '../uploads/' . $newname);
            if($move && in_array($type, $timgs))
            {
                 $q = "UPDATE `siteinfo`  SET `slogo`='$imgurl'";
                 $insert = $engine->connect()->query($q);
                 if($insert)
                 {
                   echo "<img class='us-thump' src='$imgurl' /> " ;
                 }
                 else
                {
                    echo"<div class='error'>عفواً حدث خطأ اثناء تغيير الصورة الشخصية</div>";
                }
            }
        }
        
    }
}

else if($pp == "fv")
{
  $no_files = count($_FILES["file"]['name']);
    for ($i = 0; $i < $no_files; $i++) 
    {
        $pic       = $_FILES["file"]["name"][$i];
        $type      = $_FILES["file"]['type'][$i];
        $mname     = $_FILES["file"]["tmp_name"][$i];
        $extention = strtolower(end(explode(".", $pic)));
        $newname   = "favicon".".".$extention;
        $imgurl    = S_URI."/uploads/".$newname;
        $errors     = $_FILES["file"]["error"][$i]; 
        $timgs  =  array('image/png',"image/jpg", "image/jpeg");
        if ($_FILES["file"]["error"][$i] > 0) 
        {
            echo "خطأ: " . $_FILES["file"]["error"][$i] . "<br>";
        } 
        else 
        {
            $move = move_uploaded_file($_FILES["file"]["tmp_name"][$i], "../uploads/".$newname);
            if($move && in_array($type, $timgs))
            {
                 $q = "UPDATE `siteinfo`  SET `favicon`='$imgurl'";
                 $insert = $engine->connect()->query($q);
                 if($insert)
                 {
                   echo "<img class='fav' src='$imgurl' /> " ;
                 }
                 else
                {
                    echo"<div class='error'>عفواً حدث خطأ اثناء تغيير الصورة الشخصية</div>";
                }
            }
        }
        
    }
}

if($num == 2)
{
   
if (isset($_FILES['files1']) && !empty($_FILES['files1'])) {
    $no_files = count($_FILES["files1"]['name']);
    for ($i = 0; $i < 7; $i++) {
        $pic       = $_FILES["files1"]["name"][$i];
        $type      = $_FILES["files1"]['type'][$i];
        $mname     = $_FILES["files1"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = S_URI."/uploads/".$newname."";
        $errors     = $_FILES["files1"]["error"][$i]; 
        $timgs  =  array('application/pdf');
        if ($_FILES["files1"]["error"][$i] > 0) {
            echo "خطأ: " . $_FILES["files1"]["error"][$i] . "<br>";
        } else {
                  $move = move_uploaded_file($_FILES["files1"]["tmp_name"][$i], '../uploads/' . $newname);
                  if($move && in_array($type, $timgs))
                  {?>   
                    <button class="btn"><?=$pic?></button>
                    <input name="lnk" value="<?=$imgurl?>" type="hidden">
                  <?}
                }
        }
    }
}

if($num == 3)
{
   
if (isset($_FILES['files1']) && !empty($_FILES['files1'])) {
    $no_files = count($_FILES["files1"]['name']);
    for ($i = 0; $i < 7; $i++) {
        $pic       = $_FILES["files1"]["name"][$i];
        $type      = $_FILES["files1"]['type'][$i];
        $mname     = $_FILES["files1"]["tmp_name"][$i];
        $newname   = $pic;
        $imgurl    = "uploads/".$newname."";
        $errors     = $_FILES["files1"]["error"][$i]; 
        $timgs  =  array('csv_file','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if ($_FILES["files1"]["error"][$i] > 0) {
            echo "خطأ: " . $_FILES["files1"]["error"][$i] . "<br>";
        } else {
                  $move = move_uploaded_file($_FILES["files1"]["tmp_name"][$i], '../uploads/' . $newname);
                  if($move && in_array($type, $timgs))
                  {?>   
                    <button class="btn"><?=$pic?></button>
                    <input name="fname" value="<?=$imgurl?>" type="hidden">
                  <?}
                }
        }
    }
}

if($num == 'edtupload')
{  
  if (isset($_FILES['files1']) && !empty($_FILES['files1'])) 
  {
      $no_files = count($_FILES["files1"]['name']);
      $pid = $_GET['pid'];
      for ($i = 0; $i < $no_files; $i++) 
      {
            $pic       = $_FILES["files1"]["name"][$i];
            $type      = $_FILES["files1"]['type'][$i];
            $mname     = $_FILES["files1"]["tmp_name"][$i];
            $newname   = $pic;
            $imgurl    = S_URI."/uploads/".$newname."";
            $errors     = $_FILES["files1"]["error"][$i]; 
            $timgs  =  array('image/png',"image/jpg", "image/jpeg");
            if ($_FILES["files1"]["error"][$i] > 0) 
            {
                echo "خطأ: " . $_FILES["files1"]["error"][$i] . "<br>";
            } 
            else 
            { 
              $move = move_uploaded_file($_FILES["files1"]["tmp_name"][$i], '../uploads/' . $newname);
              $q    = "INSERT INTO `photos` (`pid`,`img`) VALUES ('$pid','$imgurl')";
              $smd  = $engine->connect()->query($q);
            }
      }
      if($move && in_array($type, $timgs) && $smd)
      {?>
        <ul class="img-del">
      <?
        $qimg = $engine->connect()->query("SELECT * FROM `photos` WHERE `pid` = '$pid'");
        while($showimg = $qimg->fetch_array()){?>
        <li id="photos<?=$showimg['id']?>">
          <img class='thump' src='<?=$showimg['img']?>'/>
          <button class="btn-danger" data-toggle="modal" data-target="#del<?=$showimg['id']?>">
            <i class="fa fa-times"></i>
          </button>
        </li>
        <!--delete confirm-->
        <div class="modal fade" id="del<?=$showimg['id']?>" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3>تأكيد الحذف</h3>
                    </div>
                    <div class="modal-body modal-body-sub_agile">
                        <div class="modal_body_left modal_body_left1">
                            <h3 id="dmsg<?=$showimg['id']?>">
                                هل أنت متأكد من أنك تريد  حذف  هذه الصورة ؟
                            </h3>
                            <button class="btn btn-danger" onclick="del('photos','<?=$showimg[id]?>')">حذف</button>
                        </div>
                    </div>
                </div>
                <!-- //Modal content-->
            </div>
        </div>
        <!--/ delete confirm-->
        <?}?>
        </ul>
      <?}
  }
}
  // end of 1
?>

