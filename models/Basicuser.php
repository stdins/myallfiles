<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Basicuser extends ActiveRecord
{
    public $user;
	public $name;
    public $pass;
	public $lpass;
    public $email;
	public $trpass;
	public $ntname;
	public $ntpass;
	public $ntemail;
	public $verifyCode;
	public static function tableName()
	{
		return "ba_user";
	}
	//设置情景类型
	public function scenarios()
	{
		return [
			"login"=>['user',"lpass","verifyCode"],
			"register"=>["name","pass","trpass","email"],
			"notes"=>['ntname',"ntpass","ntemail"]
		];
	}
	public function rules()
	{
		return [
			[["user","lpass"],"required","message"=>"用户名和密码不能为空","on"=>"login"],
			[["ba_pass","name","ba_mail"],"required","message"=>"注册信息不能为空","on"=>"register"],
			["trpass","compare","compareAttribute"=>"pass",'message'=>"两次密码输入不一致","on"=>"register"],
			['verifyCode',"captcha","captchaAction"=>"/admin/login/captcha","message"=>"验证码输入错误","on"=>"login"],
			['user',"getlogin","on"=>"login"],
			['name',"getregis","on"=>"register"],
			[['ntname',"ntpass","ntemail"],"required","on"=>"notes"]
		];
	}
	public function attributeLabels()
	{
		return [
			'verifyCode'=>"验证码",
			"user"=>"用户名",
			"name"=>"用户名",
			"pass"=>"密码",
			"lpass"=>"密码",
			"trpass"=>"重复密码",
			"email"=>"邮箱",
			"ntname"=>"用户名",
			"ntpass"=>"密码",
			"ntemail"=>"邮箱"
		];
	}
   public function getlogin()
   {
		$info = self::find()->where("ba_name = :user",[':user'=>$this->user])->asArray()->all();
		if($info!=NULL)
		{
			// var_dump($this->lpass);
			//echo sha1($this->lpass)."<br/>";
			// echo "<pre>";
			//echo $info[0]['ba_pass']."<br/>";
			if($info[0]['ba_pass'] != sha1($this->lpass))
			{
				$this->addError("lpass","用户名或密码错误");
				return false;
			}
		}
		return true;
   }
   public function getregis()
   {
		$info = self::find()->where("ba_name = :ruser",[':ruser'=>$this->name])->asArray()->all();
		if($info!=NULL)
		{
			return false;
		}else{
			return true;
		}
   }
}
