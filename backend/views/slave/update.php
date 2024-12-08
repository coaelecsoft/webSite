<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Slave $model */

$this->title = 'Update Slave: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Slaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slave-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
