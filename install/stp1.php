<?php 
	if(isset($_POST['dbsub']))
	{
		connectdb($_POST['srvername'],$_POST['dbusr'],$_POST['datapass'],$_POST['dbsnm']);
	}						
?>
<div class="text-center cntnr col-md-12">
	<form method="POST" action="index.php">
		<div class="form-group col-md-12">
			<div class="col-md-6">
				<label>اسم الخادم</label>
				<input name="srvername" type="text" placeholder="إسم الخادم" value="localhost" class="form-control"/>
			</div>
			<div class="col-md-6">
				<label>اسم قاعدة البيانات</label>
				<input name="dbsnm" type="text" placeholder="قاعدة البيانات" class="form-control"/>
			</div> 
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-6"> 
				<label>اسم مستخدم قاعدة البيانات</label>
				<input name="dbusr" type="text" placeholder="إسم مستخدم قاعدة البيانات" class="form-control"/>
			</div>
			<div class="col-md-6">
				<label>الرقم السري لقاعدة البيانات</label>
				<input name="datapass" type="password" placeholder="الرقم السري" class="form-control" />
			</div>
		</div>
		<div class="col-md-12 text-center">
			<input type="submit" class="btn praim-btn" value="تأكيد وفحص السيرفر والملفات" name="dbsub"> </input>
		</div> 
	</form>
</div>