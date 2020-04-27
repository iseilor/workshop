<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m200427_142002_create_chat_table extends Migration
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
            '{{%chat}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer() . ' NOT NULL',
                'created_by' => $this->integer() . ' NOT NULL',
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'user_id' => $this->integer(),
                'group_id' => $this->integer(),
                'status_id' => $this->integer(),
                'message' => $this->text() . ' NOT NULL',
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoce
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}