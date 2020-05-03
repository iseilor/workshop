<?php


use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_status}}`.
 */
class m200331_000006_create_jk_status_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions
                = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%jk_status}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'title' => $this->string()->notNull(),
                'title_short' => $this->string()->notNull(),
                'code'=> $this->string()->notNull(),
                'progress' => $this->integer()->notNull(),
                'color' => $this->string()->notNull(),
                'icon' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
            ],
            $tableOptions
        );

        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_status.sql'));

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_status}}');
    }
}