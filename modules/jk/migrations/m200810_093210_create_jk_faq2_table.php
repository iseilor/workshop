<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_faq2}}`.
 */
class m200810_093210_create_jk_faq2_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%jk_faq2}}',
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
        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_faq2.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_faq2}}');
    }
}
