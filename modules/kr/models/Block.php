<?php

namespace app\modules\kr\models;

use app\models\Model;
use app\modules\kr\Module;
use kartik\icons\Icon;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "kr_block".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $subtitle
 * @property string $code
 * @property string $description
 * @property string $img
 * @property string $icon
 * @property string $color
 * @property int $weight
 */
class Block extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kr_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','subtitle', 'code', 'description', 'img', 'icon', 'color', 'weight'], 'required'],
            [['weight'], 'integer'],
            [['description'], 'string'],
            [['title', 'code', 'img', 'icon', 'color'], 'string', 'max' => 255],
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
                'title' => Module::t('block', 'Title'),
                'subtitle' => Module::t('block', 'Subtitle'),
                'badge' => Module::t('block', 'Title'),
                'code' => Module::t('block', 'Code'),
                'description' => Module::t('block', 'Description'),
                'img' => Module::t('block', 'Img'),
                'icon' => Module::t('block', 'Icon'),
                'color' => Module::t('block', 'Color'),
                'weight' => Module::t('block', 'Weight'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return BlockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlockQuery(get_called_class());
    }

    // Цветная плашка с иконкой
    public function getBadge(){
        return Html::tag('span',Icon::show($this->icon).$this->title,['class'=>'badge bg-'.$this->color]);
    }

    // Максимальный вес для сотрировки
    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }
}
