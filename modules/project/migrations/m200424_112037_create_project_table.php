<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m200424_112037_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull(),
            'img'=>$this->string(),
            'users'=>$this->string(),
            'status_id'=>$this->integer(),
            'progress'=>$this->integer(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/project.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}
