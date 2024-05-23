<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "component".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 *
 * @property OrderComponent[] $orderComponents
 */
class Component extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[OrderComponents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderComponents()
    {
        return $this->hasMany(OrderComponent::class, ['component_id' => 'id']);
    }
}
