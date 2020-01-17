<?php

namespace app\models;


use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;


class Model extends ActiveRecord
{
    
    public function getCreatedUser(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedUser(){
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getDeletedUser(){
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return new Expression('NOW()');
                },
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
