<?php

namespace app\modules\admin\controllers;

use yii\web\Request;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Html;
use yii\data\Pagination;
use app\models\Pic;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class MypicController extends AdminController
{
	public $enableCsrfValidation = false;
	public function init()
	{
		parent::init();
	}
    public function actionIndex()
    {
		$this->layout = "login.php";
		
        return $this->render('index',$data);
    }
	public function actionUploadpic()
	{
		$this->layout = "login.php";
		$pic = new Pic;
		$session = \yii::$app->session;
		//$pic->scenario = "pic";
		return $this->render("uploadpic",['pic'=>$pic]);
	}
	public function actionSetpic()
	{
		$this->layout = "login.php"; 
		$pic = new Pic;
		$post = NULL;
		$picfile = NULL;
		$session = \yii::$app->session;
		//$pic->scenario = "pic";
		$url = \yii::$app->request->baseUrl;
		if(\yii::$app->request->isPost)
		{	
			$post = \yii::$app->request->post();
			$pic->image = UploadedFile::getInstances($pic,"image");
			$pic->attributes = [
					"title"=>$post['Pic']['title']
				];
			if($pic->validate())
			{
				foreach($pic->image as $val)
				{
					// echo "<pre>";
					// var_dump($val);die;
					$val->saveAs("images/".$val->baseName . "." .$val->extension);
					$picfile .= "images/".$val->baseName . "." .$val->extension.",";
				}
				$pic->p_adid = $session->get("userdata")['ba_id'];
				$pic->p_tit = $post['Pic']['title'];
				$pic->p_img = $picfile;
				$pic->p_addrip = $_SERVER["REMOTE_ADDR"];
				$pic->p_time = time();
				if($pic->save(false))
				{
					\yii::$app->getSession()->setFlash("setpic","图片上传成功");
				}else
				{
					\yii::$app->getSession()->setFlash("setpic","图片上传失败");
				}
				$pic->image = NULL;
			}
		}
		return $this->render("uploadpic",['pic'=>$pic]);
	}
	//图片查看
	public function actionSeepic()
	{
		$this->layout = "login.php";
		$userdata = NULL;
		$img = new Pic;
		$page = $img::find();
		$picarr = NULL;//获取图片数组
		$num = 0;
		$session = \yii::$app->session;
		if($session != NULL)
		{
			$userdata = $session->get("userdata");
		}
		//分页
		$count = $page->count();
		$pagination = new Pagination(["totalCount"=>$count,"pageSize"=>2]);
		$info = $page->offset($pagination->offset)->limit($pagination->limit)->all();

		// $pics = $img::find()->where("p_adid = {$userdata['ba_id']}")->asArray()->all();
		// foreach($pics as $val)
		// {
			// $arr = explode(",",$val['p_img']);
			// for($i=0;count($arr)>$i;$i++)
			// {
				// if($arr[$i] != "")
				// {
					// $picarr[] = $arr[$i];
				// }
			// }
			// $pics[$num]['p_img'] = $picarr;
			// $picarr = NULL;
			// $arr = NULL;
			// $num++;
		// }
		foreach($info as $val)
		{
			$arr = explode(",",$val->p_img);
			for($i=0;count($arr)>$i;$i++)
			{
				if($arr[$i] != "")
				{
					$picarr[] = $arr[$i];
				}
			}
			$info[$num]->p_img = $picarr;
			$picarr = NULL;
			$arr = NULL;
			$num++;
		}
		// foreach($pics as $val)
		// {
			// foreach($val['p_img'] as $val1)
			// {
				// echo $val1."<br/>";
			// }
		// }
		// die;
		$data = [
			"pic"=>$info,
			"page"=>$pagination
		];
		return $this->render("seepic",$data);
	}
	//删除图集
	public function actionAjaxdelp()
	{
		$post = NULL;
		$delp = NULL;
		$delps = NULL;
		$delid = NULL;
		$pid = NULL;
		$img = new Pic;
		$dinfo = NULL;
		$res = NULL;
		if(\yii::$app->request->isAjax)
		{
			$post = \yii::$app->request->post();
		}
		$delid = explode(",",$post['val']);//implode();
		//获取pid;
		for($i=0;$i<count($delid);$i++)
		{
			if($delid[$i] != NULL)
			{
				$pid[] = $delid[$i];
			}
		}
		
		//删除图片
		for($i=0;$i<count($pid);$i++)
		{
			$dinfo = $img::find()->where("p_id = {$pid[$i]}")->asArray()->all();
			$delp = explode(",",$dinfo[0]['p_img']);
			for($j=0;$j<count($delp);$j++)
			{
				if($delp[$j]!=NULL)
				{
					$delps[] = $delp[$j];
				}
			}
			for($k=0;$k<count($delps);$k++)
			{
				$file = "./../../basic/web/".$delps[$k];
				if(file_exists($file))
				{
					unlink($file);
				}else{
					$res = [
						"message"=>"删除失败,文件不存在或者路径错误",
						"code"=>"201"
					];
					return json_encode($res);
				}
			}
		}
		if(count($pid)<2)
		{
			$pid = 'p_id in'."($pid[0])";
		}else{
			$pid = implode(",",$pid);
			$pid = 'p_id in'."($pid)";
		}
		if($img->deleteAll($pid))
		{
			$res = [
				"message"=>"删除成功",
				"code"=>"200"
			];
		}else{
			$res = [
				"message"=>"删除失败",
				"code"=>"202"
			];
		}
		return json_encode($res);
	}
	//查看t图集
	public function actionShowpics()
	{
		$this->layout="login.php";
		$info = \yii::$app->request->get();
		$img = new Pic;
		$pinfo = NULL;
		$arr = NULL;
		if($info != NULL)
		{
			$pinfo = $img::find()->where("p_id = {$info['pid']}")->asArray()->all();
			$pic = explode(",",$pinfo[0]['p_img']);
			for($i=0;$i<count($pic);$i++)
			{
				if($pic[$i] != NULL)
				{
					$arr[] = $pic[$i];
				}
			}
			$pinfo[0]["p_img"] = $arr;
		}
		$data = [
			"pinfo"=>$pinfo,
			"img"=>$arr,
			"num"=>count($arr)
		];
		// echo "<pre>";
		// var_dump($pinfo);die;
		return $this->render("showpics",$data);
	}
	//图片删除
	public function actionAjaxdels()
	{
		$post = NULL;
		$img = new Pic;
		$dels = NULL;
		$dpic = NULL;
		$darr = NULL;
		$res = NULL;
		$dimgs = NULL;
		$num = NULL;
		$file = NULL;
		$j = 0;
		if(\yii::$app->request->isAjax)
		{
			$post = \yii::$app->request->post();
		}
		if($post != NULL)
		{
			$dels = explode(",",$post['val'][0]);
			for($i=0;$i<count($dels);$i++)
			{
				if($dels[$i]!=NULL)
				{
					$darr[] = $dels[$i];
				}
			}
			//获取当前数据图片
			$dpic = $img::find()->where("p_id = {$post['val'][1]}")->asArray()->all();
			$dpics = $img::findOne($post['val'][1]);
			$dimg = explode(",",$dpic[0]['p_img']);
			for($i=0;$i<count($dimg);$i++)
			{
				if($dimg[$i] != NULL)
				{
					$dimgs[] = $dimg[$i];
				}
			}
			//循环删除
			for($i=0;$i<count($dimgs);$i++)
			{
				if($dimgs[$i] == $darr[$j])
				{
					//获取删除的数据
					//$file = \yii::$app->request->baseUrl."/".$darr[$j];
					$file = "./../../basic/web/".$darr[$j];
					if(file_exists($file))
					{
						unlink($file);
					}else{
						echo $j;die;
						$res = [
							"message"=>"文件删除失败",
							"code"=>101
						];
						return json_encode($res);
					}
					if(!empty($darr[$j+1]))
					{
						$j++;
					}
				}else{
					//得到没有删除图片信息
					$num .= $dimgs[$i].",";
				}
			}
			$dpics->p_img = $num;
			if($dpics->save(false))
			{
				$res = [
					"message"=>"文件删除成功",
					"code"=>200
				];
				return json_encode($res);
			}else{
				$res = [
					"message"=>"文件删除失败",
					"code"=>201
				];
				return json_encode($res);
			}
		}else{
			$res = [
				"message"=>"请选择删除文件",
				"code"=>100
			];
			return json_encode($res);
		}
	}
 	//获取文件
	public function actionUpfile()
	{
		var_dump($_POST);die;
	}
	
}
