<?php

namespace app\modules\admin\models;

use app\modules\admin\Module;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends Model
{
    public $id;
    public $fio;
    public $username;
    public $email;
    public $status;
    public $role_id;
    public $department_id;

    public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['id', 'status', 'role_id','department_id'], 'integer'],
            [['username', 'email','fio','role_id'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'USER_CREATED'),
            'updated_at' => Yii::t('app', 'USER_UPDATED'),
            'username' => Yii::t('app', 'USER_USERNAME'),
            'email' => Yii::t('app', 'USER_EMAIL'),
            'status' => Yii::t('app', 'USER_STATUS'),
            'role_id' => Module::t('module', 'Role Id'),
            'department_id'=> \app\modules\user\models\User::t('module', 'Department Id'),
        ];
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => ['id' => SORT_ASC],
                ],
            ]
        );
        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id' => $this->id,
                'status' => $this->status,
            ]
        );

        $query->andFilterWhere(
            [
                'id' => $this->id,
                'role_id' => $this->role_id,
            ]
        );

        $query->andFilterWhere(
            [
                'id' => $this->id,
                'department_id' => $this->department_id,
            ]
        );


        $query
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}