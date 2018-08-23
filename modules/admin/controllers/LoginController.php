<?php

namespace app\modules\admin\controllers;

use yii\web\Request;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Html;
use yii\web\Response;
use app\models\Basicuser;
use yii\widgets\ActiveForm;
use yii\captcha\CaptchaAction;

/**
 * Default controller for the `admin` module
 */
class LoginController extends Controller
{
	//public $layouts = "login.php";
	public $enableCsrfValidation = false;
	public function init()
	{
		$session = \yii::$app->session;
		if($session->get("userdata")!=NULL)
		{
			return $this->redirect(["/admin/index/index"]);
		}
	}
    public function actionIndex()
    {
		$this->layout = "login.php";
		$login = new Basicuser;
		$login->scenario = "login";
		$post = NULL;
		if(\Yii::$app->request->isPost)
		{
			$post = \Yii::$app->request->post();
			$session = \yii::$app->session;
			// echo "<pre>";
			// var_dump($session['__captcha/admin/login/captcha']);
			// die;
			$login->user = $post['Basicuser']['user'];
			$login->lpass = $post['Basicuser']['lpass'];
			$login->attributes = $post['Basicuser'];
			if($login->validate())
			{
				$userinfo = $login->find()->where(['ba_name'=>"{$post['Basicuser']['user']}"])->asArray()->all();
				$session = \yii::$app->session;
				if($session->get("userdata")!=NULL)
				{
					$session->remove("userdata");
				}
				$session ->set("userdata",$userinfo[0]);
				return $this->redirect(["/admin/index/index"]);
			}
		}
        return $this->render('index',["login"=>$login]);
    }
	public function actionRegister()
	{
		$this->layout = "login.php";
		$reg = new Basicuser;
		$reg->scenario = "register";
		if(\yii::$app->request->isPost)
		{
			echo 1;die;
		}
		
		return $this->render("register",["reg"=>$reg]);
	}
	//验证码
	public function actions()
	{
		return [
			'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
			'captcha'=>[
				'class'=>'yii\captcha\CaptchaAction',
				// 'fixedVerifyCode'=>YII_ENV_TEST ? 'testme' : null,
				'testLimit'=>1,
				'maxLength' => 6, //最大显示个数
				'minLength' => 5,//最少显示个数
				//'padding' => 0,//间距
				'height'=>40,//高度
				'width' => 120,  //宽度  
				//'foreColor'=>0xffffff,     //字体颜色
				'offset'=>3,        //设置字符偏移量 有效果
			],
		];	
	}
	public function actionRegisset()
	{
		$post = NULL;
		$model = NULL;
		$info = new Basicuser;
		$res = NULL;
		$info->scenario = "register";
		if(\Yii::$app->request->isAjax)
		{
			$post = \Yii::$app->request->post();
		}
		if($post['Basicuser']!=NULL)
		{
			$p = "/([\d]+|[\w]+)\@(qq|163|gmail)\.com/i";
			preg_match($p,$post['Basicuser']['email'],$all);
			if($all == NULL)
			{
				$res = [
					"msg"=>"邮箱格式错误",
					"status"=>0,
					"url"=>0
				];
				return json_encode($res);
			}
			if(($post['Basicuser']['pass'] != $post['Basicuser']['trpass']) || $post['Basicuser']['pass']==NULL )
			{
				$res = [
					"msg"=>"密码不相等或者密码为空",
					"status"=>0,
					"url"=>0
				];
				
				return json_encode($res);
			}
			$info->ba_name = $post['Basicuser']['name'];
			$info->ba_pass = sha1($post['Basicuser']['pass']);
			$info->ba_mail = $post['Basicuser']['email'];
			$info->ba_addrip = $_SERVER["REMOTE_ADDR"];
			$info->ba_time = time();
			$info->attributes = $post['Basicuser'];
			//var_dump($info);die;
			if($info->save())
			{
				$res = [
					"msg"=>"注册成功",
					"status"=>1,
					"url"=>\Yii::$app->urlManager->createUrl(['admin/login/index'])
				];
			}else
			{
				$res = [
					"msg"=>"注册失败",
					"status"=>0,
					"url"=>0
				];
			}
			return json_encode($res);
		}
		$res = [
			"msg"=>"注册失败,信息不完整",
			"status"=>0,
			"url"=>0
		];
		return json_encode($res);
	}
	//短信注册
	public function actionNotes()
	{
		$this->layout = "login.php";
		$regis = new Basicuser;
		$regis->scenario = "notes";
		return $this->render("notes",["notes"=>$regis]);
	}
	public function actionSendnotes()
	{
		$post = NULL;
		$res = NULL;
		if(\yii::$app->request->isAjax)
		{
			$post = \yii::$app->request->post();
		}else{
			$res = [
				"code"=>0,
				"message"=>"发送类型错误"
			];
			return json_encode($res);
		}
		//验证手机合法性
		$p = "/(151|153|181|138|187)\d{8}/i";
		preg_match($p,$post['phone'],$all);
		if($all == NULL)
		{
			$res = [
				"code"=>1,
				"message"=>"手机号码错误"
			];
			return json_encode($res);
		}
		
		//发送信息 短信 cookie保存
		$rand = rand(1000,10000);
		// $cookie = new \yii\web\Cookie();
		// $cookie->name = "phone";
		// $cookie->value = "{$rand}";
		// $cookie->expire = time()*60;
		if(!isset($_COOKIE['phone']))
		{
			setcookie('phone',$rand,time()+60);
		}
		//else{
			// setcookie("phone"," ",time()-1);//先删除
			// setcookie('phone',$rand,time()+60);//在添加
		// }
		//$cookie->httpOnly = true;
		//$cook = \yii::$app->response->getCookies()->add($cookie);
		$sms = [
			"code"=>$rand,
			"product"=>"dsd"
		];
		$response = \yii::$app->aliyun->sendSms(
			"李祥",
			"SMS_121855971",
			$post['phone'],
			$sms,
			"123"
		);
		return $response;
		// $res = [
			// "phone"=>$rand,
			// "message"=>"等待发送",
			// "code"=>200
		// ];
		// return json_encode($res);
		//var_dump($res);die;
	}
	//
	public function actionSetregis()
	{
		$post = NULL;
		$res = NULL;
		$num = NULL;
		$regis = new Basicuser;
		$regis->scenario = "notes";
		if(\yii::$app->request->isAjax)
		{
			$post = \yii::$app->request->post();
			$post = $post['Basicuser'];
		}else{
			//测试
			$post = [
				"ntemail"=>"1046075930@qq.com",
				"notes"=>"6427",
				"ntpass"=>"123",
				"phone"=>"15390277282",
				"ntname"=>"yii2"
			];
		}
		if($post['phone']==NULL || $post['ntname'] == NULL || $post['ntpass'] == NULL)
		{
			$res = [
				"status"=>0,
				"message"=>"信息不能为空"
			];
			return json_encode($res);
		}
		if($post['notes']==NULL)
		{
			$res = [
				"status"=>0,
				"message"=>"验证码不能为空"
			];
			return json_encode($res);
		}
		//验证邮箱合法性
		$pe = "/([\d]+|[\w]+)\@(qq|163|gmail)\.com/i";
		preg_match($pe,$post['ntemail'],$all);
		if($all == NULL)
		{
			$res = [
				"message"=>"邮箱格式错误",
				"code"=>1,
			];
			return json_encode($res);
		}
		if(isset($_COOKIE['phone']))
		{
			$num = $_COOKIE['phone'];
		}
		if($num!=NULL)
		{
			if($num != $post['notes'])
			{
				$res = [
					"status"=>2,
					"message"=>"验证码错误"
				];	
				return json_encode($res);				
			}
		}else{
			$res = [
				"status"=>3,
				"message"=>"请重新获取验证码"
			];
			return json_encode($res);
		}
		//return json_encode($post);
		$regis->ba_name = $post['ntname'];
		$regis->ba_pass = sha1($post['ntpass']);
		$regis->ba_mail = $post['ntemail'];
		$regis->ba_addrip = $_SERVER["REMOTE_ADDR"];
		$regis->ba_time = time();
		$regis->attributes = $post;
		//return json_encode($post);
		// $sdas = [
			// "phone"=>$num,
			// "message"=>"信息",
			// "status"=>$regis->save()
		// ];
		//\Yii::$app->response->format=Response::FORMAT_JSON;
		//return json_encode($sdas);
		if($regis->save())
		{
			$res = [
				"message"=>"注册成功",
				"status"=>200,
				"url"=>\Yii::$app->urlManager->createUrl(['admin/login/index'])
			];
			return json_encode($res);
		}else
		{
			$res = [
				"message"=>"注册失败",
				"status"=>0,
			];
			return json_encode($res);
		}
	}
	//退出
	public function actionLogout()
	{
		$session = \yii::$app->session;
		if($session->get("userdata")!=NULL)
		{
			$session->remove("userdata");
		}
		return $this->redirect(['/admin/login/index']);
	}
}
