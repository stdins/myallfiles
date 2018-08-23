<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>新增图片</title>
<link href="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
	<?php $form = ActiveForm::begin([
				"enableClientValidation"=>true,
				"method"=>"post",
				"id"=>"form-article-add",
				"action"=>\yii::$app->urlManager->createUrl(['admin/mypic/setpic']),
				"options"=>[
					"class"=>"form form-horizontal"
				]
			]
		);
	?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?= $form->field($pic,"title")->textInput(["class"=>"input-text"])->label(false);?>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">图片上传：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?= $form->field($pic,"image[]")->fileInput(['multiple' => true, 'accept' => 'image/*'])->label(false);?>
			</div>
		</div>
		<?php
			if(\yii::$app->getSession()->hasFlash("setpic"))
			{
		?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"></label>
			<div class="formControls col-xs-8 col-sm-9">
				<p style="color:black;font-weight:600;">
					<?php echo \yii::$app->getSession()->getFlash("setpic");?>
				</p>
			</div>
		</div>
		<?php 
			}
		?>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius"  type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	<?php ActiveForm::end();?>
</div>


<!--_footer 作为公共模版分离出去-->
<?php echo $this->render("../public/footer.php");?>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
function article_save(){
	alert("刷新父级的时候会自动关闭弹层。")
	window.parent.location.reload();
}
$(document).ready(function()
{
	// $("#btn").click(function(){
		// var val = new FormData($("#form-article-add")[0]);//form-article-add
		// $.ajax({
			// cache:false,
			// async:false,
			// data:val,
			// type:"post",
			// url:"<?php echo yii::$app->urlManager->createUrl(['admin/mypic/ajaxup']);?>",
			// processData:false,
			// contentType:false,
			// error:function(data)
			// {
				// console.log(data);
			// },
			// success:function(data)
			// {
				// console.log(data);
			// }
		// });
		// return false;
	// });
});


</script>
</body>
</html>