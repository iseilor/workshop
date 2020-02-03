<?php

namespace app\modules\jk\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\jk\models\Zaim;

/**
 * ZaimSearch represents the model behind the search form of `app\modules\jk\models\Zaim`.
 */
class ZaimSearch extends Zaim
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'gender', 'experience', 'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'compensation_count', 'compensation_years'], 'integer'],
            [['created_at', 'updated_at', 'date_birth'], 'safe'],
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
        $query = Zaim::find();

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
            'date_birth' => $this->date_birth,
            'gender' => $this->gender,
            'experience' => $this->experience,
            'family_count' => $this->family_count,
            'family_income' => $this->family_income,
            'area_total' => $this->area_total,
            'area_buy' => $this->area_buy,
            'cost_total' => $this->cost_total,
            'cost_user' => $this->cost_user,
            'bank_credit' => $this->bank_credit,
            'compensation_count' => $this->compensation_count,
            'compensation_years' => $this->compensation_years,
        ]);

        return $dataProvider;
    }
}
