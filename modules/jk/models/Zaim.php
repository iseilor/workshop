<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
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
class Zaim extends Model
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
                'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit','min_id'], 'required'],
            [['created_at', 'updated_at', 'date_birth'], 'safe'],
            [['created_by', 'updated_by', 'gender', 'experience', 'family_count',
                'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'compensation_result', 'compensation_count', 'compensation_years','min_id'], 'integer'],
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
            'deleted_at' => Yii::t('app', 'Updated At'),
            'deleteed_by' => Yii::t('app', 'Updated By'),
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
            'min_id' => Module::t('module', 'RF Area'),
            'compensation_result' => Module::t('module', 'Compensation Result'),
            'compensation_count' => Module::t('module', 'Compensation Count'),
            'compensation_years' => Module::t('module', 'Compensation Years'),
        ];
    }

    // Вторая версия подписи
    public function getAttributeLabels2($attr)
    {
        return $this->attributeLabels()[$attr] . ' <a href="#" data-toggle="tooltip" data-html="true" title="' . $this->attributeTooltips()[$attr] . '"><i class="fas fa-info"></i></a>';
    }

    public function attributeTooltips()
    {
        return [
            'family_count' => '- Поле должно быть не меньше 1, поле заполняется целыми значениями: 1, 2, 3 и т.д.<br>
                               - К членам семьи работника относятся следующие лица:<br>
                               &nbsp;&nbsp;&nbsp; - супруг (супруга);<br>
                               &nbsp;&nbsp;&nbsp; - несовершеннолетние дети;<br>
                               &nbsp;&nbsp;&nbsp; - дети старше 18 лет, ставшие инвалидами до достижения ими возраста 18 лет;<br>
                               &nbsp;&nbsp;&nbsp; - дети в возрасте до 23 лет, обучающиеся в образовательных учреждениях по очной форме обучения',
            'family_income' => 'Порядок расчета среднемесячного дохода на одного члена семьи за последние 12 месяцев рассчитывается следующим образом:<br>
                                где:<br>
                                &nbsp;&nbsp;&nbsp; - СД - среднемесячный доход на одного члена семьи за последние 12 месяцев;<br>
                                &nbsp;&nbsp;&nbsp; - СДС - суммарный доход семьи за вычетом налоговых удержаний за последние 12 месяцев без учета районного коэффициента и северной надбавки;<br>
                                &nbsp;&nbsp;&nbsp; - КЧС - количество членов семьи работника на дату подачи заявления об оказании помощи, включая работника.</br>',
            'area_total' => 'Рассчитывается без учета приобретаемого жилья (с помощью Жилищной программы),<br>
                            и с учетом жилых / не жилых помещений, по которым в течение 5 лет до подачи<br>
                            заявления осуществлялись сделки ',
            'area_buy' => 'Поле должно быть не меньше 1',
            'cost_total' => 'Полная стоимость жилья = Собственные средства работника + Размер кредита Банка + Размер займа (если предоставлялся)',
            'cost_user' => 'Собственные средства работника',
            'bank_credit' => 'Данные вводятся без учёта требуемого займа',
            'min_id' => Module::t('module', 'RF Area'),
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
                //'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function getMin(){
        return $this->hasOne(Min::className(), ['id' => 'min_id']);
    }




}
