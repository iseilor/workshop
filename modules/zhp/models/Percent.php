<?php

namespace app\modules\zhp\models;

use Yii;

/**
 * This is the model class for table "zhp_percent".
 *
 * @property int $id
 * @property int|null $created_at Дата создания
 * @property int|null $created_by Кто создал
 * @property int|null $updated_at Дата изменения
 * @property int|null $updated_by Кто изменил
 * @property string $date_birth Дата рождения
 * @property string $gender Пол
 * @property int $experience Стаж работы в Ростелеком
 * @property int $year Год оказания помощи
 * @property string|null $date_pension Дата выхода на досрочную пенсию
 * @property int $family_count Количество членов семьи
 * @property int $family_income Среднемесячный доход на одного члена семьи, руб
 * @property int $area_total Общая площадь имеющегося жилья, м2
 * @property int $area_buy Общая площадь приобретаемого жилья, м2
 * @property int $cost_total Полная стоимость жилья, руб
 * @property int $cost_user Собственные средства работника, руб
 * @property int $bank_credit Размер кредита Банка, руб 
 * @property int $loan Размер займа , руб
 * @property int $percent_count Сумма процентов, руб
 * @property int $percent_rate %-ая ставка
 * @property int|null $compensation_count Максимальный размер компенсации процентов в год
 * @property int|null $compensation_years Максимальный срок компенсации процентов (лет)
 */
class Percent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zhp_percent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'experience', 'year', 'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'loan', 'percent_count', 'percent_rate', 'compensation_count', 'compensation_years'], 'integer'],
            [['date_birth', 'gender', 'experience', 'year', 'family_count', 'family_income', 'area_total', 'area_buy', 'cost_total', 'cost_user', 'bank_credit', 'loan', 'percent_count', 'percent_rate'], 'required'],
            [['date_birth', 'date_pension'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'created_by' => 'Кто создал',
            'updated_at' => 'Дата изменения',
            'updated_by' => 'Кто изменил',
            'date_birth' => 'Дата рождения',
            'gender' => 'Пол',
            'experience' => 'Стаж работы в Ростелеком',
            'year' => 'Год оказания помощи',
            'date_pension' => 'Дата выхода на досрочную пенсию',
            'family_count' => 'Количество членов семьи',
            'family_income' => 'Среднемесячный доход на одного члена семьи, руб',
            'area_total' => 'Общая площадь имеющегося жилья, м2',
            'area_buy' => 'Общая площадь приобретаемого жилья, м2',
            'cost_total' => 'Полная стоимость жилья, руб',
            'cost_user' => 'Собственные средства работника, руб',
            'bank_credit' => 'Размер кредита Банка, руб ',
            'loan' => 'Размер займа , руб',
            'percent_count' => 'Сумма процентов, руб',
            'percent_rate' => '%-ая ставка',
            'compensation_count' => 'Максимальный размер компенсации процентов в год',
            'compensation_years' => 'Максимальный срок компенсации процентов (лет)',
        ];
    }
}
