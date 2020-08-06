<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jk_corp_norm".
 *
 * @property int          $id
 * @property int          $created_at
 * @property int          $created_by
 * @property int|null     $updated_at
 * @property int|null     $updated_by
 * @property int|null     $deleted_at
 * @property int|null     $deleted_by
 * @property int          $number
 * @property int          $area
 */
class CorpNorm extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_corp_norm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'area'], 'required'],
            [['number', 'area'], 'integer'],
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
                'created_at' => Yii::t('app', 'Created At'),
                'createdUserLink' => Module::t('agreement', 'Created By'),
                'created_by' => Yii::t('app', 'Created By'),
                'updated_at' => Yii::t('app', 'Updated At'),
                'updated_by' => Yii::t('app', 'Updated By'),
                'deleted_at' => Yii::t('app', 'Updated At'),
                'deleteed_by' => Yii::t('app', 'Updated By'),

                'number' => Module::t('module', 'Family Members'),
                'area' => Module::t('module', 'Housing Area'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return CorpNormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CorpNormQuery(get_called_class());
    }
}
