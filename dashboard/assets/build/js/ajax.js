function salert(title="",txt="",icon="success",btn)
{
    if(btn == '')
    {
        btn = false;
    }
    Swal.fire({
      icon: icon,
      title: title,
      showConfirmButton: btn,
      text:txt,
      timer: 4000,
      confirmButtonText: btn
    })
}
function toast(icon,msg)
{
  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 10000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: icon,
    title: msg
  })
}

function loading()
{
    let timerInterval
    Swal.fire({
      title: 'الرجاء الانتظار',
      html: 'جاري التحميل......',
      timer: 9000,
      customClass: {
        container: 'container-class'
      },
      timerProgressBar: true,
      onBeforeOpen: () => {
        Swal.showLoading()
        timerInterval = setInterval(() => {
          const content = Swal.getContent()
          if (content) {
            const b = content.querySelector('b')
            if (b) {
              b.textContent = Swal.getTimerLeft()
            }
          }
        }, 100)
      },
      onClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer')
      }
    })
}
// this is used to refresh content
function refresh_content()
{  
  $("#divcont").load(location.href + " #cont");
  $("#divcont2").load(location.href + " #cont2");
  $("#divcont3").load(location.href + " #cont3");
  $("#msg1").val('');
  $(':input','.content')
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .prop('checked', false)
}

function del(type,id)
{
  Swal.fire({
    title: 'هل أنت متأكد من أنك تريد الحذف؟',
    text: "لن تستطيع إرجاع تلك المعلومات مرة أخرى!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'نعم حذف!',
    cancelButtonText: 'إلغاء'
  }).then((result) => {
    if (result.value) {
      var Xreq    = new XMLHttpRequest();        
      Xreq.onreadystatechange = function()
      {
        if(this.readyState < 4 )
        {  
          loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
          var response  = JSON.parse(this.responseText);
          if(response['status'] == 1)
          {
            toast("success",response['details']);
            refresh_content();
          }
          else
          {
            salert("Oh Sorry",response['details'],"error","إعادة المحاولة");
          }
        }
      }
      Xreq.open("POST",'update.php',true);
      Xreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //for the post method
      Xreq.send('req=delete&type='+type+'&id='+id);
    }
  })
}
function login()
{
    var email = document.forms["signin"]["mail"].value ;
    var pass = document.forms["signin"]["password"].value ;
    var Xreq  = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                //window.location.assign('dashboard/home');
                setTimeout(function()
                {location.reload();},2000);
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET",'core/validation.php?mail='+email+'&pass='+pass+'&key=login',true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function s_up()
{
    var email  = document.forms["signup"]["mail"].value ;
    var pass   = document.forms["signup"]["password"].value ;
    var name   = document.forms["signup"]["name"].value ;
    var repass = document.forms["signup"]["repassword"].value ;
    var phone  = document.forms["signup"]["phone"].value ;
    var Xreq  = new XMLHttpRequest();
    if(pass == repass)
    {
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
    }
    else
    {
        document.getElementById('repass').style.border = '1px solid red';
    }
    Xreq.open("GET",'core/validation.php?key=signup&mail='+email+'&pass='+pass+'&name='+name+"&phone="+phone,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function upload(slink)
{    
    var form_data = new FormData();
    var ins = document.getElementById('pimg1').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files1[]", document.getElementById('pimg1').files[x]);
    }
    $.ajax({ 
        url: "upload.php?num=1", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg1").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg1').html(response); // display success response from the PHP script
            $("#pimg1").val('');
        },
        error: function (response) {
            $('#err1').html(response); // display error response from the PHP script
        }
    });
}
function edtupload(pid)
{    
    var form_data = new FormData();
    var ins = document.getElementById('pimg1').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files1[]", document.getElementById('pimg1').files[x]);
    }
    $.ajax({ 
        url: "upload.php?num=edtupload&pid="+pid, // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post', 
        beforeSend: function () { $("#msg1").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg1').html(response); // display success response from the PHP script
            $("#pimg1").val('');
        },
        error: function (response) {
            $('#err1').html(response); // display error response from the PHP script
        }
    });
}
function upload_baner()
{    
    var form_data = new FormData();
    var ins = document.getElementById('pimg1').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files1[]", document.getElementById('pimg1').files[x]);
    }
    $.ajax({ 
        url: "upload.php?num=2", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg1").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg1').html(response); // display success response from the PHP script
            $("#pimg1").val('');
        },
        error: function (response) {
            $('#err1').html(response); // display error response from the PHP script
        }
    });
}
function upload_pdf(slink)
{   
    var form_data = new FormData();
    var ins = document.getElementById('pimg1').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files1[]", document.getElementById('pimg1').files[x]);
    }
    $.ajax({ 
        url: slink+"/upload.php?num=2", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg1").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg1').html(response); // display success response from the PHP script
            $("#pimg1").val('');
        },
        error: function (response) {
            $('#err1').html(response); // display error response from the PHP script
        }
    });
}

function upload_ex(slink)
{   
    var form_data = new FormData();
    var ins = document.getElementById('pimg1').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files1[]", document.getElementById('pimg1').files[x]);
    }
    $.ajax({ 
        url: slink+"/upload.php?num=3", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg1").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg1').html(response); // display success response from the PHP script
            $("#pimg1").val('');
        },
        error: function (response) {
            $('#err1').html(response); // display error response from the PHP script
        }
    });
}

function uploadusr()
{   
    var form_data = new FormData();
    var ins = document.getElementById('pim').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("file[]", document.getElementById('pim').files[x]);
    }
    $.ajax({
        url: "upload.php?whr=pp", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg').html(response); // display success response from the PHP script
            setTimeout(function()
            {location.reload();}
            ,1000)
        },
        error: function (response) {
            $('#msg').html(response); // display error response from the PHP script
        }
    });
}

function uploadsit(slink)
{	
    var form_data = new FormData();
    var ins = document.getElementById('pim').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("file[]", document.getElementById('pim').files[x]);
    }
    $.ajax({
        url: "upload.php?whr=sp", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg').html(response); // display success response from the PHP script
        },
        error: function (response) {
            $('#msg').html(response); // display error response from the PHP script
        }
    });
}

function uplfav(slink)
{   
    var form_data = new FormData();
    var ins = document.getElementById('fpim').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("file[]", document.getElementById('fpim').files[x]);
    }
    $.ajax({
        url: "upload.php?whr=fv", // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#fav").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#fav').html(response); // display success response from the PHP script
        },
        error: function (response) {
            $('#fav').html(response); // display error response from the PHP script
        }
    });
}



function upldspusr(spid,slink)
{   
    var form_data = new FormData();
    var ins = document.getElementById('pim').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("file[]", document.getElementById('pim').files[x]);
    }
    $.ajax({
        url: slink+"/upload.php?whr=spp&spuid="+spid , // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function () { $("#msg").html('<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>'); },
        success: function (response) {
            $('#msg').html(response); // display success response from the PHP script
        },
        error: function (response) {
            $('#msg').html(response); // display error response from the PHP script
        }
    });
}

function notfs(req)
{
    setInterval(function(){
        var Xreq = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById(req).innerHTML = this.responseText;

            }
        }
        Xreq.open("GET","update.php?req="+req,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
    },1000);
}

function gnotf(req,area)
{
        var Xreq = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById(area).innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById(area).innerHTML = this.responseText;

            }
        }
        Xreq.open("GET","update.php?req="+req+"&gntf=gntf",true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function fnd(req)
{
        var val  = document.forms["add-student"]["parent"].value;
        var Xreq = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('sg-rslts').innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('sg-rslts').innerHTML = this.responseText;

            }
        }
        Xreq.open("GET","update.php?req="+req+"&val="+val,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function send_msg(to)
{
        var val  = document.forms["msgs"]["msg"].value;
        var Xreq = new XMLHttpRequest();
        var elmnt = document.getElementById("end");
        Xreq.onreadystatechange = function()
        {
            if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('ms-cntnt').innerHTML = this.responseText;
                document.forms["msgs"]["msg"].value = '';
                elmnt.scrollIntoView();
            }
        }
        Xreq.open("GET","update.php?req=send_msg&msg="+val+"&to="+to,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function ffield(fld,data)
{
    document.getElementById(fld).value = data;
    document.getElementById('sg-rslts').innerHTML = '';
}

function add_news(type,id='')
{
        var name  = document.forms["form"]["name"].value;
        var desc  = document.forms["form"]["desc"].value;
        var sec   = document.forms["form"]["sec"].value;
        var img   = document.forms["form"]["img"].value;
        var Xreq  = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=add_news&name="+name+"&txt="+desc+"&sec="+sec+"&img="+img+"&type="+type+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_grade(type,id='')
{
        var gname  = document.forms["add-grade"]["gname"].value;
        var cnum   = document.forms["add-grade"]["val-rang"].value;
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=add_grade&gn="+gname+"&cn="+cnum+"&type="+type+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function upl_st()
{
    var type   = document.forms["add-excell"]["type"].value;
    if(type == 'student')
    {
        document.getElementById('inst').innerHTML = "<ul<li>إنشاء ملف  إكسل </li><li>إضافة البيانات حسب ما هو موضح بالصورة</li><li>حفظ الملف بصيفة (.CSV)</li></ul>";
    }
    else if(type == 'parent')
    {
        document.getElementById('inst').innerHTML = "<ul<li>إنشاء ملف  إكسل </li><li>إضافة البيانات حسب ما هو موضح بالصورة</li><li>حفظ الملف بصيفة (.CSV)</li></ul>";
    }
    else if(type == 'teacher')
    {
        document.getElementById('inst').innerHTML = "<ul<li>إنشاء ملف  إكسل </li><li>إضافة البيانات حسب ما هو موضح بالصورة</li><li>حفظ الملف بصيفة (.CSV)</li></ul>";
    }
}

function add_tracker(track)
{
        var status      = document.forms["tracker"]["status"].value;
        var desc        = document.forms["tracker"]["desc"].value;
        var step        = document.forms["tracker"]["step"].value;
        var Xreq        = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=add_tracker&status="+status+"&desc="+desc+"&step="+step+"&track="+track,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function track_status()
{
        var track      = document.forms["track"]["track"].value;
        var Xreq        = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('msg').innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('msg').innerHTML = this.responseText;
            }
        }
        Xreq.open("GET","update.php?req=track_status&track="+track,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_product(type,req,pid='')
{
        var name        = document.forms["add-pro"]["name"].value;
        var price       = document.forms["add-pro"]["price"].value;
        var oprice      = document.forms["add-pro"]["oldprice"].value;
        var addet       = document.forms["add-pro"]["addet"].value;
        var desc        = document.forms["add-pro"]["desc"].value;
        var sec         = document.forms["add-pro"]["sec"].value;
        var tags        = document.forms["add-pro"]["tags"].value;
        var ratio       = document.forms["add-pro"]["ratio"].value;
        var amount      = document.forms["add-pro"]["amount"].value;
        if(pid == '')
        {
            var pid         = document.forms["add-pro"]["pid"].value;
        }
        var Xreq        = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req="+req+"&name="+name+"&price="+price+"&addet="+addet+"&desc="+desc+"&sec="+sec+"&tags="+tags+"&pid="+pid+"&type="+type+"&oldprice="+oprice+"&ratio="+ratio+"&amount="+amount,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_offer(type,req,pid='')
{
    
        var name        = document.forms["add-pro"]["name"].value;
        var price       = document.forms["add-pro"]["price"].value;
        var oprice      = document.forms["add-pro"]["oldprice"].value;
        var addet       = document.forms["add-pro"]["addet"].value;
        var desc        = document.forms["add-pro"]["desc"].value;
        var sec         = document.forms["add-pro"]["sec"].value;
        var tags        = document.forms["add-pro"]["tags"].value;
        var date        = document.forms["add-pro"]["date"].value;
        var edate       = document.forms["add-pro"]["enddate"].value;
        var rstatus     = document.forms["add-pro"]["rstatus"].value;
        var cities      = document.forms["add-pro"]["cities"].value;
        var pranches    = document.forms["add-pro"]["pranches"].value;
        var merchant    = document.forms["add-pro"]["merchant"].value;
        if(pid == '')
        {
            var pid         = document.forms["add-pro"]["pid"].value;
        }
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("POST","update.php",true);
        Xreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        Xreq.send("req="+req+"&name="+name+"&price="+price+"&addet="+addet+"&desc="+desc+"&sec="+sec+"&tags="+tags+"&pid="+pid+"&type="+type+"&oldprice="+oprice+"&edate="+edate+"&date="+date+"&rstatus="+rstatus+"&cities="+cities+"&pranches="+pranches+"&merchant="+merchant);
}

function add_ad(type,req,pid='')
{
    
        var ad        = document.forms["add-ad"]["ads"].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("POST","update.php",true);
        Xreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        Xreq.send("req="+req+"&ad="+ad+"&pid="+pid+"&type="+type);
}
function add_pages(type)
{
    
        var text     = document.forms["add-ad"][type].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("POST","update.php",true);
        Xreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        Xreq.send("req=add_pages"+"&text="+text+"&type="+type);
}
function add_inbaner(type,req,pid='')
{
    
        var baner     = document.forms["add-ad"]["baner"].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("POST","update.php",true);
        Xreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        Xreq.send("req="+req+"&baner="+baner+"&pid="+pid+"&type="+type);
}
function upd_profile(id)
{
        var name        = document.forms["form"]["name"].value;
        var mail        = document.forms["form"]["mail"].value;
        var password    = document.forms["form"]["password"].value;
        var Xreq        = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=upd_profile&n="+name+"&m="+mail+"&ps="+password+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function edt_user(id)
{
        var name        = document.forms["edt-profile"]["name"].value;
        var mail        = document.forms["edt-profile"]["mail"].value;
        var password    = document.forms["edt-profile"]["password"].value;
        var balance     = document.forms["edt-profile"]["balance"].value;
        var active      = document.forms["edt-profile"]["active"].value;
        var Xreq        = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=edt_user&n="+name+"&m="+mail+"&ps="+password+"&id="+id+"&active="+active+"&balance="+balance,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function add_address()
{
        var country   = document.forms["add1"]["country"].value;
        var city      = document.forms["add1"]["city"].value;
        var addr      = document.forms["add1"]["addr"].value;
        var phone     = document.forms["add1"]["phone"].value;
        var main      = document.forms["add1"]["main"].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=addresses&country="+country+"&city="+city+"&addr="+addr+"&main="+main+"&phone="+phone,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function add_teacher(type,req,id='')
{
        var name        = document.forms["add-parent"]["name"].value;
        var mail        = document.forms["add-parent"]["mail"].value;
        var gender      = document.forms["add-parent"]["gender"].value;
        var phone       = document.forms["add-parent"]["phone"].value;
        var location    = document.forms["add-parent"]["location"].value;
        var pphoto      = document.forms["add-parent"]["img0"].value;
        var password    = document.forms["add-parent"]["val-password"].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req="+req+"&n="+name+"&m="+mail+"&g="+gender+"&p="+phone+"&l="+location+"&ps="+password+"&pp="+pphoto+"&type="+type+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_activity()
{
        var name        = document.forms["add-activity"]["name"].value;
        var date        = document.forms["add-activity"]["date"].value;
        var txt         = document.forms["add-activity"]["txt"].value;
        var img         = document.forms["add-activity"]["img0"].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=add_activity&n="+name+"&d="+date+"&t="+txt+"&i="+img,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_abilities(type,req,id='')
{
        var name        = document.forms["add-abilities"]["name"].value;
        var lnk         = document.forms["add-abilities"]["lnk"].value;
        var txt         = document.forms["add-abilities"]["txt"].value;
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req="+req+"&n="+name+"&l="+lnk+"&t="+txt+"&type="+type+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function edit_site()
{
        var name        = document.forms["edit-site"]["name"].value;
        var lnk         = document.forms["edit-site"]["lnk"].value;
        var desc        = document.forms["edit-site"]["desc"].value;
        var keys        = document.forms["edit-site"]["keys"].value;
        var phone       = document.forms["edit-site"]["phone"].value;
        var mail        = document.forms["edit-site"]["mail"].value;
        var Xreq        = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=edit_site&name="+name+"&lnk="+lnk+"&desc="+desc+"&keys="+keys+"&phone="+phone+"&mail="+mail,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function subsc_act(id,type)
{
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('subscribe'+id).innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('subscribe'+id).innerHTML = this.responseText;
            }
        }
        Xreq.open("GET","update.php?req=subsc_act&id="+id+"&type="+type,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function sign_as(type,id)
{
        var Xreq      = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('msg').innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('msg').innerHTML = this.responseText;
                location.reload();
            }
        }
        Xreq.open("GET","update.php?req=sign_as&id="+id+"&type="+type,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function add_moderator(type)
{
        var id     = document.forms["moderator"]["name"].value;
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=rnk&type="+type+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function rnk(type,id)
{
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=rnk&type="+type+"&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function acc_comm(id)
{
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('comments'+id).innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('comments'+id).innerHTML = this.responseText;

            }
        }
        Xreq.open("GET","update.php?req=acc_comm&id="+id,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function acc_pro(id,type)
{
        var ratio        = document.forms["ratio"]["ratio"].value;
        var Xreq         = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('products'+id).innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('products'+id).innerHTML = this.responseText;

            }
        }
        Xreq.open("GET","update.php?req=acc_pro&id="+id+"&ratio="+ratio+"&type="+type,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function getcity()
{
    var c         = document.forms["add1"]["country"].value;
    var Xreq      = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState == 4  & this.status == 200)
        {
            document.getElementById('city').innerHTML = this.responseText;
        }
    }
    Xreq.open("GET","cities.php?req="+c,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}

function add_baner()
{
        var lnk    = document.forms["add-pro"]["lnk"].value;
        var img    = document.forms["add-pro"]["img"].value;
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {
                document.getElementById('msg').innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                document.getElementById('msg').innerHTML = this.responseText;
                setTimeout(function()
                {location.reload();},2000);
            }
        }
        Xreq.open("GET","update.php?req=add_baner&img="+img+"&lnk="+lnk,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_slider()
{
        var name   = document.forms["add-pro"]["name"].value;
        var lnk    = document.forms["add-pro"]["lnk"].value;
        var img    = document.forms["add-pro"]["img"].value;
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=add_slider&img="+img+"&lnk="+lnk+"&name="+name,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}

function add_mark()
{
        var lnk    = document.forms["add-pro"]["lnk"].value;
        var img    = document.forms["add-pro"]["img"].value;
        var Xreq   = new XMLHttpRequest();
        Xreq.onreadystatechange = function()
        {
            if(this.readyState < 4 )
            {  
                loading();
            }
            else if(this.readyState == 4  & this.status == 200)
            {
                var response  = JSON.parse(this.responseText);
                if(response['status'] == 1)
                {
                    salert("عملية ناجحة!",response['details'],"success","");
                    refresh_content();
                }
                else
                {
                    salert("عفواً",response['details'],"error","إعادة المحاولة");
                }
            }
        }
        Xreq.open("GET","update.php?req=add_mark&img="+img+"&lnk="+lnk,true);
        // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
        Xreq.send();
}
function add_section(type,id='')
{
    var name    = document.forms["add-pro"]["name"].value;
    var img     = document.forms["add-pro"]["img"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_section&name="+name+"&type="+type+"&id="+id+"&img="+img,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function add_city(type,id='')
{
    var name    = document.forms["add-pro"]["name"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_city&name="+name+"&type="+type+"&id="+id,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function add_subsection(type,id='')
{
    var name    = document.forms["add-pro"]["name"].value;
    var msec    = document.forms["add-pro"]["msec"].value;
    var img     = document.forms["add-pro"]["img"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_subsection&name="+name+"&msec="+msec+"&img="+img+"&type="+type+"&id="+id,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function add_bsection(type,id='')
{
    var name    = document.forms["add-pro"]["name"].value;
    var img     = document.forms["add-pro"]["img"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_bsection&name="+name+"&type="+type+"&id="+id+"&img="+img,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function add_bsubsection(type,id='')
{
    var name    = document.forms["add-pro"]["name"].value;
    var msec    = document.forms["add-pro"]["msec"].value;
    var img     = document.forms["add-pro"]["img"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_bsubsection&name="+name+"&msec="+msec+"&img="+img+"&type="+type+"&id="+id,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function add_sponser()
{
    var name        = document.forms["companies"]["name"].value; 
    var section     = document.forms["companies"]["section"].value;
    var img         = document.forms["companies"]["img"].value;
    var link        = document.forms["companies"]["link"].value;
    var Xreq        = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_sponser&name="+name+"&section="+section+"&img="+img+"&link="+link,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function add_company()
{
    var name     = document.forms["companies"]["name"].value;
    var ename    = document.forms["companies"]["ename"].value;
    var merchant = document.forms["companies"]["merchant"].value;
    var address  = document.forms["companies"]["address"].value;
    var contact  = document.forms["companies"]["contact"].value;
    var img      = document.forms["companies"]["img"].value;
    var map      = document.forms["companies"]["map"].value;
    var Xreq     = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                refresh_content();
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","update.php?req=add_company&name="+name+"&ename="+ename+"&merchant="+merchant+"&address="+address+"&contact="+contact+"&img="+img+"&map="+map,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function s_pranch()
{
    var curv     = document.forms["add-pro"]["spranches"].value;
    var tval     = document.forms["add-pro"]["pranches"].value;
    var rid      =  Math.random();
    if(tval == '')
    {
        document.forms["add-pro"]["pranches"].value = curv;
        document.getElementById('pranchesli').innerHTML = '<li id='+rid+'>'+curv+'<span id="rarea'+rid+'" onclick="remdiv('+rid+')">X</span> </li>';
    }
    else
    {
        document.forms["add-pro"]["pranches"].value = curv+'  -  '+tval;
        var div = document.getElementById('pranchesli');
        div.innerHTML += '<li id='+rid+'>'+curv+'<span id="rarea'+rid+'" onclick="remdiv('+rid+')">X</span> </li>';
    }
}
function remdiv(id)
{
    var elem = document.getElementById(id);
    var selem = document.getElementById('rarea'+id);
    selem.remove();
    var txt  = document.getElementById(id).innerHTML;
    var ntxt = document.forms["add-pro"]["pranches"].value.replace(txt+' - ','');
    document.forms["add-pro"]["pranches"].value = ntxt;
    var ntxt = document.forms["add-pro"]["pranches"].value.replace(txt,'');
    document.forms["add-pro"]["pranches"].value = ntxt;
    elem.remove();
}
function s_city()
{
    var curv     = document.forms["add-pro"]["city"].value;
    var tval     = document.forms["add-pro"]["cities"].value;
    var rid      =  Math.random();
    if(tval == '')
    {
        document.forms["add-pro"]["cities"].value = curv;
        document.getElementById('citiesli').innerHTML = '<li id='+rid+'>'+curv+'<span id="rarea'+rid+'" onclick="remcdiv('+rid+')">X</span> </li>';
    }
    else
    {
        document.forms["add-pro"]["cities"].value = curv+'  -  '+tval;
        var div = document.getElementById('citiesli');
        div.innerHTML += '<li id='+rid+'>'+curv+'<span id="rarea'+rid+'" onclick="remcdiv('+rid+')">X</span> </li>';
    }
}
function remcdiv(id)
{
    var elem = document.getElementById(id);
    var selem = document.getElementById('rarea'+id);
    selem.remove();
    var txt  = document.getElementById(id).innerHTML;
    var ntxt = document.forms["add-pro"]["cities"].value.replace(txt+' - ','');
    document.forms["add-pro"]["cities"].value = ntxt;
    var ntxt = document.forms["add-pro"]["cities"].value.replace(txt,'');
    document.forms["add-pro"]["cities"].value = ntxt;
    elem.remove();
}
function activate(id)
{
    var Xreq   = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {
            document.getElementById('users'+id).innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            document.getElementById('users'+id).innerHTML = this.responseText;

        }
    }
    Xreq.open("GET","update.php?req=activate&id="+id,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}

function p_withdraw()
{
    var mail    = document.forms["pwithdraw"]["mail"].value;
    var amount  = document.forms["pwithdraw"]["amount"].value;
    var Xreq   = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {
            document.getElementById('msg').innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            document.getElementById('msg').innerHTML = this.responseText;

        }
    }
    Xreq.open("GET","update.php?req=pwithdraw&mail="+mail+"&amount="+amount,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function b_withdraw()
{
    var name    = document.forms["bwithdraw"]["name"].value;
    var account = document.forms["bwithdraw"]["account"].value;
    var amount  = document.forms["bwithdraw"]["amount"].value;
    var bname   = document.forms["bwithdraw"]["bname"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {
            document.getElementById('msg').innerHTML = '<div class="ldng"><i class="fa fa-refresh fa-spin"></i></div>';
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            document.getElementById('msg').innerHTML = this.responseText;

        }
    }
    Xreq.open("GET","update.php?req=bwithdraw&name="+name+"&amount="+amount+"&account="+account+"&bname="+bname,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function g_name()
{
    var name    = document.forms["moderator"]["name"].value;
    var Xreq    = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState == 4  & this.status == 200)
        {
            document.getElementById('show_names').innerHTML = this.responseText;
        }
    }
    Xreq.open("GET","update.php?req=g_name&name="+name,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}
function choose(id)
{
    document.forms["moderator"]["name"].value = id;
    document.getElementById('show_names').innerHTML = '';
}

function addto_cart(pid,type)
{
    var Xreq        = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                setTimeout(function(){refresh_content()},2000);
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","dashboard/update.php?req=add_cart&pid="+pid+"&type="+type,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}

function addto_fav(pid,type)
{
    var Xreq        = new XMLHttpRequest();
    Xreq.onreadystatechange = function()
    {
        if(this.readyState < 4 )
        {  
            loading();
        }
        else if(this.readyState == 4  & this.status == 200)
        {
            var response  = JSON.parse(this.responseText);
            if(response['status'] == 1)
            {
                salert("عملية ناجحة!",response['details'],"success","");
                setTimeout(function(){refresh_content()},2000);
            }
            else
            {
                salert("عفواً",response['details'],"error","إعادة المحاولة");
            }
        }
    }
    Xreq.open("GET","dashboard/update.php?req=add_favs&pid="+pid+"&type="+type,true);
    // Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
    Xreq.send();
}