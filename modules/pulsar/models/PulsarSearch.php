<?php

namespace app\modules\pulsar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PulsarSearch represents the model behind the search form of `app\modules\pulsar\models\Pulsar`.
 */
class PulsarSearch extends Pulsar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'health_value', 'mood_value', 'job_value'], 'integer'],
            [['health_comment', 'mood_comment', 'job_comment'], 'safe'],
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
        $query = Pulsar::find();

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
            'health_value' => $this->health_value,
            'mood_value' => $this->mood_value,
            'job_value' => $this->job_value,
        ]);

        $query->andFilterWhere(['like', 'health_comment', $this->health_comment])
            ->andFilterWhere(['like', 'mood_comment', $this->mood_comment])
            ->andFilterWhere(['like', 'job_comment', $this->job_comment]);

        return $dataProvider;
    }
}
