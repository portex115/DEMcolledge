<?php

use app\models\OrderWorker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Order Workers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-worker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order Worker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'is_executor' => [
                'label' => 'Главный исполнитель',
                'value' => function (OrderWorker $model) {
                    return $model->is_executor ? 'True' : 'False';
                }
            ],
            'order_id' => [
                'label' => 'Заказ',
                'value' => function (OrderWorker $model) {
                    return $model->order->climate_tech_type;
                }
            ],
            'worker_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, OrderWorker $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
