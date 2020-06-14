<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bot}}`.
 */
class m200614_093237_create_bot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bot}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'title_link'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull(),
            'text'=>$this->text()->notNull(),
            'img'=>$this->string(),
            'bot_id'=>$this->integer()
        ]);
        //$this->execute(file_get_contents(__DIR__ . '/../sql/bot.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bot}}');
    }
}