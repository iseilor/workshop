<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;

/**
 * This is the model class for table "jk_stop".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $description
 * @property int $status_id
 */
class Stop extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_stop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status_id'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by','status_id'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
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

            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'status_id' => Module::t('stop', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StopQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StopQuery(get_called_class());
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}
