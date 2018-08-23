<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Pic extends ActiveRecord
{
    public $title;
	public $image;
	public static function tableName()
	{
		return "ba_pic";
	}
	//设置情景类型
	// public function scenarios()
	// {
		// return [
			// "pic"=>['title',"image"]
		// ];
	// }
	public function rules()
	{
		return [
			[['title'],"required","message"=>"标题不能为空"],
			[['image'],'file','skipOnEmpty'=>false,'extensions'=>'png,jpg,jpeg,gif','maxFiles'=>5]
		];
		// return [
			// [['title'],"required","message"=>"标题不能为空","on"=>"pic"],
			// [['image'],'file','skipOnEmpty'=>false,'extensions'=>['png','jpg','jpeg','gif'],'maxFiles'=>5,"on"=>"pic"]
		// ];
	}
	public function attributeLabels()
	{
		return [
			'title'=>"标题",
			"image"=>"图片"
		];
	}
}
