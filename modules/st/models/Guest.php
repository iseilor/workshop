<?php

namespace app\modules\st\models;

use app\models\Model;
use app\modules\st\Module;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;
use Da\QrCode\QrCode;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "st_guest".
 *
 * @property int         $id
 * @property int         $created_at
 * @property int         $created_by
 * @property int|null    $updated_at
 * @property int|null    $updated_by
 * @property int|null    $deleted_at
 * @property int|null    $deleted_by
 * @property int         $curator_id
 * @property string      $guest_fio
 * @property int         $guest_category
 * @property string      $guest_photo
 * @property ing         $birth_date
 * @property string      $birth_place
 * @property int         $date
 * @property string      $title
 * @property string      $annotation
 * @property string      $text
 * @property string      $registration_link
 * @property string|null $webinar_link
 * @property string|null $youtube_link
 * @property string|null $vk_link
 * @property string|null $telegram_link
 * @property string|null $video
 * @property int         $weight
 * @property string      $icon
 * @property string      $color
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

    public $guest_photo_form;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'curator_id',
                    'guest_fio',
                    'guest_category',
                    'guest_photo',
                    'date',
                    'title',
                    'annotation',
                    'text',
                    'weight',
                    'icon',
                    'color',
                    'birth_date',
                    'birth_place',
                ],
                'required',
            ],
            [['curator_id', 'guest_category', 'weight'], 'integer'],
            [['date'], 'date', 'format' => 'php:d.m.Y H:i', 'timestampAttribute' => 'date'],
            [['birth_date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'birth_date'],
            [['annotation', 'text'], 'string'],
            [
                [
                    'guest_fio',
                    'guest_photo',
                    'title',
                    'registration_link',
                    'webinar_link',
                    'youtube_link',
                    'vk_link',
                    'telegram_link',
                    'video',
                    'icon',
                    'color',
                ],
                'string',
                'max' => 255,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'curator_id' => Module::t('guest', 'Curator ID'),
                'guest_fio' => Module::t('guest', 'Guest Fio'),
                'guest_category' => Module::t('guest', 'Guest Category'),
                'guest_photo' => Module::t('guest', 'Guest Photo'),
                'guest_photo_form' => Module::t('guest', 'Guest Photo'),
                'date' => Module::t('guest', 'Date'),
                'birth_date' => Module::t('guest', 'Birth Date'),
                'birth_place' => Module::t('guest', 'Birth Place'),
                'title' => Module::t('guest', 'Title'),
                'annotation' => Module::t('guest', 'Annotation'),
                'text' => Module::t('guest', 'Text'),
                'registration_link' => Module::t('guest', 'Registration Link'),
                'webinar_link' => Module::t('guest', 'Webinar Link'),
                'youtube_link' => Module::t('guest', 'Youtube Link'),
                'vk_link' => Module::t('guest', 'Vk Link'),
                'telegram_link' => Module::t('guest', 'Telegram Link'),
                'video' => Module::t('guest', 'Video'),
                'weight' => Module::t('guest', 'Weight'),
                'icon' => Module::t('guest', 'Icon'),
                'color' => Module::t('guest', 'Color'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return GuestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GuestQuery(get_called_class());
    }

    // Максимальный вес для сотрировки
    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }

    // Категория гостя
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'guest_category']);
    }

    // Предварительное сохранение
    public function createQR()
    {
        // Создаём директорию
        $dir = Yii::$app->params['module']['st']['guest']['path']  . $this->id . '/';
        FileHelper::createDirectory($dir, $mode = 0777, $recursive = true);

        // Поля, которым нужны QR-коды
        $fields = [
            'registration_link',
            'webinar_link',
            'youtube_link',
            'vk_link',
            'telegram_link',
        ];

        // Создаём QR-коды
        foreach ($fields as $field) {
            if (isset($this->{$field}) && $this->{$field}!=''){
                $qrCode = (new QrCode($this->{$field}))
                    ->setSize(300)
                    ->setMargin(5)
                    ->useForegroundColor(84, 73, 158)
                    ->useLogo(Yii::getAlias('@webroot') . "/logo/rt_logo_350.jpg")
                    ->setErrorCorrectionLevel(ErrorCorrectionLevelInterface::HIGH)
                    ->setLogoWidth(100);
                $qrCode->writeFile($dir . $field.'.png'); // writer defaults to PNG when none is specified
            }
        }
    }
}