<?php

use app\models\Slave;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Slaves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slave-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Slave', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'master_id',
            'no',
            'menu_option',
            'page_active',
            //'page_option',
            //'page_option_1',
            //'title_sr_latn',
            //'menu_title_sr_latn',
            //'heading_sr_latn',
            //'description_sr_latn:ntext',
            //'text_sr_latn:ntext',
            //'basic_sr_latn:ntext',
            //'link_sr_latn',
            //'title_en',
            //'menu_title_en',
            //'heading_en',
            //'description_en:ntext',
            //'text_en:ntext',
            //'basic_en:ntext',
            //'link_en',
            //'e_mail',
            //'tel_1',
            //'tel_2',
            //'post_name',
            //'post_code',
            //'address',
            //'lat',
            //'long',
            //'zoom',
            //'price',
            //'data_1',
            //'data_2',
            //'menu_icon',
            //'icon',
            //'image',
            //'post_option_1',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
