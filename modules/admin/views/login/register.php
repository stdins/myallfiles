<?php
use yii\widgets\ActiveForm;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台登录 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
	<?php $form = ActiveForm::begin([
				"enableClientValidation"=>true,
				"method"=>NULL,
				"enableAjaxValidation"=>true,
				"id"=>"fms",
				"action"=>NULL,
				"options"=>[
					"class"=>"form form-horizontal"
				]
			]
		);
	?>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
           <?= $form->field($reg,"name")->textInput(["class"=>"input-text size-L","placeholder"=>"用户名"])->label(false);?>
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
			<?= $form->field($reg,"pass")->passwordInput(["class"=>"input-text size-L","placeholder"=>"密码"])->label(false);?>
        </div>
      </div>
	   <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
			<?= $form->field($reg,"trpass")->passwordInput(["class"=>"input-text size-L","placeholder"=>"重复密码"])->label(false);?>
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
			<?= $form->field($reg,"email")->textInput(["class"=>"input-text size-L","placeholder"=>"邮箱","id"=>"email"])->label(false);?>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
	  <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>" />
    <?php ActiveForm::end();?>
  </div>
</div>
<div class="footer">Copyright注册 by H-ui.admin v3.1</div>
<script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui/js/H-ui.min.js"></script>
<script>
$(document).ready(function()
{
	$("#fms").on("submit",function()
	{
		var val = new FormData($("#fms")[0]);
		//var val = $("#fms").serialize();
		$.ajax({
			cache:false,
			async:false,
			type:"post",
			url:"<?= \Yii::$app->urlManager->createUrl(['admin/login/regisset'])?>",
			data:val,
			dataType:"html",
			processData:false,
			contentType:false,
			error:function(data)
			{
				var info = eval('('+data+')');
				alert(info.msg);
				console.log(data);
				//return false;
			},
			success:function(data)
			{
				//return false;
				var info = eval('('+data+')');
				alert(info.msg);
				if(info.status == 1)
				{
					window.location.href = info.url;
				}
				 console.log(data);
				return false;
			}
		});
		return false;
	});
	
})
</script>
</body>
</html>