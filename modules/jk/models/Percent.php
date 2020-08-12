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
 * @property float $cost_total
 * @property float $cost_user
 * @property float $bank_credit
 * @property float|null $loan
 * @property float|null $percent_count
 * @property float|null $percent_rate
 * @property int|null $compensation_count
 * @property int|null $compensation_years
 */
class Percent extends Model
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
            [['date_birth', 'gender', 'experience', 'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'percent_count', 'percent_rate'], 'required'],
            [['created_at', 'updated_at', 'date_birth'], 'safe'],
            [
                [
                    'created_by',
                    'updated_by',
                    'gender',
                    'experience',
                    'family_count',
                    //'family_income',
                    'compensation_count',
                    'compensation_years',
                ],
                'integer',
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
                },
            ],

            // Кол-во приобритаемого жилья
            [['area_buy'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['area_buy', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['area_buy', 'compare', 'compareValue' => 1000, 'operator' => '<=', 'type' => 'number'],

            // Полная стоимость жилья
            [['cost_total'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['cost_total', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['cost_total', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],
            [
                ['cost_total', 'cost_user', 'bank_credit'],
                function () {
                    if (is_numeric($this->cost_total) && is_numeric($this->cost_user) && is_numeric($this->bank_credit)) {
                        $i =10;
                        if ($this->loan > 0) {
                            $k = $this->cost_total - $this->cost_user - $this->bank_credit - $this->loan;
                            if (abs($this->cost_total - $this->cost_user - $this->bank_credit - $this->loan) > 0.00001) {
                                $this->addError('cost_total', 'Полная стоимость жилья = Собственные средства работника + Размер кредита Банка + Размер займа (если предоставлялся)');
                                $this->addError('cost_user', '');
                                $this->addError('bank_credit', '');
                                $this->addError('loan', '');
                            }
                        } else {
                            if (abs($this->cost_total - $this->cost_user - $this->bank_credit) > 0.00001) {
                                $this->addError('cost_total', 'Полная стоимость жилья = Собственные средства работника + Размер кредита Банка + Размер займа (если предоставлялся)');
                                $this->addError('cost_user', '');
                                $this->addError('bank_credit', '');
                                $this->addError('loan', '');
                            }
                        }
                    }
                },
            ],

            // Собственные средства работника
            [['cost_user'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['cost_user', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            ['cost_user', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],

            // Размер кредита в банке
            [['bank_credit'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['bank_credit', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['bank_credit', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],

            // Займ
            [['loan'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['loan', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            ['loan', 'compare', 'compareValue' => 1000000, 'operator' => '<=', 'type' => 'number'],

            // Сумма процентов
            [['percent_count'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['percent_count', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['percent_count', 'compare', 'compareValue' => 10000000, 'operator' => '<=', 'type' => 'number'],
            [
                ['percent_count'],
                function () {
                    if ($this->percent_count != '' && $this->bank_credit != '' && $this->percent_count > $this->bank_credit) {
                        $this->addError('percent_count', 'Сумма компенсации процентов не может быть больше размера кредита в банке');
                    }
                },
            ],

            // Процентная ставка
            [['percent_rate'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['percent_rate', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            ['percent_rate', 'compare', 'compareValue' => 1000000, 'operator' => '<', 'type' => 'number'],

            [['family_income'],'filter',
                'filter' => function ($value) {
                    return str_replace(" ", "", $value);
                }
            ],
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

            'createdUserLabel'=>Module::t('module', 'Created User Label'),
        ];
    }

    // Вторая версия подписи
    public function getAttributeLabels2($attr)
    {
        return $this->attributeLabels()[$attr] . ' <a href="#" data-toggle="tooltip" data-html="true" title="' . $this->attributeTooltips()[$attr] . '"><i class="fas fa-info"></i></a>';
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
            'family_income' => 'Берется доход по справке о доходах и суммах налога физического лица за соответствующий год<br/>
                              по всем членам семьи и делится на 12 месяцев и кол-во членов семьи<br/>
                              (например: доход по справке 100 руб., НДФЛ 13 руб., 2 члена семьи,<br/>
                              среднемесячный доход = (100-13)/2/12 = 3,6 руб.)',
            'area_total' => 'Рассчитывается без учета приобретаемого жилья (с помощью Жилищной программы),<br>и с учетом жилых помещений, по которым в течение 5 лет до подачи заявления осуществлялись сделки ',
            'area_buy' => 'Поле должно быть не меньше 1',
            'cost_total' => 'Полная стоимость жилья = Собственные средства работника<br/> + Размер кредита Банка + Размер займа (если предоставлялся)',
            'cost_user' => 'Собственные средства работника',
            'bank_credit' => 'Данные вводятся без учёта требуемого займа',
            'loan' => 'Размер займа от компании, если он ранее предоставлялся',
            'percent_count' => 'По полю указывается сумма процентов (без учета основного долга)<br/>за текущий год согласно Графику платежей Ипотечного договора',
            'percent_rate' => 'Процентная ставка в банке',
        ];
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
            'loan' => 'Размер займа от компании, если он ранее предоставлялся',
            'percent_count' => 'Полная сумма по переплаченным процентам за кредит',
            'percent_rate' => 'Процентная ставка в банке',
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


    // Правим запятые на точки
    public function beforeValidate()
    {
        // Заменяем запятые на точки
        $this->percent_rate = str_replace(",", ".", $this->percent_rate);
        $this->area_total = str_replace(",", ".", $this->area_total);
        $this->area_buy = str_replace(",", ".", $this->area_buy);

        $this->cost_total = str_replace(",", ".", $this->cost_total);
        $this->cost_user = str_replace(",", ".", $this->cost_user);
        $this->bank_credit = str_replace(",", ".", $this->bank_credit);
        $this->loan = str_replace(",", ".", $this->loan);
        $this->percent_count = str_replace(",", ".", $this->percent_count);
        $this->percent_rate = str_replace(",", ".", $this->percent_rate);
        return parent::beforeValidate();
    }

    // Рассчитываем все ставки перед сохранением
    public function beforeSave($insert)
    {
        $i = 10;
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
        // Максимальный срок компенсации процентов (кол-во лет до пенсии, но не более 10 лет)
        $user = User::findOne(Yii::$app->user->identity->getId());
        $this->compensation_years = $user->getPensionYears();
        $SKP = 12;

        // Нормативы оказания помощи
        $standards = AidStandards::find()->all();

        foreach ($standards as $standard) {
            if ($this->family_income >= $standard->income_bottom && $this->family_income <= $standard->income_top) {

                if ($this->compensation_years > $standard->compensation_years_percent) {
                    $this->compensation_years = $standard->compensation_years_percent;
                }
                if ($this->compensation_years < 0) {
                    $this->compensation_years = 0;
                }

                // До 35 лет и после 35
                if ($user->getYears() <= 35) {
                    $SKP = $standard->skp_young;
                } else {
                    $SKP = $standard->skp;
                }
            }
        }

        //До введения справочника "Нормативы оказания помощи"
        /*if ($this->compensation_years > 10) {
            $this->compensation_years = 10;
        }
        if ($this->compensation_years < 0) {
            $this->compensation_years = 0;
        }

        $SKP = Module::getSKP($this->family_income); // Ставка компенсации процентов SKP*/
        $KNP = Module::getKNP($this->family_count); // Корпоративная норма площади жилья KNP

        // Если покупается больше нормы, то сотруднику возмещается только норма
        /*$areaBuy = $this->area_buy;
        if ($areaBuy > $KNP) {
            $areaBuy = $KNP;
        }*/

        $KUKN = $KNP / ($this->area_buy - ($this->cost_user / $this->cost_total * $this->area_buy)); // Коэффициент учёта корпоративной нормы KUKN

        if ($KUKN > 1) {
            $KUKN = 1;
        }

        // Итоговый коэффициент
        $itogKoef = $SKP / $this->percent_rate;
        if ($itogKoef > 1) {
            $itogKoef = 1;
        }

        $maxMoney = round($this->percent_count * $itogKoef * $KUKN, -3);

        // Не больше 1 млн.руб
        $this->compensation_count = min($maxMoney, $this->percent_count, 1000000);
        if ($this->compensation_count == 0) {
            $this->compensation_years = 0;
        }
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['percent_id' => 'id']);
    }
}
