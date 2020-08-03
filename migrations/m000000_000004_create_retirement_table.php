<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%retirement}}`.
 */
class m000000_000004_create_retirement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%retirement}}', [
            'id' => $this->primaryKey(),
            'age' => $this->integer()->notNull(),

            'gender' => $this->string()->notNull(),
        ],
        $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%retirement}}');
    }
}
