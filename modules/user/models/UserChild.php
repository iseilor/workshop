<?php

namespace app\modules\user\models;

use app\modules\user\Module;
use Yii;

/**
 * This is the model class for table "user_child".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int $user_id
 * @property int $number
 * @property string $fio
 * @property int $date
 */
class UserChild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'user_id', 'number', 'fio', 'date'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'number', 'date'], 'integer'],
            [['fio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'user_id' => Yii::t('app', 'User ID'),
            'number' => Yii::t('app', 'Number'),
            'fio' => Module::t('module', 'Fio'),
            'date' => Module::t('module', 'Date'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserChildQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserChildQuery(get_called_class());
    }
}
