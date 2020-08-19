<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_doc}}`.
 */
class m200331_000003_create_jk_doc_table extends Migration
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
            '{{%jk_doc}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'title' => $this->string()->notNull(),                          // Название
                'description' => $this->text()->notNull(),                      // Описание
                'src' => $this->string()->notNull()->defaultValue(''),   // Путь к файлу
                'weight' => $this->integer()->notNull()                         // Вес для сортировки
            ],
            $tableOptions
        );
        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_doc.sql'));
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_doc}}');
    }
}
