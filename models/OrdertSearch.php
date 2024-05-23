<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrdertSearch represents the model behind the search form of `app\models\Order`.
 */
class OrdertSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'client_id'], 'integer'],
            [['climate_tech_type', 'climate_tech_model', 'problem_description', 'start_date', 'completion_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'completion_date' => $this->completion_date,
            'status_id' => $this->status_id,
            'client_id' => $this->client_id,
        ]);

        $query->andFilterWhere(['like', 'climate_tech_type', $this->climate_tech_type])
            ->andFilterWhere(['like', 'climate_tech_model', $this->climate_tech_model])
            ->andFilterWhere(['like', 'problem_description', $this->problem_description]);

        return $dataProvider;
    }
}
