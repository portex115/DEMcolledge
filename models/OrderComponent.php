<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_component".
 *
 * @property int $id
 * @property int $order_id
 * @property int $component_id
 *
 * @property Component $component
 * @property OrderWorker $order
 */
class OrderComponent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'component_id'], 'required'],
            [['order_id', 'component_id'], 'integer'],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => Component::class, 'targetAttribute' => ['component_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderWorker::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'component_id' => 'Component ID',
        ];
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(Component::class, ['id' => 'component_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(OrderWorker::class, ['id' => 'order_id']);
    }
}
