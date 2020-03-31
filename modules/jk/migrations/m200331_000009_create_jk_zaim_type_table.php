<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_zaim_type}}`.
 */
class m200331_000009_create_jk_zaim_type_table extends Migration
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
        $this->createTable('{{%jk_zaim_type}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ], $tableOptions);

        $this->execute($this->addData());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_zaim_type}}');
    }

    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_zaim_type}} (`created_at`,`created_by`,`title`,`description`)
        VALUES
        ($now,1,'Покупка квартиры (новостройка)','Покупка квартиры (новостройка)'),
        ($now,1,'Покупка квартиры (вторичка)','Покупка квартиры (вторичка)'),
        ($now,1,'Покупка дома','Покупка дома'),
        ($now,1,'Строительство дома','Строительство дома')";

    }
}