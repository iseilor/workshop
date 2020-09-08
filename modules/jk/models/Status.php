<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jk_status".
 *
 * @property int         $id
 * @property int         $created_at
 * @property int         $created_by
 * @property int|null    $updated_at
 * @property int|null    $updated_by
 * @property int|null    $deleted_at
 * @property int|null    $deleted_by
 * @property string      $title
 * @property string      $title_long
 * @property int|null    $progress
 * @property string|null $color
 * @property string|null $description
 * @property int         $weight
 *
 */
class Status extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'icon', 'title_short', 'icon', 'code', 'color', 'description', 'progress','weight'], 'required'],
            [['progress','weight'], 'integer'],
            [['description', 'color', 'code', 'color', 'icon', 'title', 'title_short'], 'string'],
            [['description', 'color', 'code', 'color', 'icon', 'title', 'title_short'], 'string', 'max' => 255],
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
                'title' => Module::t('status', 'Title'),
                'title_short' => Module::t('status', 'Title Short'),
                'code' => Module::t('status', 'Code'),
                'progress' => Module::t('status', 'Progress'),
                'color' => Module::t('status', 'Color'),
                'icon' => Module::t('status', 'Icon'),
                'description' => Module::t('status', 'Description'),
                'weight' => Module::t('status', 'Weight'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return OrderStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusQuery(get_called_class());
    }


    /**
     * Получить плашку текущего статуса
     *
     * @return string
     */
    public function getStatusLabel()
    {
        return '<span class="badge bg-' . $this->color . '" title="' . $this->description . '">' . $this->title . '</span>';
    }

    // TODO: Все перенести из функции выше в эту функцию
    public function getLabel()
    {
        return '<span class="badge bg-' . $this->color . '" title="' . $this->description . '">' . $this->title . '</span>';
    }


    /**
     * Получить progressbar текущего статуса
     *
     * @return string
     */
    public function getProgressBar()
    {
        return '<div class="progress progress-sm" title="' . $this->description . '">
                    <div class="progress-bar bg-' . $this->color . '" role="progressbar" aria-volumenow="' . $this->progress
            . '" aria-volumemin="0" aria-volumemax="100" style="width: ' . $this->progress . '%"></div>
                </div>
                <small>' . $this->progress . '% выполнено</small>';
    }

    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }
}
