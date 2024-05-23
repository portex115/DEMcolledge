<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrdertSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'climate_tech_type') ?>

    <?= $form->field($model, 'climate_tech_model') ?>

    <?= $form->field($model, 'problem_description') ?>

    <?= $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'completion_date') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
