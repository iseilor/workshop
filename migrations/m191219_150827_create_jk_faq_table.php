<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_faq}}`.
 */
class m191219_150827_create_jk_faq_table extends Migration
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
        return "INSERT INTO {{%jk_faq}} (`id`,`created_at`,`created_by`,`question`,`answer`)
        VALUES (1,$now,1,'вопрос','ответ')";
    }
}
