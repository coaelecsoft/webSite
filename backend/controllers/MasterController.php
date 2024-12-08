<?php

namespace backend\controllers;

use Yii;
use backend\models\Master;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use yii\filters\AccessControl;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\components\AccessRule;
use common\models\User;
/**
 * MasterController implements the CRUD actions for Master model.
 */
class MasterController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Master models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Master::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Master model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Master model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Master();

        if ($model->load(Yii::$app->request->post())) {
            $imageName = Yii::$app->mycoms->wordtourl($model->link_sr_latn).time();

            if ($model->logo = UploadedFile::getInstance($model, 'logo')) {
                $model->logo->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_logo.' . $model->logo->extension);
                $model->icon = $imageName . '_logo.' . $model->logo->extension;
            }

            if ($model->back = UploadedFile::getInstance($model, 'back')) {
                $model->back->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin.' . $model->back->extension);
                $originFile = Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin.' . $model->back->extension;

                if ($model->back->extension == 'jpg') {
                    
                    if ($originFile != '') {
                        ini_set('memory_limit', '-1');
                        
                        Image::getImagine()->open($originFile)
                                ->thumbnail(new Box(1280, 1280))
                                ->save(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_image.' . $model->back->extension, ['quality' => 80]);
                        $model->image = $imageName . '_image.' . $model->back->extension;
                        unlink($originFile);
                    }
                } else {
                    $model->image = $imageName . '_origin.' . $model->back->extension;
                }
            }
            
            if ($model->back1 = UploadedFile::getInstance($model, 'back1')) {
                $model->back1->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin1.' . $model->back1->extension);
                $originFile1 = Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin1.' . $model->back1->extension;

                if ($model->back1->extension == 'jpg') {
                    
                    if ($originFile1 != '') {
                        ini_set('memory_limit', '-1');
                        
                        Image::getImagine()->open($originFile1)
                                ->thumbnail(new Box(1280, 1280))
                                ->save(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_image1.' . $model->back1->extension, ['quality' => 80]);
                        $model->image1 = $imageName . '_image1.' . $model->back1->extension;
                        unlink($originFile1);
                    }
                } else {
                    $model->image1 = $imageName . '_origin1.' . $model->back1->extension;
                }
            }
            $model->save();
            if($model->id == 1){
           // return $this->redirect(['/site/index']); // ,'page' => $model->link_sr_latn '/site/page', 'page' => $model->up->link_sr_latn
            }else{
                
                  if($model->menu_option == '0'){
           // return $this->redirect(['view', 'id' => $model->id]);
            // return $this->redirect(['/site/master', 'page'=>$model->master->$link_name, '#' => $model->$link_name]);  
                      return $this->redirect(['/site/index','#' => $model->link_sr_latn]); 
            }elseif($model->menu_option == '1'){
              return $this->redirect(['/site/master', 'page' => $model->link_sr_latn]);
            }
                
                /*
                if($model->menu_option == 1){
              return $this->redirect(['/site/master', 'page' => $model->link_sr_latn]);  
                }else{
                   return $this->redirect(['/site/index','#' => $model->link_sr_latn]); 
                }
                 * 
                 */
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Master model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $mytype)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            $imageName = Yii::$app->mycoms->wordtourl($model->link_sr_latn).time();

            if ($model->logo = UploadedFile::getInstance($model, 'logo')) {
                $model->logo->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_logo.' . $model->logo->extension);
                $model->icon = $imageName . '_logo.' . $model->logo->extension;
            }

            if ($model->back = UploadedFile::getInstance($model, 'back')) {
                $model->back->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin.' . $model->back->extension);
                $originFile = Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin.' . $model->back->extension;

                if ($model->back->extension == 'jpg') {
                    
                    if ($originFile != '') {
                        ini_set('memory_limit', '-1');
                        
                        Image::getImagine()->open($originFile)
                                ->thumbnail(new Box(1280, 1280))
                                ->save(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_image.' . $model->back->extension, ['quality' => 80]);
                        $model->image = $imageName . '_image.' . $model->back->extension;
                        unlink($originFile);
                    }
                } else {
                    $model->image = $imageName . '_origin.' . $model->back->extension;
                }
            }
            
             if ($model->back1 = UploadedFile::getInstance($model, 'back1')) {
                $model->back1->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin1.' . $model->back1->extension);
                $originFile1 = Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_origin1.' . $model->back1->extension;

                if ($model->back1->extension == 'jpg') {
                    
                    if ($originFile1 != '') {
                        ini_set('memory_limit', '-1');
                        
                        Image::getImagine()->open($originFile1)
                                ->thumbnail(new Box(1280, 1280))
                                ->save(Yii::getAlias('@root') . '/frontend/web/uploads/master/' . $imageName . '_image1.' . $model->back1->extension, ['quality' => 80]);
                        $model->image1 = $imageName . '_image1.' . $model->back1->extension;
                        unlink($originFile1);
                    }
                } else {
                    $model->image1 = $imageName . '_origin1.' . $model->back1->extension;
                }
            }
            $model->save();
            if($model->id == 1){
            return $this->redirect(['/site/index']); // ,'page' => $model->link_sr_latn '/site/page', 'page' => $model->up->link_sr_latn
            }else{
                  if($mytype == '1'){
           // return $this->redirect(['view', 'id' => $model->id]);
            // return $this->redirect(['/site/master', 'page'=>$model->master->$link_name, '#' => $model->$link_name]);  
                      return $this->redirect(['/site/index','#' => $model->link_sr_latn]); 
            }elseif($mytype == '2'){
              return $this->redirect(['/site/master', 'page' => $model->link_sr_latn]);
            }
                
                /*
                if($model->menu_option == 1){
              return $this->redirect(['/site/master', 'page' => $model->link_sr_latn]);  
                }else{
                   return $this->redirect(['/site/index','#' => $model->link_sr_latn]); 
                }
                 * 
                 */
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
        /*
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
         * 
         */
    }

    /**
     * Deletes an existing Master model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Master model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Master the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Master::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
