<?php

namespace app\modules\kr\models;

use app\models\Model;
use app\modules\kr\Module;
use kartik\icons\Icon;
use Yii;
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
            [['title', 'code', 'description', 'img', 'icon', 'color', 'weight'], 'required'],
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
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),
            'icon' => Yii::t('app', 'Icon'),
            'color' => Yii::t('app', 'Color'),
            'weight' => Yii::t('app', 'Weight'),
        ];
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
}
