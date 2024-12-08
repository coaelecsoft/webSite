<?php

namespace backend\controllers;

use Yii;
use backend\models\Subslave;
use backend\models\Slave;
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
 * SubslaveController implements the CRUD actions for Subslave model.
 */
class SubslaveController extends Controller
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
     * Lists all Subslave models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subslave::find(),
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
     * Displays a single Subslave model.
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
     * Creates a new Subslave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Subslave();

        if ($model->load(Yii::$app->request->post())) {
            $masterlink = Slave::find()->where(['id' => $model->slave_id])->one()->link_sr_latn;
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
              //return $this->redirect(['/site/slave', 'page'=>$masterlink, 'subpage' => $model->link_sr_latn]); 
            return $this->redirect(['/site/slave', 'subpage'=>$masterlink, '#' => $model->link_sr_latn]); 
            } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subslave model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {
            $masterlink = Slave::find()->where(['id' => $model->slave_id])->one()->link_sr_latn;
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
              return $this->redirect(['/site/slave', 'page'=>$masterlink, 'subpage' => $model->slave->link_sr_latn, '#' => $model->link_sr_latn]); 
            } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subslave model.
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
     * Finds the Subslave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Subslave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subslave::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
