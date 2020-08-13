<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_corp_norm}}`.
 */
class m200806_073228_create_jk_corp_norm_table extends Migration
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

        $this->createTable('{{%jk_corp_norm}}', [
            'id' => $this->primaryKey(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'number' => $this->integer()->notNull(),
            'area' => $this->integer()->notNull(),

        ], $tableOptions);
        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_corp_norm}}');
    }

    public function addData()
    {
        return "INSERT INTO {{%jk_corp_norm}} (`created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `number`, `area`)
        VALUES 
            (1596781853, 1, null, null, null, null, 1, 35),
            (1596781863, 1, null, null, null, null, 2, 50)
        ";
    }
}
