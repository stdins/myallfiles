<?php

namespace app\modules\admin\controllers;

use yii\web\Request;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Html;
use yii\data\Pagination;
use app\models\Basicuser;

/**
 * Default controller for the `admin` module
 */
class UserinfoController extends AdminController
{
	public $enableCsrfValidation = false;
	public function init()
	{
		parent::init();
	}
    public function actionIndex()
    {
		$this->layout = "login.php";
		$user = new Basicuser;
		$page = $user::find();
		$pagenum = 0;
		if(\yii::$app->request->isGet)
		{
			$pagenum = \yii::$app->request->get("page");
			$pagenum = ($pagenum - 1) < 0 ? 0 : ($pagenum - 1);  
			$pagenum = $pagenum * 10;
		}
		$count = $page->count();
		$pagination = new Pagination(["totalCount"=>$count,"pageSize"=>10]);
		$info = $page->offset($pagination->offset)->limit($pagination->limit)->all();
		// echo "<pre>";
		// var_dump($info);die;
		$data = [
			"info"=>$info,
			"page"=>$pagination,
			"pnum"=>$pagenum
		];
        return $this->render('index',$data);
    }
	public function actionSendemail()
	{
		$this->layout = "login.php";
		$id = \yii::$app->request->get();
		$bas = new Basicuser;
		$id = $id[1]['id'];
		// echo "<pre>";
		// var_dump($id[1]['id']);die;
		$uinfo = $bas::find()->where(['ba_id'=>$id])->asArray()->all();
		return $this->render("send",['uinfo'=>$uinfo[0]]);
	}
	public function actionSendemo()
	{
		$res = NULL;
		$post = \yii::$app->request->post();
		//var_dump($post);die;
		$mail = \yii::$app->mailer->compose()
		->setFrom('1046075930@qq.com')
		->setTo($post['demail'])
		->setSubject('邮件发送配置')//发送邮件主题
		->setTextBody('测试')//发布纯文本
		->setHtmlBody($post['cont'])
		->send();
		if($mail)
		{
			$res = [
				"msg"=>"发送成功"
			];
		}else
		{
			$res = [
				"msg"=>"发送失败"
			];	
		}
		return json_encode($res);
	}
	//群发邮件
	public function actionSendall()
	{
		$post = NULL;
		$mid = NULL;
		$eid = NULL;
		$messge = NULL;
		$basic = new Basicuser;
		if(\yii::$app->request->isAjax)
		{
			$post = \yii::$app->request->post();
		}
		if($post!=NULL)
		{
			$post = $post['info'];
			//var_dump($post[0]);die;
			//获取邮箱
			$eid = explode(",",$post[1]);
			for($i=0;$i<count($eid);$i++)
			{
				if($eid[$i]!=NULL)
				{
					$mid[] = $eid[$i];
				}
			}
			//$result = $basic::findAll($mid);//对象
			//获取结果
			$result = $basic::find()->where(['ba_id'=>$mid])->asArray()->all();
			foreach($result as $val)
			{
				$mail = \yii::$app->mailer->compose()
				->setFrom('1046075930@qq.com')
				->setTo($val['ba_mail'])
				->setSubject('邮件发送配置')//发送邮件主题
				->setTextBody('测试')//发布纯文本
				->setHtmlBody($post[0])
				->send();
				if($mail)
				{
					$msg = [
						"msg"=>$val['ba_mail']."发送成功"
					];
					$message[] = $msg;
				}else{
					$msg = [
						"msg"=>$val['ba_mail']."发送失败"
					];
					$message[] = $msg;
				}
			}
			return json_encode($message);
		}
	}
}
