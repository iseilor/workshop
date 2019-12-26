<?php

namespace app\modules\main\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\main\models\Team;
use yii\db\Expression;

/**
 * TeamSearch represents the model behind the search form of `app\modules\main\models\Team`.
 */
class TeamSearch extends Team
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'birth'], 'integer'],
            [['name', 'full_name', 'filial', 'position', 'department', 'email', 'phone', 'address', 'photo', 'about'], 'safe'],
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
        $query = Team::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id' => $this->id,
                'created_at' => $this->created_at,
                'created_by' => $this->created_by,
                'updated_at' => $this->updated_at,
                'updated_by' => $this->updated_by,
                'deleted_at' => $this->deleted_at,
                'deleted_by' => $this->deleted_by,
                'birth' => $this->birth,
            ]
        );

        $query->orderBy(new Expression('rand()'));

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'filial', $this->filial])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'about', $this->about]);

        return $dataProvider;
    }
}
