<?php

namespace app\models;


use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;


class Model extends ActiveRecord
{

    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getDeletedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    // Ссылка на пользователя который создал документ
    public function getCreatedUserLink(){
        $model= $this->hasOne(User::className(), ['id' => 'created_by'])->one();
        return Html::a($model->fio,Url::to(['/user/'.$model->id]));
    }

    // Ссылка на пользователя который изменил документ
    public function getUpdatedUserLink(){
        $model= $this->hasOne(User::className(), ['id' => 'updated_by'])->one();
        if ($model){
            return Html::a($model->fio,Url::to(['/user/'.$model->id]));
        }else{
            false;
        }
    }



    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return date('U');
                },
            ],
            'BlameableBehavior' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
                'value' => function () {
                    return \Yii::$app->user->identity->getId();
                },
            ]
        ];
    }
}
