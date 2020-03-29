<?php

namespace app\modules\pulsar\models;

use app\models\Model;
use app\modules\pulsar\Module;
use Yii;

/**
 * This is the model class for table "pulsar".
 *
 * @property int         $id
 * @property int         $created_at
 * @property int         $created_by
 * @property int|null    $updated_at
 * @property int|null    $updated_by
 * @property int|null    $deleted_at
 * @property int|null    $deleted_by
 * @property int         $health_value
 * @property int         $mood_value
 * @property int         $job_value
 * @property string|null $health_comment
 * @property string|null $mood_comment
 * @property string|null $job_comment
 */
class Pulsar extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pulsar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['health_value', 'mood_value', 'job_value'], 'required'],
            [
                [
                    'created_at',
                    'created_by',
                    'updated_at',
                    'updated_by',
                    'deleted_at',
                    'deleted_by',
                    'health_value',
                    'mood_value',
                    'job_value',
                ],
                'integer',
            ],
            [['health_comment', 'mood_comment', 'job_comment'], 'string', 'max' => 255],
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
            'health_value' => Module::t('module', 'Health'),
            'mood_value' => Module::t('module', 'Mood'),
            'job_value' => Module::t('module', 'Job'),
            'health_comment' => Module::t('module', 'Health Comment'),
            'mood_comment' => Module::t('module', 'Mood Comment'),
            'job_comment' => Module::t('module', 'Job Comment'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PulsarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PulsarQuery(get_called_class());
    }
}
