<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="<?php echo \yii::$app->request->baseUrl."/layui/";?>/css/layui.css"  media="all">
  <script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/jquery/1.9.1/jquery.min.js"></script> 
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
		<legend>邮件发送</legend>
	</fieldset>
	<form class="layui-form" id="fms">
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">验证邮箱</label>
				<div class="layui-input-inline">
					<input type="text" name="demail" value="<?= $uinfo['ba_mail'];?>" lay-verify="email" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<input type="hidden" value="<?= $uinfo['ba_id'];?>" name="uid" />
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">内容</label>
			<div class="layui-input-block">
				<textarea placeholder="请输入内容" name="cont" class="layui-textarea" ></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" id="btn">发送</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
</body>
<script>
$(document).ready(function(){
	$("#btn").click(function(){
		var info = $("#fms").serialize();
		console.log(info);
		$.ajax({
			cache:false,
			async:false,
			data:info,
			url:"<?php echo \yii::$app->urlManager->createUrl(['admin/userinfo/sendemo']);?>",
			type:"post",
			error:function(data)
			{
				var msg = eval('('+data+')');
				alert(msg.msg);
				//console.log(data);
			},
			success:function(data){
				var msg = eval('('+data+')');
				alert(msg.msg);
				//console.log(data);
			}
		});
		return false;
	});
	
})
</script>
</html>