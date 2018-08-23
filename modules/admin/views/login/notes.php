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
<title>后台短信注册 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
<style>
.djh{
	disabled:disabled;
}
.stime{
	color:black;
	float:left;
	margin-left:60%;
	margin-top:-8%;
	z-index:9999;
	width:42px;
	display:none;
}
</style>
</head>
<body>
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
			<?= $form->field($notes,"ntname")->textInput(["class"=>"input-text size-L","placeholder"=>"用户名"])->label(false);?>
		</div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
			<?= $form->field($notes,"ntpass")->passwordInput(["class"=>"input-text size-L","placeholder"=>"密码"])->label(false);?>
		</div>
      </div>
	  <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
			<?= $form->field($notes,"ntemail")->textInput(["class"=>"input-text size-L","placeholder"=>"邮箱"])->label(false);?>
		</div>
      </div>
	   <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
			<input id="" name="Basicuser[phone]" type="text" placeholder="手机号码" class="input-text size-L">
        </div>
      </div>
     <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
			<input class="input-text size-L" name="Basicuser[notes]"  style="float:left;width:30%;padding:2%;"type="text" placeholder="验证码"  style="width:150px;">
			<button class="btn btn-primary size-L radius" id="bstart" style="margin-left:3%;" type="button">点击发送</button>
			<span id="stime" class="stime">0</span>
		</div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" id="btns" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
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
	$("#btns").click(function()
	{
		//var val = new FormData($("#fms")[0]);
		var val = $("#fms").serialize();
		$.ajax({
			cache:false,
			async:false,
			type:"post",
			url:"<?php echo \Yii::$app->urlManager->createUrl(['/admin/login/setregis']);?>",
			data:val,
			error:function(data)
			{
				var info = eval('('+data+')');
				alert(info.message);
				console.log(info);
			},
			success:function(data)
			{
				var info = eval('('+data+')');
				alert(info.message);
				if(info.status == 200)
				{
					window.location.href = info.url;
				}
				console.log(info);
			}
		});
		return false;
	});
	//计时器
	window.tmr;
	window.jsq=0;
	$(document).ready(function(){
		$("button").click(function(){
			var phone = $("input[name='Basicuser[phone]']").val();
			//sendnote(phone);
			//200为正确
			if(sendnote(phone) == 200)
			{
				$("#stime").css("display","block");
				$("#stime").html(0);
				//$(this).prop("disabled",true);
				$(this).addClass("disabled");
				tmr = setInterval(timer,1000);
			}
		});
	});
	function sendnote(ph)
	{
		var num = null;
		$.ajax({
			cache:false,
			async:false,
			data:{"phone":ph},
			type:"post",
			url:"<?php echo yii::$app->urlManager->createUrl(['/admin/login/sendnotes']);?>",
			error:function(data)
			{
				//console.log(data);
				var info = eval('('+data+')');
				alert(info.message)
				num = info.code;
			},
			success:function(data)
			{
				var info = eval('('+data+')');
				//alert(info.message)
				console.log(info);
				num = info.code;
			}
		});
		return num;
	}
	function timer()
	{
		var showt = document.getElementById("stime");
		//var bstart = document.getElementById("bstart");
		var tm = showt.innerHTML;
		tm = parseInt(tm);
		
		if(tm <= 0)
		{
			tm += 1;
			<!-- console.log(tm); -->
			showt.innerHTML = tm;
		}else
		{
			if(tm>=60)
			{
				//bstart.removeAttribute("disabled");
				$("#bstart").removeClass("disabled");
				$("#stime").css("display","none");
				<!-- showt.setAttribute("display","none"); -->
				window.clearInterval(tmr);
			}
			tm += 1;
			showt.innerHTML = tm;
		}
	}
})
</script>
</body>
</html>