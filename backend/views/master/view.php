<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Master $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no',
            'menu_option',
            'page_active',
            'page_option',
            'page_option_1',
            'title_sr_latn',
            'menu_title_sr_latn',
            'heading_sr_latn',
            'description_sr_latn:ntext',
            'text_sr_latn:ntext',
            'basic_sr_latn:ntext',
            'link_sr_latn',
            'title_en',
            'menu_title_en',
            'heading_en',
            'description_en:ntext',
            'text_en:ntext',
            'basic_en:ntext',
            'link_en',
            'e_mail',
            'tel_1',
            'tel_2',
            'post_name',
            'post_code',
            'address',
            'lat',
            'long',
            'zoom',
            'price',
            'data_1',
            'data_2',
            'menu_icon',
            'icon',
            'image',
            'post_option_1',
        ],
    ]) ?>

</div>
