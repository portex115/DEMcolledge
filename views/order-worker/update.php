<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrderWorker $model */

$this->title = 'Update Order Worker: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-worker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
