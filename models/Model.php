<?php

namespace app\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 */
class Model extends ActiveRecord
{

    /**
     * @return \app\modules\user\models\User
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getCreatedDate(){
        return Yii::$app->formatter->asDate($this->created_at);
    }

    public function getCreatedDateTime(){
        return Yii::$app->formatter->asDatetime($this->created_at);
    }

    public function getUpdatedUser()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getDeletedUser()
    {
        return $this->hasOne(User::class, ['id' => 'deleted_by']);
    }

    // Ссылка на пользователя который создал документ
    public function getCreatedUserLink()
    {
        $model = $this->hasOne(User::class, ['id' => 'created_by'])->one();
        return Html::a($model->fioShort, Url::to(['/user/' . $model->id], true));
    }

    // Ссылка на пользователя, который изменил документ
    public function getUpdatedUserLink()
    {
        $model = $this->hasOne(User::class, ['id' => 'updated_by'])->one();
        if ($model) {
            return Html::a($model->fioShort, Url::to(['/user/' . $model->id]));
        } else {
            false;
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),

            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),

            'createdUserLink' => Yii::t('app', 'Created By'),
            'updatedUserLink' => Yii::t('app', 'Updated By'),
            'deletedUserLink' => Yii::t('app', 'Deleted By'),

            'weight'=> Yii::t('app', 'Weight')

        ];
    }

    // Ссылка на пользователя, который удалил документ
    public function getDeletedUserLink()
    {
        $model = $this->hasOne(User::class, ['id' => 'deleted_by'])->one();
        if ($model) {
            return Html::a($model->fio, Url::to(['/user/' . $model->id]));
        } else {
            false;
        }
    }


    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return date('U');
                },
            ],
            'BlameableBehavior' => [
                'class' => BlameableBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
                'value' => function () {
                    return \Yii::$app->user->identity->getId();
                },
            ],
        ];
    }

    // Логическое удаление
    public function delete()
    {
        $this->deleted_at = date('U');
        $this->deleted_by = Yii::$app->user->identity->getId();
        $this->save();
    }

    public function getCreatedUserLabel()
    {
        $img = Html::img($this->createdUser->photoPath, ['alt' => $this->createdUser->fio, 'class' => 'table-avatar']);
        $tooltip = $this->createdUser->tooltip;
        return '<span style="float: left; margin-right: 0.5rem;">
                                        ' . Html::a(
                $img,
                ['/user/' . $this->createdUser->id],
                ['data-toggle' => 'tooltip', 'data-html' => 'true', 'data-original-title' => $tooltip]
            ) . '
                                    </span>
                                    ' . Html::a($this->createdUser->fio,
                ['/user/' . $this->createdUser->id],
                ['data-toggle' => 'tooltip', 'data-html' => 'true', 'data-original-title' => $tooltip]) . '
                                    <br><small>' . $this->createdUser->position . '</small>';
    }
}