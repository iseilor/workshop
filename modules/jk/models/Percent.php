<?php

namespace app\modules\jk\models;

use app\modules\jk\Module;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "jk_percent".
 *
 * @property int $id
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string $date_birth
 * @property int $gender
 * @property int $experience
 * @property int $family_count
 * @property int $family_income
 * @property int $area_total
 * @property int $area_buy
 * @property int $cost_total
 * @property int $cost_user
 * @property int $bank_credit
 * @property int|null $loan
 * @property int|null $percent_count
 * @property float|null $percent_rate
 * @property int|null $compensation_result
 * @property int|null $compensation_count
 * @property int|null $compensation_years
 */
class Percent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_percent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_birth', 'gender', 'experience',  'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'percent_count', 'percent_rate'], 'required'],
            [['created_at', 'updated_at', 'date_birth'], 'safe'],
            [['created_by', 'updated_by', 'gender', 'experience', 'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'loan', 'percent_count', 'compensation_result', 'compensation_count', 'compensation_years'], 'integer'],
            [['percent_rate'],'double'],

            // Стаж в компании
            ['experience', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['experience', 'compare', 'compareValue' => 50, 'operator' => '<=', 'type' => 'number'],

            // Кол-во членов в семье
            ['family_count', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['family_count', 'compare', 'compareValue' => 10, 'operator' => '<=', 'type' => 'number'],

            // Прожиточный минимум в сеьме
            ['family_income', 'compare', 'compareValue' => 5000, 'operator' => '>=', 'type' => 'number'],
            ['family_income', 'compare', 'compareValue' => 50000, 'operator' => '<=', 'type' => 'number'],


            // Сумма процентов
            ['percent_count', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],

            // Процентная ставка
            ['percent_rate', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'double'],
            ['percent_rate', 'compare', 'compareValue' => 100, 'operator' => '<=', 'type' => 'double'],
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
            'date_birth' => Module::t('module', 'Date Birth'),
            'gender' => Module::t('module', 'Gender'),
            'experience' => Module::t('module', 'Experience'),
            'family_count' => Module::t('module', 'Family Count'),
            'family_income' => Module::t('module', 'Family Income'),
            'area_total' => Module::t('module', 'Area Total'),
            'area_buy' => Module::t('module', 'Area Buy'),
            'cost_total' => Module::t('module', 'Cost Total'),
            'cost_user' => Module::t('module', 'Cost User'),
            'bank_credit' => Module::t('module', 'Bank Credit'),
            'loan' => Module::t('module', 'Loan'),
            'percent_count' => Module::t('module', 'Percent Count'),
            'percent_rate' => Module::t('module', 'Percent Rate'),
            'compensation_result' => Module::t('module', 'Compensation Result'),
            'compensation_count' => Module::t('module', 'Compensation Count'),
            'compensation_years' => Module::t('module', 'Compensation Years'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PercentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PercentQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return new Expression('NOW()');
                },
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
