<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_faq}}`.
 */
class m200331_000002_create_jk_faq_table extends Migration
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

                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'question' => $this->string()->notNull(),
                'answer' => $this->text()->notNull(),
                'faq_id' => $this->integer(),
                'weight' => $this->integer()->notNull(),
            ]
        );
        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_faq.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_faq}}');
    }

}


