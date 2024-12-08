<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Master;
use backend\models\Slave;
use backend\models\Subslave;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
    public function actions() {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
        $others = Master::find()->onCondition(['menu_option' => '0'])->orOnCondition(['menu_option' => '2'])->andOnCondition(['page_active' => '1'])->orderBy(['no' => SORT_ASC])->all();
        $slider = Master::find()->onCondition(['menu_option' => '0'])->andOnCondition(['page_active' => '1'])->andOnCondition(['page_option' => '3'])->orderBy(['no' => SORT_ASC])->all();

        return $this->render('index', [
                    'main' => $main,
                    'others' => $others,
                    'slider' => $slider,
        ]);
    }

    public function actionMaster($page) {
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
        $main = Master::find()->where(['link_' . $lang_link => $page])->one();
        $home = Master::find()->where(['id' => '1'])->one();
        if ($main != null) {
            // $main = Master::find()->where(['id' => 1])->one();
            //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
            // $others = Master::find()->all();
            return $this->render('master', [
                        'main' => $main,
                        'home' => $home,
                            // 'others' => $others
            ]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionSlave($page, $subpage) {
        
          $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
          $link_name = 'link_' . $lang_link;
           $home = Master::find()->where(['id' => '1'])->one();



        if (($slave = Slave::find()->where([$link_name => $subpage])->one()) !== null) {
            //$slave = Slave::find()->where([$link_name => $subpage])->one();
            //$master_id = $slave->master_id;
            $master = Master::find()->where(['id' => $slave->master_id])->one();

            if ($master->$link_name != $page) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $this->render('slave', [
                    'main' => $slave,
                    'home' => $home,
        ]);
        /*
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
        $master = Master::find()->where(['link_' . $lang_link => $page])->one();        
        $home = Master::find()->where(['id' => '1'])->one();
        
        if ($master != null) {

            // $main = Master::find()->where(['id' => 1])->one();
            //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
            // $others = Master::find()->all();
            $main = Slave::find()->where(['link_' . $lang_link => $subpage])->one();
            
            if ($main !== null) {
                
                if(1){
                
                return $this->render('slave', [
                            'main' => $main,
                            'home' => $home,
                                // 'others' => $others
                ]);
                }else {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
                
                
            } else {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
            
            
            
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
         * 
         */
    }
    
    
    
    

    public function actionSubslave($subsubpage, $subpage, $page) {
      // $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));

        // $main = Master::find()->where(['link_'.$lang_link => $page])->one();
        //$main = Subslave::find()->where(['link_' . $lang_link => $subsubpage])->one();

        // $main = Master::find()->where(['id' => 1])->one();
        //$master_all = Master::find()->orderBy(['no' => SORT_ASC])->all();
        // $others = Master::find()->all();
        $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
        $link_name = 'link_' . $lang_link;
        
         if ((Subslave::find()->where([$link_name => $subsubpage])->one()) !== null) {
            
            $slave = Subslave::find()->where([$link_name => $subsubpage])->one();
            $slave_id = $slave->slave_id;
            $master = Slave::find()->where(['id' => $slave_id])->one();
            
            
            if ($master->$link_name != $subpage) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }else{
                
                $upmaster = Master::find()->where(['id' => $master->master_id])->one();
                if ($upmaster->$link_name != $page) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
            }
            
            
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        
        
        
        
        return $this->render('subslave', [
                    'main' => $slave,
                    
                        // 'others' => $others
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token) {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail() {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
                    'model' => $model
        ]);
    }
}
