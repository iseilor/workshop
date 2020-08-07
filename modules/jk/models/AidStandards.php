<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jk_aid_standards".
 *
 * @property int          $id
 * @property int          $created_at
 * @property int          $created_by
 * @property int|null     $updated_at
 * @property int|null     $updated_by
 * @property int|null     $deleted_at
 * @property int|null     $deleted_by
 * @property double       $income_bottom
 * @property double       $income_top
 * @property int          $compensation_years_zaim
 * @property double       $skp
 * @property double       $skp_young
 * @property int          $compensation_years_percent
 */
class AidStandards extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_aid_standards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['income_bottom', 'income_top', 'compensation_years_zaim', 'skp', 'skp_young', 'compensation_years_percent'], 'required'],

            [['income_bottom'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['income_bottom', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'integer'],
            ['income_bottom', 'compare', 'compareValue' => 1000000, 'operator' => '<=', 'type' => 'integer'],

            [['income_top'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['income_top', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'integer'],
            ['income_top', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'integer'],

            [['skp'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['skp', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'integer'],
            ['skp', 'compare', 'compareValue' => 100, 'operator' => '<=', 'type' => 'integer'],

            [['skp_young'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['skp_young', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'integer'],
            ['skp_young', 'compare', 'compareValue' => 100, 'operator' => '<=', 'type' => 'integer'],
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
                'created_by' => Yii::t('app', 'Created By'),
                'updated_at' => Yii::t('app', 'Updated At'),
                'updated_by' => Yii::t('app', 'Updated By'),
                'deleted_at' => Yii::t('app', 'Updated At'),
                'deleteed_by' => Yii::t('app', 'Updated By'),

                'income_bottom' => Module::t('module', 'Bottom Bound'),
                'income_top' => Module::t('module', 'Top Bound'),
                'compensation_years_zaim' => Module::t('module', 'Zaim Years'),
                'skp' => Module::t('module', 'Skp'),
                'skp_young' => Module::t('module', 'Skp Less 35'),
                'compensation_years_percent' => Module::t('module', 'Pervent Years'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return AidStandardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AidStandardsQuery(get_called_class());
    }
}
