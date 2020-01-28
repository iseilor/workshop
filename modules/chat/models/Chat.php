<?php

namespace app\modules\chat\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $user_id
 * @property int|null $group_id
 * @property int|null $status_id
 * @property string $message
 */
class Chat extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'message'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'group_id', 'status_id'], 'integer'],
            [['message'], 'string'],
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
            'group_id' => Yii::t('app', 'Group ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ChatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChatQuery(get_called_class());
    }
}
