<?php

namespace app\modules\project\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\project\models\Task;

/**
 * ProjectTaskSearch represents the model behind the search form of `app\modules\project\models\ProjectTask`.
 */
class TaskSearch extends Task
{

    public $created;
    public $date_start;
    public $date_end;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'project_id', 'status_id', 'progress','rfc'], 'integer'],
            [['created'],'string'],
            [['comment', 'img'], 'safe'],
            [['date_start'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_start'],
            [['date_end'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_end'],
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
        $query = Task::find();

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
            'project_id' => $this->project_id,
            'status_id' => $this->status_id,
            'progress' => $this->progress,
            'rfc' => $this->rfc,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
