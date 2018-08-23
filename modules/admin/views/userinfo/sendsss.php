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
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/style.css" /><!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>邮件发送</title>
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?= $uinfo['ba_mail'];?>" placeholder="" id="" name="demail" />
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">信息：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="cont" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" ></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" id="btn" type="button"><i class="Hui-iconfont">&#xe632;</i> 发送</button>
				<button class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
				<a href="<?php echo \yii::$app->urlManager->createUrl(['admin/userinfo/sendemo']);?>"><button class="btn btn-default radius" type="button">跳转</button></a>
			</div>
		</div>
	</form>
</div>


<!--_footer 作为公共模版分离出去-->
<?php echo $this->render("../public/footer.php");?>
<!--请在下方写此页面业务相关的脚本-->
 
<script type="text/javascript">
$(document).ready(function(){
	$("#btn").click(function(){
		var info = $("#form-article-add").serialize();
		console.log(info);
		$.ajax({
			cache:false,
			async:false,
			data:info,
			url:"<?php echo \yii::$app->urlManager->createUrl(['admin/userinfo/sendemo']);?>",
			type:"post",
			error:function(data)
			{
				// var msg = eval('('+data+')');
				// alert(msg.msg);
				console.log(data);
			},
			success:function(data){
				// var msg = eval('('+data+')');
				// alert(msg.msg);
				console.log(data);
			}
		});
		return false;
	});
})
</script>
</body>
</html>