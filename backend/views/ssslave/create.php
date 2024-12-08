<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Slave $model */

$this->title = 'Create Slave';
$this->params['breadcrumbs'][] = ['label' => 'Slaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slave-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
