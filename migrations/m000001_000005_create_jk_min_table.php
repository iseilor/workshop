<?php

use yii\db\Expression;
use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_min}}`.
 */
class m000001_000005_create_jk_min_table extends Migration
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
            '{{%jk_min}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
                'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_DATETIME,
                'updated_by' => Schema::TYPE_INTEGER,
                'deleted_at' => Schema::TYPE_DATETIME,
                'deleted_by' => Schema::TYPE_INTEGER,
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'description' => Schema::TYPE_TEXT . ' NOT NULL',
                'min' => Schema::TYPE_FLOAT . ' NOT NULL'
            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = new Expression('NOW()');
        return "INSERT INTO {{%jk_min}} (`created_at`,`created_by`,`title`,`min`,`description`)
        VALUES 
        ($now,1,'Белгородская область',    9236,       '18.11.2019 No489-пп'),
        ($now,1,'Бранская область',        10615,      '14.10.2019 №482-п'),
        ($now,1,'Владимирская область',    10485,      '25.10.2019 №737'),
        ($now,1,'Воронежская область',     9390,       '08.11.2019 №1082'),
        ($now,1,'Ивановская область',      10345,      '21.10.2019 №100-уг'),
        ($now,1,'Калужская область',       11117,      '23.10.2019 №661'),
        ($now,1,'Костромская область',     10624,      '11.11.2019 №434-а'),
        ($now,1,'Курская область',         10018,      '05.11.2019 №1056-па'),
        ($now,1,'Орловская область',       10215,      '12.11.2019 №631'),
        ($now,1,'Липецкая область',        9399,       '14.10.2019 №441'),
        ($now,1,'Рязанская область',       10123,      '21.10.2019 №39'),
        ($now,1,'Смоленская область',      10810,      '25.10.2019 №643'),
        ($now,1,'Тамбовская область',      9879,       '18.11.2019 №1285'),
        ($now,1,'Тверская область',        10676.68,   '07.11.2019 №441-пп'),
        ($now,1,'Тульская область',        10709,      '13.11.2019 №543'),
        ($now,1,'Москва',                  17329,      '17.12.2019 №1709-ПП'),
        ($now,1,'Московская область',      12897,      '13.12.2019 №958/43'),
        ($now,1,'Ярославская область',     10277,      '30.10.2019 №312'),
        ($now,1,'Санкт-Петербург',         11465.30,   '№ 900 от 13.12.2019'),
        ($now,1,'Ленинградская область',   11028,      ' № 546 от 25.11.2019')";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_min}}');
    }
}