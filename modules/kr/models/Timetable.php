<?php

namespace app\modules\kr\models;

use app\models\Model;
use app\modules\kr\Module;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;
use Da\QrCode\QrCode;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "kr_timetable".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string   $title
 * @property string   $date
 * @property string   $curator
 * @property string   $description
 * @property string   $img
 * @property string   $link
 * @property int      $weight
 */
class Timetable extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kr_timetable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'curator', 'weight', 'block_id'], 'required'],
            [['weight', 'block_id'], 'integer'],
            [['description', 'groups'], 'string'],
            [['title', 'date', 'curator', 'img', 'link'], 'string', 'max' => 255],
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
                'title' => Module::t('timetable', 'Title'),
                'date' => Module::t('timetable', 'Date'),
                'curator' => Module::t('timetable', 'Curator'),
                'description' => Module::t('timetable', 'Description'),
                'img' => Module::t('timetable', 'Img'),
                'link' => Module::t('timetable', 'Link'),
                'block_id' => Module::t('timetable', 'Block'),
                'groups' => Module::t('timetable', 'Groups'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return TimetableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TimetableQuery(get_called_class());
    }

    // Максимальный вес для сотрировки
    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }

    // Создание QR-кода
    public function createQR()
    {
        // Создаём директорию
        $dir = Yii::$app->params['module']['kr']['timetable']['path'] . $this->id . '/';
        FileHelper::createDirectory($dir, $mode = 0777, $recursive = true);

        // Создаём QR-коды
        if (isset($this->link) && $this->link != '') {
            $qrCode = (new QrCode($this->link))
                ->setSize(300)
                ->setMargin(5)
                ->useForegroundColor(84, 73, 158)
                ->useLogo(Yii::getAlias('@webroot') . "/logo/rt_logo_350.jpg")
                ->setErrorCorrectionLevel(ErrorCorrectionLevelInterface::HIGH)
                ->setLogoWidth(100);
            $qrCode->writeFile($dir  . 'link.png'); // writer defaults to PNG when none is specified
        }

    }
}