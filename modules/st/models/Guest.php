<?php

namespace app\modules\st\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "st_guest".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int $curator_id
 * @property string $guest_fio
 * @property int $guest_category
 * @property string $guest_photo
 * @property int $date
 * @property string $title
 * @property string $annotation
 * @property string $text
 * @property string $registration_link
 * @property string|null $webinar_link
 * @property string|null $youtube_link
 * @property string|null $vk_link
 * @property string|null $telegram_link
 * @property string|null $video
 * @property int $weight
 * @property string $icon
 * @property string $color
 */
class Guest extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'st_guest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curator_id', 'guest_fio', 'guest_category', 'guest_photo', 'date', 'title', 'annotation', 'text', 'registration_link', 'weight', 'icon', 'color'], 'required'],
            [['curator_id', 'guest_category', 'date', 'weight'], 'integer'],
            [['annotation', 'text'], 'string'],
            [['guest_fio', 'guest_photo', 'title', 'registration_link', 'webinar_link', 'youtube_link', 'vk_link', 'telegram_link', 'video', 'icon', 'color'], 'string', 'max' => 255],
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
            'curator_id' => Yii::t('app', 'Curator ID'),
            'guest_fio' => Yii::t('app', 'Guest Fio'),
            'guest_category' => Yii::t('app', 'Guest Category'),
            'guest_photo' => Yii::t('app', 'Guest Photo'),
            'date' => Yii::t('app', 'Date'),
            'title' => Yii::t('app', 'Title'),
            'annotation' => Yii::t('app', 'Annotation'),
            'text' => Yii::t('app', 'Text'),
            'registration_link' => Yii::t('app', 'Registration Link'),
            'webinar_link' => Yii::t('app', 'Webinar Link'),
            'youtube_link' => Yii::t('app', 'Youtube Link'),
            'vk_link' => Yii::t('app', 'Vk Link'),
            'telegram_link' => Yii::t('app', 'Telegram Link'),
            'video' => Yii::t('app', 'Video'),
            'weight' => Yii::t('app', 'Weight'),
            'icon' => Yii::t('app', 'Icon'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return GuestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GuestQuery(get_called_class());
    }
}
