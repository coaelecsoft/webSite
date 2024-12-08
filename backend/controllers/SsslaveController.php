<?php

namespace backend\controllers;

use Yii;
use backend\models\Ssslave;
use backend\models\Subslave;
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
 * SsslaveController implements the CRUD actions for Ssslave model.
 */
class SsslaveController extends Controller
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
     * Lists all Ssslave models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ssslave::find(),
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
     * Displays a single Ssslave model.
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
     * Creates a new Ssslave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ssslave();

        if ($model->load(Yii::$app->request->post())) {
            $masterlink = Subslave::find()->where(['id' => $model->sub_slave_id])->one()->link_sr_latn;
            $imageName = $model->link_sr_latn.'-'.$masterlink;//Yii::$app->mycoms->wordtourl($model->title_sr_latn);


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
            $model->save();
              return $this->redirect(['/site/subslave', 'subpage'=>$masterlink, '#' => $model->link_sr_latn/*'subpage' => */]); 
            } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ssslave model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $masterlink = Subslave::find()->where(['id' => $model->sub_slave_id])->one()->link_sr_latn;
            $imageName = $model->link_sr_latn.'-'.$masterlink;//Yii::$app->mycoms->wordtourl($model->title_sr_latn);


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
            $model->save();
              return $this->redirect(['/site/subslave', 'page'=>$masterlink, 'subpage' => $masterlink]); 
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
     * Deletes an existing Ssslave model.
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
     * Finds the Ssslave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ssslave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ssslave::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
