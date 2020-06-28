<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_task}}`.
 */
class m200625_135722_create_project_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_task}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'comment'=>$this->text()->notNull(),
            'user_id'=>$this->integer(),
            'project_id'=>$this->integer(),
            'img'=>$this->string(),
            'status_id'=>$this->integer()->notNull(),
            'progress'=>$this->integer(),
            'rfc'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_task}}');
    }
}
