<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nsi_color}}`.
 */
class m200415_191112_create_nsi_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nsi_color}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'code'=>$this->string()->notNull(),
            'value'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/nsi_color.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nsi_color}}');
    }
}
