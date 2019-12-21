<?php

namespace app\modules\jk\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "jk_zaim".
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
 * @property int $rf_area
 * @property int|null $compensation_result
 * @property int|null $compensation_count
 * @property int|null $compensation_years
 */
class Zaim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_zaim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_birth', 'gender', 'experience', 'family_count', 'family_income',
                'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit','rf_area'], 'required'],
            [['created_at', 'updated_at', 'date_birth'], 'safe'],
            [['created_by', 'updated_by', 'gender', 'experience', 'family_count',
                'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'compensation_result', 'compensation_count', 'compensation_years','rf_area'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/jk', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'date_birth' => Yii::t('app/jk', 'Date Birth'),
            'gender' => Yii::t('app/jk', 'Gender'),
            'experience' => Yii::t('app/jk', 'Experience'),
            'family_count' => Yii::t('app/jk', 'Family Count'),
            'family_income' => Yii::t('app/jk', 'Family Income'),
            'area_total' => Yii::t('app/jk', 'Area Total'),
            'area_buy' => Yii::t('app/jk', 'Area Buy'),
            'cost_total' => Yii::t('app/jk', 'Cost Total'),
            'cost_user' => Yii::t('app/jk', 'Cost User'),
            'bank_credit' => Yii::t('app/jk', 'Bank Credit'),
            'rf_area' => Yii::t('app/jk', 'RF Area'),
            'compensation_result' => Yii::t('app/jk', 'Compensation Result'),
            'compensation_count' => Yii::t('app/jk', 'Compensation Count'),
            'compensation_years' => Yii::t('app/jk', 'Compensation Years'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ZaimQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZaimQuery(get_called_class());
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