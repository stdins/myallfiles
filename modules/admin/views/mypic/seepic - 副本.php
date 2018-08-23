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
<style>
	img {
		border: 1px solid #ddd;
		border-radius: 4px;
		padding: 5px;
	}
</style>
<title>图片展示</title>
</head>
<body>
<div class="page-container">
	<?php foreach($pic as $val1):?>
		<?php foreach($val1['p_img'] as $val2):?>
			<img src="<?php echo \yii::$app->request->baseUrl."/".$val2;?>" alt="Paris" width="400" height="300">
		<?php endforeach;?>
	<?php endforeach;?>
	<ul>
		<li><li>
	<ul>
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