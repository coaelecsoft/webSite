<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Master;
use backend\models\Slave;
use backend\models\Subslave;
use backend\models\Ssslave;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','master','slave', 'subslave','ssslave'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
         $others = Master::find()->onCondition(['menu_option' => '0'])->orderBy(['no' => SORT_ASC])->all();
        
        return $this->render('index', [
                    'main' => $main,
                    'others' => $others
        ]);
    }    
    
    /**
     * Displays homepage. In my case this name is Main
     *
     * @return string
     */
    public function actionMaster($page)
    
    
    {
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
    // $main = Master::find()->where(['link_'.$lang_link => $page])->one();
       $main = Master::find()->where(['link_'.$lang_link => $page])->one();
        
         
        
        // $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
        // $others = Master::find()->all();
        
        return $this->render('master', [
                    'main' => $main,
                   // 'others' => $others
        ]);
       
    }    
    
     public function actionSlave($subpage)
    {
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
    // $main = Master::find()->where(['link_'.$lang_link => $page])->one();
       $main = Slave::find()->where(['link_'.$lang_link => $subpage])->one();
        
         
        
        // $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
        // $others = Master::find()->all();
        
        return $this->render('slave', [
                    'main' => $main,
                   // 'others' => $others
        ]);
       
    }    
    
     public function actionSubslave($subpage)
    
    
    {
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));

    // $main = Master::find()->where(['link_'.$lang_link => $page])->one();
       $main = Subslave::find()->where(['link_'.$lang_link => $subpage])->one();
        
         
        
        // $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
        // $others = Master::find()->all();
        
        return $this->render('subslave', [
                    'main' => $main,
                   // 'others' => $others
        ]);
       
    }     
    
public function actionSsslave($subpage)
    
    
    {
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));

    // $main = Master::find()->where(['link_'.$lang_link => $page])->one();
       $main = Ssslave::find()->where(['link_'.$lang_link => $subpage])->one();      
        // $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
        // $others = Master::find()->all();
        
        return $this->render('ssslave', [
                    'main' => $main,
                   // 'others' => $others
        ]);
       
    }
    
    
/*
    public function actionMaster($page) {
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));

        // $master = Master::find()->where(['link_'.$lang_link => $page])->one();
        if (($master = Master::find()->where(['link_' . $lang_link => $page])->one()) !== null) {
            if ($master->id == 1) {
                return $this->redirect(['home']);
            } else {
                $master = Master::find()->where(['link_' . $lang_link => $page])->one();
            }
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $this->render('master', [
                    'model' => $master,
        ]);
    }
 * 
 */
    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
