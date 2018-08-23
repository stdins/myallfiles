<?php
use yii\helpers\Gettime;
use yii\widgets\LinkPager;
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
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl;?>/css/page.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="picture_add('添加图片','picture-add.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加图片</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input name="" type="checkbox" value=""></th>
					<th width="100">标题</th>
					<th width="100">图集封面</th>
					<th width="100">ip地址</th>
					<th width="150">更新时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pic as $val):?>
				<tr class="text-c">
					<td><input name="chk" type="checkbox" value="<?php echo $val['p_id'];?>"></td>
					<td><?php echo $val['p_tit'];?></td>
					<td><a href="javascript:;" onClick="picture_edit('图库编辑','<?php echo \yii::$app->urlManager->createUrl(["admin/mypic/showpics","pid"=>$val["p_id"]]);?>','10001')"><img width="140" class="picture-thumb" src="<?php echo \yii::$app->request->baseUrl."/".$val['p_img'][0];?>"></a></td>
					<td class="text-l"><?php echo $val['p_addrip'];?></td>
					<td><?= Gettime::gettm($val['p_time'])?></td>
					<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a> <a style="text-decoration:none" class="ml-5" onClick="picture_edit('图库编辑','picture-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?= LinkPager::widget(['pagination'=>$page,"nextPageLabel"=>"下一页","prevPageLabel"=>"上一页"]);?>
	</div>
</div>

<!--_footer 作为公共模版分离出去-->
<?php echo $this->render("../public/footer.php");?>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
function datadel()
{
	var ch = document.getElementsByName("chk");
	var num = "";
	for(i in ch)
	{
		if(ch[i].checked)
		{
			num += ch[i].value+",";
		}
	}
	$.ajax({
		cache:false,
		async:false,
		data:{"val":num},
		type:"post",
		url:"<?php echo \yii::$app->urlManager->createUrl(['admin/mypic/ajaxdelp']);?>",
		error:function(request)
		{
			alert("请求错误");
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
}

/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-查看*/
function picture_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-申请上线*/
function picture_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-删除*/
function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script>
</body>
</html>