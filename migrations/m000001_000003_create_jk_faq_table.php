<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_faq}}`.
 */
class m000001_000003_create_jk_faq_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%jk_faq}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
                'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_DATETIME,
                'updated_by' => Schema::TYPE_INTEGER,
                'deleted_at' => Schema::TYPE_DATETIME,
                'deleted_by' => Schema::TYPE_INTEGER,
                'question' => Schema::TYPE_STRING . ' NOT NULL',
                'answer' => Schema::TYPE_TEXT . ' NOT NULL',
            ]
        );
        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_faq}}');
    }

    public function addData()
    {
        $now = new Expression('NOW()');
        return "INSERT INTO {{%jk_faq}} (`created_at`,`created_by`,`question`,`answer`)
        VALUES 
        /*($now,1,'На каких основаниях мне дадут разрешение на улучшение жилищных условий?','...'),*/
        ($now,1,'Есть ли ограничения по стажу?','Стаж работы в Обществе и/или ДЗО, не менее 1 года (на дату подачи заявления об оказании помощи).'),
        ($now,1,'Есть ли требования к приобретаемому жилью?','Жилое помещение, приобретаемое с использованием помощи, должно находиться не более чем в 50 км от постоянного места работы работника. В отношении работников, не имеющих постоянного места работы, ЖК вправе принять индивидуальное решение.'),
        ($now,1,'Есть срок возврата займа по жилищной компании?','Максимальный срок возврата займа 10 лет.'),
        ($now,1,'Какая сумма компенсации процентов?','Максимальная сумма компенсации процентов, которую Общество может выплатить работнику – 1 000 000 руб.'),
        ($now,1,'Есть ли ограничения по возрасту?','Нет, но не позднее чем за 10 лет до достижения пенсионного возраста'),
        ($now,1,'Должен быть какой-то определенный банк?','Для получения кредита на улучшение жилищных условий работником может быть выбран любой банк.')
        /*($now,1,'Что такое жилищная программа и как её можно получить','Ссылка на положение о ЖП'),*/
        /*($now,1,'Какие документы мне понадобятся?','...')*/   
        ";
    }
}


