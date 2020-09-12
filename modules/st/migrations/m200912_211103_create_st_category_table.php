<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%st_category}}`.
 */
class m200912_211103_create_st_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%st_category}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title' => $this->string()->notNull(),
            'description'=>$this->text()->notNull(),
            'weight' => $this->integer()->notNull(),
            'icon' => $this->string()->notNull(),
            'color' => $this->string()->notNull(),
            'img' => $this->string()->notNull()
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/st_category.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%st_category}}');
    }
}