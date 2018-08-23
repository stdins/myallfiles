<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\captcha\Captcha;
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
<style>
	
</style>
</head>
<body>
<?php $this->beginBody() ?>

<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
	<?php $form = ActiveForm::begin([
		"enableClientValidation"=>true,
		"method"=>"post",
		"options"=>[
			"class"=>"form form-horizontal"
		],
	]);?>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
		  <?= $form->field($login,"user")->textInput(["class"=>"input-text size-L","placeholder"=>"用户名"])->label(false);?>
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
		<?= $form->field($login,"lpass")->passwordInput(["class"=>"input-text size-L","placeholder"=>"密码"])->label(false);?>
        </div>
      </div>
     <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
			<input class="input-text size-L" name="Basicuser[verifyCode]"  style="float:left;width:30%;padding:2%;"type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
          <!--  <img src=""> <a id="kanbuq" href="javascript:;">看不清，换一张</a>-->
			<?= $form->field($login,'verifyCode')->widget(yii\captcha\Captcha::className(),[
					'template'=>'<div class="col-lg-3" style="display:block;">{image}</div>',
					'captchaAction'=>'/admin/login/captcha',
					'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer,margin-top:-2%;']
				])->label(false);
			?>
		</div>
      </div>
	   <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>" />
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <!--<input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">-->
		  <?= Html::SubmitButton('登陆',["class"=>"btn btn-success radius size-L"])?>
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    <?php ActiveForm::end()?>
  </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
<script type="text/javascript" src="<?php echo \yii::$app->request->baseUrl."/hui/";?>lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript">
$(document).ready(function () {
$('#contactform-verifycode-image').yiiCaptcha({"refreshUrl":"\/bolgs\/web\/index.php?r=admin%2Flogin%2Fcaptcha\u0026refresh=1","hashKey":"yiiCaptcha\/admin\/login\/captcha"});
$('#contact-form').yiiActiveForm([{"id":"contactform-name","name":"name","container":".field-contactform-name","input":"#contactform-name","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Name cannot be blank."});}},{"id":"contactform-email","name":"email","container":".field-contactform-email","input":"#contactform-email","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Email cannot be blank."});yii.validation.email(value, messages, {"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"message":"Email is not a valid email address.","enableIDN":false,"skipOnEmpty":1});}},{"id":"contactform-subject","name":"subject","container":".field-contactform-subject","input":"#contactform-subject","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Subject cannot be blank."});}},{"id":"contactform-body","name":"body","container":".field-contactform-body","input":"#contactform-body","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Body cannot be blank."});}},{"id":"contactform-verifycode","name":"verifyCode","container":".field-contactform-verifycode","input":"#contactform-verifycode","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.captcha(value, messages, {"hash":643,"hashKey":"yiiCaptcha/admin/login/captcha","caseSensitive":false,"message":"The verification code is incorrect."});}}], []);
});
</script>
<script>
$(document).ready(function(){
	$("#changeimg").click(function(){
		//var url = $(this).attr("src");
		var rand = null;
		for(var i=0;i<2;i++)
		{
			rand = Math.ceil(Math.random()*10+6);
		}
		var ch = getchs(rand);
		console.log(ch);
		var url = "/basic/web/index.php?r=admin%2Flogin%2Fcaptcha&v="+ch+"."+ch;
		//var url = "/basic/web/index.php?r=site%2Fcaptcha&v="+ch;
		//"<?= yii::$app->urlManager->createUrl(['site/captcha'])?>";
		$(this).attr("src",url);
		console.log(url);
	});
})
function getchs(n)
{
	var chars = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
	//var chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
	var res = "";
	for(var i=0;i<n;i++)
	{
		var id = Math.ceil(Math.random()*35);
		res += chars[id];
	}
	return res;
}
</script>
</body>
<?php $this->endBody() ?>
</html>
