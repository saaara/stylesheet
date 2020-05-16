<?php
require_once 'sets.php';
?>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>تركيب الموقع</title>
	  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	  <link href="assets/css/bootstrap.css" rel="stylesheet">
	  <link href="assets/css/style.css" rel="stylesheet">
	  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet"> 
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script src="assets/js/bootstrap.min.js"></script>
	  <script src="assets/js/ajax.js"></script>
	  <!-- JavaScript Includes -->
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	  <script src="assets/js/jquery.ui.widget.js"></script>
	</head>
	<body class="dix">
	    <div class="cont text-center col-md-12"> 
	    	<!--header-->
		    <div class="text-center col-md-12">
			    <div class="hdr">
			    	<img src="assets/img/cogs.png"/>
			    	<h3>تركيب الموقع </h3>
			    	<?php
			    		if($step==""){echo "<b> الخطوة 1 : ضبط قاعدة البيانات وإنشاء الجداول</b>";}
			    		if($step=="info"){echo "<b> الخطوة 2 : بيانات الموقع</b>";}
			    		if($step=="admin_info"){echo "<b> الخطوة 3: بيانات المدير</b>";}
			    		if($step=="finish"){echo "<b> الخطوة 4 : إنهاء التثبيت</b>";}
			    	?>
			    </div>
			</div>
			<!--/header-->

			<!-- step 1-->
			<?php 
				if($step=="")
				{       
				   include 'stp1.php';	 
				} 
			?>
			<!--/step 1-->

			<!-- step 2-->
			<?php 
				if($step=="info")
				{ 
				   include 'stp2.php';      
				} 
			?>	
			<!--/step 2-->

			<!-- step 3 -->
            <?php 
                if($step=="admin_info")
                {
				   include 'stp3.php';          
                }
            ?>		
            <!--/step 3-->
            <?php 
                if($step=="finish")
                {
				   include 'stp4.php';
				}
			?>
		</div>
		<!--footer-->
		<div class="text-center col-md-12">
		    <div class="footer">
		    	للاستفسار <a href="https://fb.com/ahmadhozien" target="_blank">تواصل معي </a>
		    </div>
		</div>
		<!--/footer-->
	</body>
</html>
<?php ob_end_flush ?>