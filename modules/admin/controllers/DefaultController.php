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
class DefaultController extends AdminController
{
	public function init()
	{
		//\yii::$app->runAction('/admin/index');
		//echo 1;die;
		parent::init();
		// echo 1;die;
	}
    public function actionIndex()
    {
		echo "这是default页面";die;
        //return $this->render('index');
    }
}
