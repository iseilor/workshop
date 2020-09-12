<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%st_guest}}`.
 */
class m200912_211052_create_st_guest_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%st_guest}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'curator_id' =>  $this->integer()->notNull(),
            'guest_fio'=>$this->string()->notNull(),
            'guest_category'=>$this->integer()->notNull(),
            'guest_photo' => $this->string()->notNull(),
            'date'=>$this->integer()->notNull(),

            'title'=> $this->string()->notNull(),
            'annotation'=> $this->text()->notNull(),
            'text'=>$this->text()->notNull(),

            'registration_link'=>$this->string()->notNull(),
            'webinar_link'=>$this->string(),
            'youtube_link'=>$this->string(),
            'vk_link'=>$this->string(),
            'telegram_link'=>$this->string(),
            'video'=>$this->string(),

            'weight' => $this->integer()->notNull(),
            'icon' => $this->string()->notNull(),
            'color' => $this->string()->notNull(),
        ]);
        $this->execute(file_get_contents(__DIR__ . '/../sql/st_guest.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%st_guest}}');
    }
}
