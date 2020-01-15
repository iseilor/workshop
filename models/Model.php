<?php

namespace app\models;


use app\modules\user\models\User;
use yii\db\ActiveRecord;


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
}
