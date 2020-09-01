<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m200901_222008_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull(),
            'img'=>$this->string()->notNull(),
            'video'=>$this->string()->notNull(),
            'module_id'=>$this->string()->notNull(),
            'category_id'=>$this->string()->notNull(),

            'view'=>$this->integer(),
            'like'=>$this->integer(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/video.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
