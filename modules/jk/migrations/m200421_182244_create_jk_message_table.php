<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_message}}`.
 */
class m200421_182244_create_jk_message_table extends Migration
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

        $this->createTable('{{%jk_message}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer() . ' NOT NULL',
            'created_by' => $this->integer() . ' NOT NULL',
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'user_id' => $this->integer()->notNull(),       // Сотрудник
            'message' => $this->text()->notNull(),          // Сообщение
            'is_curator' => $this->boolean()->notNull()     // Куратор написал
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_message}}');
    }
}