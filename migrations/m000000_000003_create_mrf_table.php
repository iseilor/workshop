<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%mrf}}`.
 */
class m000000_000003_create_mrf_table extends Migration

{
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mrf}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),

                'title' => $this->string()->notNull(),
                'description' => $this->string()->notNull()
            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mrf}}');
    }

    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%mrf}} (`created_at`,`created_by`,`title`,`description`)
        VALUES 
            ($now,1,'Макрорегиональный филиал \"Центр\"','Макрорегиональный филиал \"Центр\"'),
            ($now,1,'Белгородский филиал','Белгородский филиал'),
            ($now,1,'Брянской филиал','Брянский филиал'),
            ($now,1,'Владимирский филиал','Владимирский филиал'),
            ($now,1,'Воронежский филиал','Воронежский филиал'),
            ($now,1,'Ивановский филиал','Ивановский филиал'),
            ($now,1,'Калужский филиал','Калужский филиал'),
            ($now,1,'Костромской филиал','Костромской филиал'),
            ($now,1,'Курский филиал','Курский филиал'),
            ($now,1,'Липецский филиал','Липецкий филиал'),
            ($now,1,'Орловский филиал','Орловский филиал'),
            ($now,1,'Рязанский филиал','Рязанский филиал'),
            ($now,1,'Смоленский филиал','Смоленский филиал'),
            ($now,1,'Тамбовский филиал','Тамбовский филиал'),
            ($now,1,'Тверской филиал','Тверской филиал'),
            ($now,1,'Тульский филиал','Тульский филиал'),
            ($now,1,'Ярославский филиал','Ярославский филиал')
        ";
    }
}
