<?php

use yii\db\Migration;
use yii\db\mssql\Schema;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m000002_000001_create_chat_table extends Migration
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
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER,
                'updated_by' => Schema::TYPE_INTEGER,
                'deleted_at' => Schema::TYPE_INTEGER,
                'deleted_by' => Schema::TYPE_INTEGER,

                'user_id'=> Schema::TYPE_INTEGER,
                'group_id'=> Schema::TYPE_INTEGER,
                'status_id'=> Schema::TYPE_INTEGER,
                'message'=>Schema::TYPE_TEXT . ' NOT NULL'
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}
