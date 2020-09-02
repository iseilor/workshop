<?php

namespace app\modules\jk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StopSearch represents the model behind the search form of `app\modules\jk\models\OrderStop`.
 */
class OrderStopSearch extends OrderStop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'order_id', 'stop_id'], 'integer'],
            [['comment'], 'safe'],
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
        $query = OrderStop::find();

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
            'order_id' => $this->order_id,
            'stop_id' => $this->stop_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        // Только заявки филиала куратора
        // TODO: При переходе на RBAC избавиться от данного условия
        $query->leftJoin('user', 'user.id = jk_order_stop.created_by');
        $query->andWhere('user.filial_id=' . Yii::$app->user->identity->filial_id);

        return $dataProvider;
    }
}
