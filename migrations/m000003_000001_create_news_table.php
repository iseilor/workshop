<?php

use yii\db\Migration;
use yii\db\mssql\Schema;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m000003_000001_create_news_table extends Migration
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

        $this->createTable(
            '{{%news}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'title' => $this->string()->notNull(),
                'img' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'annotation' => $this->text()->notNull(),
                'text' => $this->text()->notNull()
            ],
            $tableOptions
        );

        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%news}} (`created_at`,`created_by`,`title`,`img`,`description`,`annotation`,`text`)
        VALUES
        ($now,1,
        'Корпоративная жилищная программа',
        '1_thumb_20200225184914.jpg',
        'В Ростелеком продолжает действовать жилищная программа для поддержки сотрудников компании! За 3 года ей воспользовались более 4 тыс. человек.',
        '<p>В «Ростелеком» продолжает действовать жилищная программа для поддержки
сотрудников компании! За 3 года ей воспользовались более 4 тыс. человек. Выбор участников
жилищной программы 2020 года на жилищных комиссиях региональных/макрорегиональных филиалов запланирован на март 2020 года.
Сотрудники филиала ОЦО могут получить помощь только в виде компенсации процентов, уплаченных ими банку в 2019 году по кредиту на улучшение жилищных условий.',
        '<p>В Ростелекоме продолжает действовать жилищная программа для поддержки сотрудников компании! За 3 года ей воспользовались более 4 тыс. человек.</p>
<p><strong>Ростелеком оказывает помощь сотрудникам в приобретении постоянного жилья в виде:</strong></p>
<ul>
<li>компенсации процентов по ипотечному кредиту;</li>
<li>беспроцентного займа (при действующей ипотеке предусмотрена только компенсация ипотечных процентов. </li>
</ul>
<p>Сотрудники филиала ОЦО могут получить помощь только в виде компенсации процентов, уплаченных ими банку в 2019 году по кредиту на улучшение жилищных условий.</p>
<p><strong>Когда подавать заявку</strong></p>
<p>С 15 января по 28 февраля 2020 года</p>
<p><strong>Что нужно для участия</strong></p>
<p>Заявление и пакет документов, предусмотренные в <a href=\"https://w3c.portal.rt.ru/files/app#/file/da4196e1-51d8-4ccd-9a0a-2c4b88c4b514\" target=\"_blank\">Положении об оказании помощи сотрудникам в приобретении постоянного жилья</a>. cтаж работы сотрудника – не менее 1 года.</p>
<p><strong>Кто поможет</strong></p>
<p>Образцы документов и помощь в их заполнении можно получить у <a href=\"https://w3c.portal.rt.ru/files/app#/file/d68eb5f7-ec01-49ef-9405-cdac2fffaa4d\" target=\"_blank\">ответственных за жилищную программу</a> в вашем филиале.</p>
<p>Выбор участников жилищной программы 2019 года на жилищных комиссиях региональных/макрорегиональных филиалов запланирован на март 2019 года.</p>')";
    }

}
