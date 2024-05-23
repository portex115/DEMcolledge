<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_worker".
 *
 * @property int $id
 * @property int $is_executor 0 - false
 1 - true
 * @property int $order_id
 * @property int|null $worker_id
 *
 * @property Order $order
 * @property OrderComponent[] $orderComponents
 * @property User $worker
 */
class OrderWorker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_worker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_executor', 'order_id', 'worker_id'], 'integer'],
            [['order_id'], 'required'],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['worker_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_executor' => 'Is Executor',
            'order_id' => 'Order ID',
            'worker_id' => 'Worker ID',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[OrderComponents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderComponents()
    {
        return $this->hasMany(OrderComponent::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(User::class, ['id' => 'worker_id']);
    }
}
