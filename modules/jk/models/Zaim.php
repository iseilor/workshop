<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\User;
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
 * @property int $min_id
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
            [
                ['date_birth', 'gender', 'experience', 'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'min_id'],
                'required'
            ],
            [['created_at', 'updated_at', 'date_birth'], 'safe'],
            [
                [
                    'created_by',
                    'updated_by',
                    'gender',
                    'experience',
                    'family_count',
                    'family_income',
                    'compensation_count',
                    'compensation_years'
                ],
                'integer'
            ],


            // Кол-во членов в семье
            ['family_count', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            ['family_count', 'compare', 'compareValue' => 10, 'operator' => '<=', 'type' => 'number'],

            // Доход на одного члена семьи
            ['family_income', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            ['family_income', 'compare', 'compareValue' => 1000000, 'operator' => '<=', 'type' => 'number'],

            // Кол-во имеющегося жилья
            [['area_total'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['area_total', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            ['area_total', 'compare', 'compareValue' => 1000, 'operator' => '<=', 'type' => 'number'],
            [
                ['area_total', 'family_count'],
                function () {
                    if ($this->area_total && $this->family_count) {
                        $KNP = Module::getKNP($this->family_count);
                        if ($this->area_total > $KNP) {
                            $this->addError('area_total', "Площадь уже имеющегося у вас жилья превышает корпоративную норму, в вашем случае она состоявляет не более $KNP м2");
                        }
                    }
                }
            ],

            // Кол-во приобритаемого жилья
            [['area_buy'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['area_buy', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['area_buy', 'compare', 'compareValue' => 500, 'operator' => '<=', 'type' => 'number'],

            // Полная стоимость жилья
            [['cost_total'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['cost_total', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['cost_total', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],
            [
                ['cost_total', 'cost_user', 'bank_credit'],
                function () {
                    if (!isset($this->bank_credit) || $this->bank_credit==''){
                        $this->bank_credit= 0;
                    }
                    if ($this->cost_total - $this->cost_user - $this->bank_credit>1000000) {
                        $this->addError('cost_total', 'Полная стоимость жилья должна = собственные средства + ипотека + займ (который вам может выдать компания, но не более 1 млн.руб)');
                    }
                    if ($this->cost_total < $this->cost_user + $this->bank_credit) {
                        $this->addError('cost_total', 'Полная стоимость жилья не может быть меньше суммы собственных средств и ипотеки в банке');
                    }
                }
            ],

            // Собственные средства работника
            [['cost_user'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['cost_user', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            ['cost_user', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],

            // Размер кредита в банке
            [['bank_credit'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['bank_credit', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            ['bank_credit', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],
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
            'compensation_count' => Module::t('module', 'Compensation Count'),
            'compensation_years' => Module::t('module', 'Compensation Years'),
        ];
    }

    // Описание поля + картинка
    public function attributeDescription($img = '')
    {
        return [
            'family_count' => 'К членам семьи Работника для целей настоящего Положения относятся следующие лица:<br>
                               - супруг (супруга);<br/>
                               - несовершеннолетние дети Работника, проживающие с Работником;<br/>
                               - несовершеннолетние дети супруга/и Работника, проживающие с Работником;<br/>
                               - дети Работника старше 18 лет, ставшие инвалидами до достижения ими возраста 18 лет;<br/>
                               - дети Работника в возрасте до 23 лет, обучающиеся в образовательных учреждениях по очной форме обучения.',
            'family_income0' => 'Порядок расчета среднемесячного дохода на одного члена семьи за последние 12 месяцев рассчитывается следующим образом:<br>
                                <img src="' . $img . '" style="opacity: 0.5;"><br/>где:<br/>
                                - <strong>СД</strong> - среднемесячный доход на одного члена семьи за последние 12 месяцев;<br>
                                - <strong>СДС</strong> - суммарный доход семьи за вычетом налоговых удержаний за последние 12 месяцев без учета районного коэффициента и северной надбавки;<br>
                                - <strong>КЧС</strong> - количество членов семьи работника на дату подачи заявления об оказании помощи, включая работника.</br>',
            'family_income'=>'Берется доход по справке о доходах и суммах налога физического лица за соответствующий год<br/>
                              по всем членам семьи и делится на 12 месяцев и кол-во членов семьи<br/>
                              (например: доход по справке 100 руб., НДФЛ 13 руб., 2 члена семьи,<br/>
                              среднемесячный доход = (100-13)/2/12 = 3,6 руб.)',
            'area_total' => 'Рассчитывается без учета приобретаемого жилья (с помощью Жилищной программы),<br>и с учетом жилых помещений, по которым в течение 5 лет до подачи заявления осуществлялись сделки ',
            'area_buy' => 'Поле должно быть не меньше 1',
            'cost_total' => 'Полная стоимость жилья = Собственные средства работника + Размер кредита Банка + Размер займа (если предоставлялся)',
            'cost_user' => 'Собственные средства работника',
            'bank_credit' => 'Данные вводятся без учёта требуемого займа',
            'min_id' => Module::t('module', 'RF Area'),
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

    public function getMin()
    {
        return $this->hasOne(Min::className(), ['id' => 'min_id']);
    }

    // Правим запятые на точки
    public function beforeValidate()
    {
        // Заменяем запятые на точки
        $this->area_total = str_replace(",", ".", $this->area_total);
        $this->area_buy = str_replace(",", ".", $this->area_buy);

        $this->cost_total = str_replace(",", ".", $this->cost_total);
        $this->cost_user = str_replace(",", ".", $this->cost_user);
        $this->bank_credit = str_replace(",", ".", $this->bank_credit);
        return parent::beforeValidate();
    }

    // Рассчитываем все ставки перед сохранением
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->calc();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Основаня функация расчёта суммы и срока компенсации процентов
     */
    public function calc()
    {
        // Текущий пользователь
        $user = User::findOne(Yii::$app->user->identity->getId());

        // Прожиточный минимум в регионе покупки жилья
        $min = Min::findOne($this->min_id);

        // Максимальный срок займа
        $this->compensation_years = 10;
        if ($this->family_income > 35000) {
            $this->compensation_years = 7;
        } else {
            if ($this->family_income > 25000) {
                $this->compensation_years = 8;
            } else {
                if ($this->family_income > 15000) {
                    $this->compensation_years = 10;
                } else {
                    $this->compensation_years = 10;
                }
            }
        }

        // Если лет до пенсии меньше, чем максимальный срок займа, то срок займа сокращаем до срока пенсии
        $pensionYears = $user->getPensionYears();
        if ($pensionYears < $this->compensation_years) {
            $this->compensation_years = $pensionYears;
        }

        // Максимальный размер займа (Вариант 1, ск-ко они могут откладывать ежемесячно)
        $maxMoney1 = ($this->family_income - $min->min) * $this->family_count * $this->compensation_years * 12;
        if ($maxMoney1<0){
            $maxMoney1 = 0; // Значит он указал доход на семью ниже прожиточного минимума, займ ему не положен
            $this->compensation_years = 0;
        }

        // Вариант 2 -------------------------------------------------------------------------------------------------
        $KNP = Module::getKNP($this->family_count); // Корпоративная норма площади жилья KNP
        // Коэффициент
        $koef = $KNP / ($this->area_buy - $this->cost_user * $this->area_buy / $this->cost_total);
        $koef = min($koef, 1);
        // Максимальный размер займа (Вариант 2)
        $maxMoney2 = $koef * ($this->cost_total - $this->cost_user - $this->bank_credit);

        // Вариант 3 -------------------------------------------------------------------------------------------------
        // Потребность
        $need = $this->cost_total-$this->cost_user-$this->bank_credit;
        // Превышение корпоративной нормы
        $pkn = $this->area_buy-$KNP;
        // Площадь оплачиваемая работником за счёт собственных средств
        $porsss = ($this->cost_user+$this->bank_credit)/$this->cost_total*$this->area_buy;
        // Коэффициент учёта корпоративной нормы
        $kukn = $KNP/($this->area_buy-$porsss);
        if ($kukn>1){
            $kukn = 1;
        }

        // Максимальный размер займа
        $mrz = $kukn*$this->cost_total;
        $maxMoney3 = min($mrz, $need, 1000000);
        $maxMoney3 = round($maxMoney3,-3);


        // Выбираем минимальное значение или 1 млн рублей
        $this->compensation_count = min($maxMoney1, $maxMoney3, 1000000);
    }

}