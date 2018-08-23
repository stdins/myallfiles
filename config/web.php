<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'YYNek6FVsjBGoFLOUiTkRbxuD4lnBB8s',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
			'viewPath'=>'@yii/mail',
            'useFileTransport' => false,//这里一定要改成false，不然邮件不会发送
			'transport'=>[
				'class'=>'Swift_SmtpTransport',
				'host'=>'smtp.qq.com',
				'username'=>'1046075930@qq.com',
				'password'=>'xtpugddnvezxbfgd',//用POP3/SMTP的提示密码
				'port'=>'587',
				'encryption'=>'tls'
			]
			// 'messageConfig'=>[
				// 'charset'=>'UTF-8',
				// 'form'=>''
			// ]
		],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		//阿里云短信
		'aliyun'=>[
			'class'=>'saviorlv\aliyun\Sms',
			'accessKeyId' => 'LTAIOx2fRwdrFdC7',
			'accessKeySecret' => 'foEgtyyHjNsYLZN4pgmq7ZLfXMrElk'
		],
		
        'db' => $db,
        'urlManager' => [
			'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'enableStrictParsing'=>false,
			'suffix'=>".html",
            'rules' => [
				"admin/login"=>"admin/login/index",
				"admin/captcha"=>"admin/login/captcha",
            ],
        ],
    ],
	//测试组件
	// 'modules' => [
	   // 'admin' => [
		  // 'class' => 'app\modules\admin\Module',
	   // ],
	// ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
		//"admin"=>"app\modules\admin\Module"
    ];
	$config['modules']['admin']=[
		"class"=>"app\modules\admin\Module"
	];
}

return $config;
