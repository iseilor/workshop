<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m000000_000001_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx-user-username', '{{%user}}', 'username');
        $this->createIndex('idx-user-email', '{{%user}}', 'email');
        $this->createIndex('idx-user-status', '{{%user}}', 'status');

        //$this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    public function addData()
    {
        return "INSERT INTO {{%user}} (`id`,`username`,`auth_key`,`password_hash`,`email`,`status`,`created_at`,`updated_at`)
        VALUES (1,'admin', 'KhzwCjkdPWSW020jZfNU2FsQdJ03Ayai', '$2y$13$0m8vVgx3tqSJR1dmAZctU.feEXOerAG73vZA9BubTYQlo3BoUvEZi', 'admin@gmail.com',	10,	1576662481,	1576662481)";
    }
}