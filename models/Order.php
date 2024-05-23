<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $climate_tech_type
 * @property string $climate_tech_model
 * @property string $problem_description
 * @property string $start_date
 * @property string|null $completion_date
 * @property int $status_id
 * @property int $client_id
 *
 * @property User $client
 * @property Comment[] $comments
 * @property OrderWorker[] $orderWorkers
 * @property OrderStatus $status
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['climate_tech_type', 'climate_tech_model', 'problem_description', 'start_date', 'status_id', 'client_id'], 'required'],
            [['problem_description'], 'string'],
            [['start_date', 'completion_date'], 'safe'],
            [['status_id', 'client_id'], 'integer'],
            [['climate_tech_type', 'climate_tech_model'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'climate_tech_type' => 'Climate Tech Type',
            'climate_tech_model' => 'Climate Tech Model',
            'problem_description' => 'Problem Description',
            'start_date' => 'Start Date',
            'completion_date' => 'Completion Date',
            'status_id' => 'Status ID',
            'client_id' => 'Client ID',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[OrderWorkers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderWorkers()
    {
        return $this->hasMany(OrderWorker::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'status_id']);
    }
}
