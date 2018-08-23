<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Request;
use yii\web\Session;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\Controller;
use yii\helpers\Url;

class AdminController extends Controller
{
    // public function init()
    // {
		// $session = \Yii::$app->session;
		// if($session->get("userdata")==NULL)
		// {
			// $url = \yii\helpers\Url::to(['/Site/Index/index']);
			// var_dump($url);die;
			// return $this->redirect($url);
		// }
		// self::check();
    // }
	public function actionIndex()
	{
		$url = \yii\helpers\Url::to(['/admin/login/index']);
		//return $this->redirect(['/admin/login/index']);
	}
	public function init()
	{
		$session = \Yii::$app->session;
		if($session->get("userdata")==NULL)
		{
			return $this->redirect(['/admin/login/index']);
		}
	}
}
