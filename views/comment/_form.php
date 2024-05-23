<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Comment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Order::find()->all(), 'id', 'climate_tech_type')) ?>

    <?= $form->field($model, 'worker_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id', 'surname')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
