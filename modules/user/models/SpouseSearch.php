<?php

namespace app\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SpouseSearch represents the model behind the search form of `app\modules\user\models\Spouse`.
 */
class SpouseSearch extends Spouse
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'gender', 'date', 'passport_date', 'is_work', 'is_rtk', 'is_do'], 'integer'],
            [['fio', 'passport_series', 'passport_number', 'passport_department', 'passport_code', 'passport_file', 'edj_file', 'marriage_file', 'registration_file', 'explanatory_note_file', 'work_file', 'unemployment_file', 'salary_file'], 'safe'],
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
        $query = Spouse::find();

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
            'user_id' => $this->user_id,
            'gender' => $this->gender,
            'date' => $this->date,
            'passport_date' => $this->passport_date,
            'is_work' => $this->is_work,
            'is_rtk' => $this->is_rtk,
            'is_do' => $this->is_do,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'passport_series', $this->passport_series])
            ->andFilterWhere(['like', 'passport_number', $this->passport_number])
            ->andFilterWhere(['like', 'passport_department', $this->passport_department])
            ->andFilterWhere(['like', 'passport_code', $this->passport_code])
            ->andFilterWhere(['like', 'passport_file', $this->passport_file])
            ->andFilterWhere(['like', 'marriage_file', $this->marriage_file])
            ->andFilterWhere(['like', 'registration_file', $this->registration_file])
            ->andFilterWhere(['like', 'explanatory_note_file', $this->explanatory_note_file])
            ->andFilterWhere(['like', 'work_file', $this->work_file])
            ->andFilterWhere(['like', 'unemployment_file', $this->unemployment_file])
            ->andFilterWhere(['like', 'salary_file', $this->salary_file]);

        return $dataProvider;
    }
}
