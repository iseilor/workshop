<?php

namespace app\modules\jk\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrderStageSearch represents the model behind the search form of `app\modules\jk\models\OrderStage`.
 */
class OrderStageSearch extends OrderStage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'status_id'], 'integer'],
            [['order_id', 'comment'], 'safe'],
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
        $query = OrderStage::find();

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
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
