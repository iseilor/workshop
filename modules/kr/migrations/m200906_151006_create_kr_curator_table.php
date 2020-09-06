<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kr_curator}}`.
 */
class m200906_151006_create_kr_curator_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kr_curator}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'fio' => $this->string()->notNull(),
            'position'=>$this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'img' => $this->string()->notNull(),
            'weight' => $this->integer()->notNull(),
            'block_id' => $this->integer()->notNull(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/kr_curator.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kr_curator}}');
    }
}
