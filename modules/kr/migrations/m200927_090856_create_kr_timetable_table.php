<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kr_timetable}}`.
 */
class m200927_090856_create_kr_timetable_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kr_timetable}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'title'=>$this->string()->notNull(),
            'date'=>$this->string()->notNull(),
            'curator'=>$this->string()->notNull(),
            'description'=>$this->text(),
            'img'=>$this->string(),
            'link'=>$this->string(),
            'qr'=>$this->string(),
            'block_id'=>$this->integer()->notNull(),
            'groups'=>$this->string(),
            'weight'=>$this->integer()->notNull()
        ]);

        $this->execute(file_get_contents(__DIR__ . '/../sql/kr_timetable.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kr_timetable}}');
    }
}