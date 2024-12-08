<?php
use yii\rest\UrlRule;
use yii\web\JsonParser;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name' => 'WebSite Name',
    'defaultRoute' => 'site/home',
     'language' => 'sr-Latn',
    
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'headers'],//,'headers','assetsAutoCompress'
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'mycoms' => [
            'class' => 'common\components\WordToUrl',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'class' => 'common\components\Request',
            'web' => '/frontend/web',
        ],
        'urlManager' => [
            'class' => 'common\components\UrlManager',
            'languages' => ['sr-Latn', 'sr', 'de', 'nl', 'en'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                 ['class' => UrlRule::class, 'controller' => ['post', 'comment']],
                '' => 'site/index',
              //  'about' => 'site/about',
               // 'index' => 'site/index',
                '<page>' => 'site/master',
                '<page>/<subpage>' => 'site/slave',
                '<page>/<subpage>/<subsubpage>' => 'site/subslave',
                '<page>/<subpage>/<subsubpage>/<subsubsubpage>' => 'site/ssslave',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
             'bundles' => [
                //require  dirname(__DIR__).'/assets/AppAsset.php',
                /*


                  'yii\bootstrap\BootstrapPluginAsset' => [
                  'js'=>[]
                  ],

                  'yii\web\JqueryAsset' => [
                  'js'=>[]
                  ],


                  'yii\bootstrap4\BootstrapPluginAsset' => [
                  'js' => []
                  ],
                 * 
                 * 
                 * 'yii\bootstrap5\BootstrapAsset' => [
                    'css' => [],
                ],
                 * 
                 * 'yii\bootstrap5\BootstrapAsset' => [
                    'css' => [],
                ],
                 *  */

                
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyBoV4ehpbFW1wb5EvZC34F89VLlczsBjgU',
                        'language' => 'sr_Latn',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
         'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,
            'readFileTimeout' => 1, //Time in seconds for reading each asset file
            'jsCompress' => true, //Enable minification js in html code
            'jsCompressFlaggedComments' => true, //Cut comments during processing js
            'cssCompress' => true, //Enable minification css in html code
            'cssFileCompile' => true, //Turning association css files
            'cssFileRemouteCompile' => true, //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress' => true, //Enable compression and processing before being stored in the css file
            'cssFileBottom' => false, //Moving down the page css files
            'cssFileBottomLoadOnJs' => false, //Transfer css file down the page and uploading them using js
            'jsFileCompile' => true, //Turning association js files
            'jsFileRemouteCompile' => false, //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress' => true, //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true, //Cut comments during processing js
            'noIncludeJsFilesOnPjax' => true, //Do not connect the js files when all pjax requests
            'htmlFormatter' => [
                //Enable compression html
                'class' => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra' => true, //use more compact algorithm
                'noComments' => true, //cut all the html comments
                'maxNumberRows' => 50000, //The maximum number of rows that the formatter runs on
            //or
            //'class' => 'skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',
            //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface
            //or false
            ],
        ],
        
        
        
        
         'headers' => [
            //https://github.com/hyperia-sk/yii2-secure-headers
            'class' => '\hyperia\security\Headers',
            'upgradeInsecureRequests' => true,
            'blockAllMixedContent' => false,
            'requireSriForScript' => false,
            'requireSriForStyle' => false,
            'xssProtection' => true,
            'contentTypeOptions' => true,
            'strictTransportSecurity' => [
                'max-age' => 63072000,
                'includeSubDomains' => true,
                'preload' => true
            ],
            'xFrameOptions' => 'DENY',
            'xPoweredBy' => false,
            //'xPoweredBy' => 'Hyperia',
            'referrerPolicy' => 'no-referrer',
            'reportOnlyMode' => false,
            //'reportUri' => 'https://company.report-uri.com/r/d/csp/enforce',
            'reportTo' => [
                [
                    'group' => 'groupName',
                    'max_age' => 31536000,
                    'endpoints' => [
                        [
                            'name' => 'endpointName',
                            'url' => 'https://awd.rs',
                            'failures' => 1
                        ]
                    ]
                ]
            ],
            'cspDirectives' => [
                'connect-src' => "'self' https://www.google-analytics.com https://www.w3.org/Icons/WWW/w3c_home_nb  https://schema.org https://region1.google-analytics.com https://www.googletagmanager.com/ https://googlechrome.github.io/lighthouse/viewer/ https://jigsaw.w3.org/css-validator/check/referer https://silktide.com/cookieconsent  https://*.googleapis.com *.google.com https://*.gstatic.com  data: blob:;",
                'font-src' => "'self' https://fonts.gstatic.com;",
                'frame-src' => "'self' https://schema.org https://codesandbox.io",
                'img-src' => "'self' data: https://*.googleapis.com https://*.gstatic.com *.google.com *.googleusercontent.com   https://www.w3.org/Icons/WWW/w3c_home_nb https://iconape.com/wp-content/png_logo_vector/google-lighthouse.png https://jigsaw.w3.org/css-validator/images/vcss-blue https://securityheaders.com/images/A.png https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/logo.png https://www.idconsultinggroup.rs",
                'manifest-src' => "'self'",
                'object-src' => "'self' ",
             //   'prefetch-src' => "'self'",
                'script-src' => "'self' 'unsafe-inline' 'unsafe-eval' https://www.google-analytics.com https://schema.org https://www.googletagmanager.com/ https://googlechrome.github.io/lighthouse/viewer/ https://*.googleapis.com https://*.gstatic.com *.google.com https://*.ggpht.com *.googleusercontent.com;",
                'style-src' => "'self' 'unsafe-inline' https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/dark-bottom.css   https://fonts.googleapis.com",
                'media-src' => "'self'",
                'form-action' => "'self'",
                'worker-src' => "'self'",
                'report-to' => 'groupname'



            /*
              'connect-src' => "'self' https://jigsaw.w3.org/css-validator/check/referer https://silktide.com/cookieconsent  https://*.googleapis.com *.google.com https://*.gstatic.com  data: blob:;",
              'font-src' => "'self' https://fonts.gstatic.com;",
              'frame-src' => "'self' ",
              'img-src' => "'self' https://www.w3.org/2000/svg https://iconape.com/wp-content/png_logo_vector/ https://securityheaders.com/images/A.png https://www.w3.org/Icons/WWW/w3c_home_nb https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/logo.png https://jigsaw.w3.org/css-validator/images/vcss-blue https://*.googleapis.com https://*.gstatic.com *.google.com *.googleusercontent.com",
              'manifest-src' => "'self'",
              'object-src' => "'self'",
              'prefetch-src' => "'self'",
              'script-src' => "'self' 'unsafe-inline' 'unsafe-eval' https://*.googleapis.com https://*.gstatic.com *.google.com https://*.ggpht.com *.googleusercontent.com;",
              'style-src' => "'self' 'unsafe-inline' https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/dark-bottom.css  https://fonts.googleapis.com",
              'media-src' => "'self'",
              'form-action' => "'self'",
              'worker-src' => "'self'",
              'report-to' => 'groupname'
             * 
             */
            ],
            // Deprecated. Use Permissions Policy instead.
            'featurePolicyDirectives' => [
                /*
                'accelerometer' => "'self'",
              //  'ambient-light-sensor' => "'self'",
                'autoplay' => "'self'",
               // 'battery' => "'self'",
                'camera' => "'self'",
                'display-capture' => "'self'",
               // 'document-domain' => "'self'",
                'encrypted-media' => "'self'",
                'fullscreen' => "'self'",
                'geolocation' => "'self'",
                'gyroscope' => "'self'",
                //'layout-animations' => "'self'",
                'magnetometer' => "'self'",
                'microphone' => "'self'",
                'midi' => "'self'",
               // 'oversized-images' => "'self'",
                'payment' => "'self'",
                'picture-in-picture' => "*",
                'publickey-credentials-get' => "'self'",
                'sync-xhr' => "'self'",
                'usb' => "'self'",
              //  'wake-lock' => "'self'",
                'xr-spatial-tracking' => "'self'"
                 * 
                 */
            ],
            'permissionsPolicyDirectives' => [
                /*
                'accelerometer' => "self",
             //   'ambient-light-sensor' => "self",
                'autoplay' => "self",
               /// 'battery' => "self",
                'camera' => "self",
                'display-capture' => "self",
              //  'document-domain' => "self",
                'encrypted-media' => "self",
                'fullscreen' => "self",
                'geolocation' => "self",
                'gyroscope' => "self",
              //  'layout-animations' => "self",
                'magnetometer' => "self",
                'microphone' => "self",
                'midi' => "self",
                //'oversized-images' => "self",
                'payment' => "self",
                'picture-in-picture' => "*",
                'publickey-credentials-get' => "self",
                'sync-xhr' => "self",
                'usb' => "self",
             //   'wake-lock' => "self",
                'xr-spatial-tracking' => "self"
                 * 
                 */
            ]
        ],
        
        
    ],
    'params' => $params,
];
