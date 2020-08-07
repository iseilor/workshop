<?php

namespace app\modules\jk\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AidStandardsSearch represents the model behind the search form of `app\modules\jk\models\AidStandards`.
 */
class AidStandardsSearch extends AidStandards
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'income_bottom', 'income_top', 'compensation_years_zaim',
                'skp', 'skp_young', 'compensation_years_percent'], 'integer'],
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
        $query = AidStandards::find();

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
            'income_bottom' => $this->income_bottom,
            'income_top' => $this->income_top,
            'compensation_years_zaim' => $this->compensation_years_zaim,
            'skp' => $this->skp,
            'skp_young' => $this->skp_young,
            'compensation_years_percent' => $this->compensation_years_percent,
        ]);

        return $dataProvider;
    }
}
