<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'climate_tech_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'climate_tech_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'start_date')->input('date') ?>

    <?= $form->field($model, 'completion_date')->input('date') ?>

    <?= $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\OrderStatus::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'client_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id', 'login')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
