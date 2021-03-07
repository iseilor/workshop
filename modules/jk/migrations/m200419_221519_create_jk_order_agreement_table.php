<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jk_order_agreement}}`.
 */
class m200419_221519_create_jk_order_agreement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%jk_order_agreement}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer() . ' NOT NULL',
            'created_by' => $this->integer() . ' NOT NULL',
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),

            'order_id' => $this->integer()->notNull(),      // Номер заявки
            'user_id' => $this->integer()->notNull(),       // ID пользователя
            'receipt_at' => $this->integer(),               // Когда поступила на согласование
            'approval_at' => $this->integer(),              // Когда фактически была согласована
            'approval'=>$this->integer(),                   // Согласовано или нет
            'comment'=>$this->text(),                       // Комментарий при согласовании
        ], $tableOptions);

        $this->execute(file_get_contents(__DIR__ . '/../sql/jk_order_agreement.sql'));
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order_agreement}}');
    }
}
