<?php

namespace app\modules\jk\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CorpNormSearch represents the model behind the search form of `app\modules\jk\models\CorpNorm`.
 */
class CorpNormSearch extends CorpNorm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'area'], 'integer'],
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
        $query = CorpNorm::find();

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
            'number' => $this->number,
            'area' => $this->area,
        ]);

        return $dataProvider;
    }
}
