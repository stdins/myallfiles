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

<title>图片展示</title>
<link href="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;
</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 
<span class="c-gray en">&gt;</span> 图片展示 
<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
<i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="edit()" class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe6df;</i> 
				编辑
			</a> 
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 
				批量删除
			</a> 
		</span> 
		<span class="r">共有数据：<strong><?=$num;?></strong> 条</span> </div>
	<div class="portfolio-content">
		<ul class="cl portfolio-area">
			<?php foreach($img as $val):?>
			<li class="item">
				<div class="portfoliobox">
					<input class="checkbox" name="chk" type="checkbox" value="<?=$val;?>">
					<div class="picbox">
						<a href="<?php echo \yii::$app->request->baseUrl."/".$val;?>" data-lightbox="gallery" data-title="<?=$pinfo[0]['p_tit'];?>">
							<img src="<?php echo \yii::$app->request->baseUrl."/".$val;?>"/>
						</a>
					</div>
					<span style="display:none;" id="pid"><?=$pinfo[0]['p_id'];?></span>
					<div class="textbox"><?=$pinfo[0]['p_tit'];?> </div>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<?php echo $this->render("../public/footer.php");?>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/lightbox2/2.8.1/js/lightbox.min.js"></script> 
<script type="text/javascript">
$(function(){
	$(".portfolio-area li").Huihover();
});
function datadel()
{
	var ck = document.getElementsByName("chk");
	var pid = document.getElementById("pid");
	console.log(pid.innerHTML);
	var info = new Array();
	var arr = "";
	for(i in ck)
	{
		if(ck[i].checked)
		{
			arr += ck[i].value + ",";
		}
	}
	info[0]=arr;
	info[1]=pid.innerHTML;
	$.ajax({
		cache:false,
		async:false,
		data:{"val":info},
		type:"post",
		url:"<?php echo \yii::$app->urlManager->createUrl(["admin/mypic/ajaxdels"]);?>",
		error:function(data){
			var info = eval('('+data+')');
			alert(info.message);
		},
		success:function(data)
		{
			//console.log(data);
			var info = eval('('+data+')');
			alert(info.message);
			if(info.code == 200)
			{
				window.location.reload();
			}
		}
	});
	//alert(arr);
	//console.log(arr);
}
</script>
</body>
</html>