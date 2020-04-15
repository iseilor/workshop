<?php

namespace app\modules\nsi\models;

use app\models\Model;
use app\modules\nsi\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "nsi_color".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string   $title
 * @property string   $code
 * @property string   $value
 * @property string   $description
 */
class Color extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nsi_color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code', 'value', 'description'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['description'], 'string'],
            [['title', 'code', 'value'], 'string', 'max' => 255],
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
                'title' => Yii::t('app', 'Title'),
                'code' => Module::t('color', 'Code'),
                'value' => Module::t('color', 'Value'),
                'description' => Yii::t('app', 'Description'),
            ]
        );

    }

    /**
     * {@inheritdoc}
     * @return ColorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ColorQuery(get_called_class());
    }
}
