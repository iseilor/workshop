<?php

namespace app\modules\kr\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kr\models\Student;

/**
 * StudentSearch represents the model behind the search form of `app\modules\kr\models\Student`.
 */
class StudentSearch extends Student
{

    public $blockTitle;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'block_id', 'weight'], 'integer'],
            [['user_id', 'description','blockTitle'], 'safe'],
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
        $query = Student::find();

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
            'block_id' => $this->blockTitle,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'total', $this->total])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
