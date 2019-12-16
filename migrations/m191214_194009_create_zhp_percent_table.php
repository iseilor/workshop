<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%zhp_percent}}`.
 */
class m191214_194009_create_zhp_percent_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions
                = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%zhp_percent}}', [
            'id' => Schema::TYPE_PK,

            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL Comment "Created_at"',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL Comment "Created_by"',
            'updated_at' => Schema::TYPE_DATETIME . ' Comment "Updated_at"',
            'updated_by' => Schema::TYPE_INTEGER . ' Comment "Updated_by"',

            'date_birth' => Schema::TYPE_DATE . ' NOT NULL Comment "Дата рождения"',
            'gender' => Schema::TYPE_CHAR . ' NOT NULL Comment "Пол"',
            'experience' => Schema::TYPE_INTEGER . ' NOT NULL Comment "Стаж работы в Ростелеком"',
            'year'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Год оказания помощи"',
            'date_pension'=> Schema::TYPE_DATE . ' Comment "Дата выхода на досрочную пенсию"',

            'family_count'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Количество членов семьи"',
            'family_income'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Среднемесячный доход на одного члена семьи, руб"',

            'area_total'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Общая площадь имеющегося жилья, м2"',
            'area_buy'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Общая площадь приобретаемого жилья, м2"',

            'cost_total'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Полная стоимость жилья, руб"',
            'cost_user' => Schema::TYPE_INTEGER . ' NOT NULL Comment "Собственные средства работника, руб"',
            'bank_credit' => Schema::TYPE_INTEGER . ' NOT NULL Comment "Размер кредита Банка, руб "',
            'loan'=> Schema::TYPE_INTEGER . ' Comment "Размер займа , руб"',

            'percent_count' => Schema::TYPE_INTEGER . ' NOT NULL Comment "Сумма процентов, руб"',
            'percent_rate' => Schema::TYPE_INTEGER . ' NOT NULL Comment "%-ая ставка"',

            'compensation_count'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Максимальный размер компенсации процентов в год"',
            'compensation_years'=> Schema::TYPE_INTEGER . ' NOT NULL Comment "Максимальный срок компенсации процентов (лет)"'

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%zhp_percent}}');
    }
}
