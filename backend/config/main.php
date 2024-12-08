<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name' => 'CMS Lu',    
    'defaultRoute' => 'site/index',
    'language' => 'sr-Latn',
    
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'mycoms' => [
            'class' => 'common\components\WordToUrl',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'assetManager' => [
            'converter' => [
                'class' => 'nizsheanez\assetConverter\Converter',
                'force' => false, // true : If you want convert your sass each time without time dependency
                'destinationDir' => '', //at which folder of @webroot put compiled files
                'parsers' => [
                    'sass' => [// file extension to parse
                        'class' => 'nizsheanez\assetConverter\Sass',
                        'output' => 'css', // parsed output file type
                        'options' => [
                            'cachePath' => '@app/runtime/cache/sass-parser' // optional options
                        ],
                    ],
                    'scss' => [// file extension to parse
                        'class' => 'nizsheanez\assetConverter\Scss',
                        'output' => 'css', // parsed output file type
                        'options' => [// optional options
                            'enableCompass' => false, // default is true
                            'importPaths' => [], // import paths, you may use path alias here, 
                            // e.g., `['@path/to/dir', '@path/to/dir1', ...]`
                            'lineComments' => false, // if true — compiler will place line numbers in your compiled output
                            'outputStyle' => 'nested', // May be `compressed`, `crunched`, `expanded` or `nested`,
                        // see more at http://sass-lang.com/documentation/file.SASS_REFERENCE.html#output_style
                        ],
                    ],
                    'less' => [// file extension to parse
                        'class' => 'nizsheanez\assetConverter\Less',
                        'output' => 'css', // parsed output file type
                        'options' => [
                            'importDirs' => [], // import paths, you may use path alias here ex. '@app/assets/common/less'
                            'auto' => true, // optional options
                        ]
                    ]
                ]
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
         'urlManagerFrontend'=>[

			'enablePrettyUrl' => true,

			'class' => 'yii\web\UrlManager',

			'showScriptName'=>false,

			//'suffix' => '.html',

			'hostInfo' => Yii::$app->params['website'].'/frontend/web',

			'baseUrl' => Yii::$app->params['website'].'/frontend/web',
                       
                        

		],
        
         'assetManager' => [
            'converter' => [
                'class' => 'nizsheanez\assetConverter\Converter',
                'force' => false, // true : If you want convert your sass each time without time dependency
                'destinationDir' => '', //at which folder of @webroot put compiled files
                'parsers' => [
                    'sass' => [// file extension to parse
                        'class' => 'nizsheanez\assetConverter\Sass',
                        'output' => 'css', // parsed output file type
                        'options' => [
                            'cachePath' => '@app/runtime/cache/sass-parser' // optional options
                        ],
                    ],
                    'scss' => [// file extension to parse
                        'class' => 'nizsheanez\assetConverter\Scss',
                        'output' => 'css', // parsed output file type
                        'options' => [// optional options
                            'enableCompass' => false, // default is true
                            'importPaths' => [], // import paths, you may use path alias here, 
                            // e.g., `['@path/to/dir', '@path/to/dir1', ...]`
                            'lineComments' => false, // if true — compiler will place line numbers in your compiled output
                            'outputStyle' => 'nested', // May be `compressed`, `crunched`, `expanded` or `nested`,
                        // see more at http://sass-lang.com/documentation/file.SASS_REFERENCE.html#output_style
                        ],
                    ],
                    'less' => [// file extension to parse
                        'class' => 'nizsheanez\assetConverter\Less',
                        'output' => 'css', // parsed output file type
                        'options' => [
                            'importDirs' => [], // import paths, you may use path alias here ex. '@app/assets/common/less'
                            'auto' => true, // optional options
                        ]
                    ]
                ]
            ],
             ],
    ],
    'params' => $params,
];
