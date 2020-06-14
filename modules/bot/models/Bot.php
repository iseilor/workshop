<?php

namespace app\modules\bot\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "bot".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $title_link
 * @property string $description
 * @property string $text
 * @property string|null $img
 * @property int|null $bot_id
 */
class Bot extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_link', 'description', 'text'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'bot_id'], 'integer'],
            [['description', 'text'], 'string'],
            [['title', 'title_link', 'img'], 'string', 'max' => 255],
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
            'title_link' => Yii::t('app', 'Title Link'),
            'description' => Yii::t('app', 'Description'),
            'text' => Yii::t('app', 'Text'),
            'img' => Yii::t('app', 'Img'),
            'bot_id' => Yii::t('app', 'Bot ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BotQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BotQuery(get_called_class());
    }
}
