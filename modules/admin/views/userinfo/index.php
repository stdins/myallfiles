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
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/hui/";?>static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl;?>/css/page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl."/layui/css";;?>/layui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo \yii::$app->request->baseUrl;?>/css/common.css" />

<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>用户列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户列表 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a class="btn btn-primary radius" value="bounceInDown" id="sendall" data-title="批量发送" data-href="article-add.html"  href="javascript:;"> 
				批量发送
			</a>
		</span> 
		<span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>用户名</th>
					<th width="80">邮箱</th>
					<th width="80">IP地址</th>
					<th width="80">时间</th>
					<th width="80">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php $num=1; foreach($info as $val): ?>
				<tr class="text-c">
					<td><input type="checkbox" value="<?= $val->ba_id;?>" name="chk"></td>
					<th width="80"><?= ($num++)+$pnum ;?></th>
					<td width="80"><?= $val->ba_name;?></td>
					<td width="80"><?= $val->ba_mail;?></td>
					<td width="80"><?= $val->ba_addrip;?></td>
					<td width="80"><?= Gettime::gettm($val->ba_time);?></td>
					<td class="f-14 td-manage">
						<a style="text-decoration:none" class="ml-5" href="<?php echo \yii::$app->urlManager->createUrl(['admin/userinfo/sendemail',['id'=>$val->ba_id]]);?>" title="发送邮件">
							<i class="Hui-iconfont">&#xe6df;</i>
						</a> 
						<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除">
							<i class="Hui-iconfont">&#xe6e2;</i>
						</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?= LinkPager::widget(['pagination'=>$page,"nextPageLabel"=>"下一页","prevPageLabel"=>"上一页"]);?>
	</div>
	<div class="box">
		<div id="dialogBg"></div>
		<div id="dialog" class="animated">
			<img class="dialogIco" width="50" height="50" src="<?php echo \yii::$app->request->baseUrl;?>/images/ico.png" alt="" />
			<div class="dialogTop">
				<a href="javascript:;" class="claseDialogBtn">关闭</a>
			</div>
			<form class="layui-form" id="fms">
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">内容</label>
					<div class="layui-input-block">
						<textarea id="val" placeholder="请输入内容" style="resize:none;overflow-x:hidden;overflow-y:hidden;" name="einfo" class="layui-textarea" ></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" id="btn">发送</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<?php echo $this->render("../public/footer.php");?>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var w,h,className;
	var data = '';
	function getSrceenWH(){
		w = $(window).width();
		h = $(window).height();
		$('#dialogBg').width(w).height(h);
	}
	window.onresize = function(){  
		getSrceenWH();
	}  
	$(window).resize();  
	$("#sendall").click(function(){
		var ck = document.getElementsByName("chk");
		var cls = $(this).attr("value");
		var eid='';
		for(var i=0;i<ck.length;i++)
		{
			if(ck[i].checked)
			{
				eid += ck[i].value+',';
			}
		}
		data = eid;
		getSrceenWH();
		//显示弹框
		$('#dialogBg').fadeIn(300);
		$('#dialog').removeAttr('class').addClass('animated '+cls+'').fadeIn();
		//alert(eid);
	});
	$("#btn").click(function(){
		var info = $("#val").val();
		var arr = new Array();
		arr[0] = info;
		arr[1] = data;
		$.ajax({
			cache:false,
			async:false,
			type:"post",
			data:{"info":arr},
			url:"<?php echo \yii::$app->urlManager->createUrl(["/admin/userinfo/sendall"])?>",
			error:function(data)
			{
				var res = eval('('+data+')');
				console.log(res);
				//console.log(data);
			},
			success:function(data)
			{
				var res = eval('('+data+')');
				console.log(res);
				//console.log(data);
			}
		});
		return false;
	})
	//关闭弹窗
	$('.claseDialogBtn').click(function(){
		$('#dialogBg').fadeOut(300,function(){
			$('#dialog').addClass('bounceOutUp').fadeOut();
		});
	});
})




/*layui form表单*/
function emails() {
	//页面层
	layer.open({
		type: 1,
		skin: 'layui-layer-rim', //加上边框
		area: ['520px', '300px'], //宽高
		//content:"<?php echo \yii::$app->urlManager->createUrl(['admin/userinfo/form']);?>"
		content: '<?php echo $this->render("../public/form.php")?>'  //调到新增页面
	});
}

/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/

function article_del(obj,id){
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