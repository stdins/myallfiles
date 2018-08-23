<?php

namespace app\modules\admin\controllers;

use yii\web\Request;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Html;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class IndexController extends AdminController
{
	public function init()
	{
		parent::init();
	}
    public function actionIndex()
    {
		$this->layout = "login.php";
		$session = \yii::$app->session;
		// echo "<pre>";
		// var_dump($session->get("userdata"));die;
		$userinfo = $session->get("userdata");
		return $this->render("index",['userinfo'=>$userinfo]);
    }
}
