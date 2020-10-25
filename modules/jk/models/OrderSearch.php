<?php

namespace app\modules\jk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrderSearch represents the model behind the search form of `app\modules\jk\models\Order`.
 */
class OrderSearch extends Order
{

    public $statusName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['statusName'], 'safe'],
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
        $query = Order::find()->published();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /*$dataProvider->setSort([
            'attributes' => [
                'id',
                'statusName' => [
                    'asc' => [OrderStatus::tableName().'.title' => SORT_ASC],
                    'desc' => [OrderStatus::tableName().'.title' => SORT_DESC],
                    'label' => 'Status Name'
                ]
            ]
        ]);*/

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //$query->joinWith([OrderStatus::tableName()]);
            return $dataProvider;
        }

        //$this->addCondition($query, 'status_id');

        /*$query->joinWith(['status' => function ($q) {
            $q->where(OrderStatus::tableName().'.title LIKE "%' . $this->statusName . '%"');
        }]);*/

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'status_id' => $this->statusName,
        ]);

        // Только заявки филиала куратора
        // TODO: При переходе на RBAC избавиться от данного условия
        $query->leftJoin('user', 'user.id = jk_order.created_by');
        $query->andWhere('user.filial_id=' . Yii::$app->user->identity->filial_id);

        return $dataProvider;
    }
}