<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kr_block}}`.
 */
class m200906_134935_create_kr_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kr_block}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'code'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull(),
            'img'=>$this->string()->notNull(),
            'icon'=>$this->string()->notNull(),
            'color'=>$this->string()->notNull(),
            'weight'=>$this->integer()->notNull(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/kr_block.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kr_block}}');
    }
}