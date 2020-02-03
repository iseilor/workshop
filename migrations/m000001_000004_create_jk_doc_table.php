<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_doc}}`.
 */
class m000001_000004_create_jk_doc_table extends Migration
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
            '{{%jk_doc}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER,
                'updated_by' => Schema::TYPE_INTEGER,
                'deleted_at' => Schema::TYPE_INTEGER,
                'deleted_by' => Schema::TYPE_INTEGER,
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'description' => Schema::TYPE_STRING . ' NOT NULL',
                'src' => Schema::TYPE_STRING
            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_doc}} (`created_at`,`created_by`,`title`,`description`,`src`)
        VALUES 
        ($now,1,'Согласие на обработку ПД','Согласие на обработку ПД','1.docx'),
        ($now,1,'Начало заявочной компании 2019 года','Начало заявочной компании 2019','2.docx'),
        ($now,1,'Шаблон письменного отчета (стройка дома)','Шаблон письменного отчета (стройка дома)','3.xlsx'),
        ($now,1,'Согласие на обработку ПД (дети)','Согласие на обработку ПД (дети)','4.docx'),
        ($now,1,'Заявление на оказание помощи (пример по займу)','Заявление на оказание помощи (пример по займу)','5.docx'),
        ($now,1,'Важная информация о Заявочной компании','Важная информация о Заявочной компании','6.docx'),
        ($now,1,'Заявление на оказание помощи (пример по стройке дома)','Заявление на оказание помощи (пример по стройке дома)','7.docx'),
        ($now,1,'Заявление на оказание помощи (пример по компенсации %)','Заявление на оказание помощи (пример по компенсации %)','8.docx'),
        ($now,1,'Положение РТ помощь пост жилье (Редакция 1 с сущ изм 4)','Положение РТ помощь пост жилье (Редакция 1 с сущ изм 4)','9.docx'),
        ($now,1,'Начало Заявочной кампании 2020','Начало Заявочной кампании 2020','10.docx')
        ";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_doc}}');
    }
}
