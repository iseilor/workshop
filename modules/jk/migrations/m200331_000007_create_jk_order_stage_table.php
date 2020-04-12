<?php


use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order_status}}`.
 */
class m200331_000007_create_jk_order_stage_table extends Migration
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
            '{{%jk_order_stage}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),
                'order_id' => $this->integer()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'comment' => $this->string()->notNull()

            ],
            $tableOptions
        );
        //$this->execute($this->addData());
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_order_stage}} (`created_at`,`created_by`,`title`,`progress`,`color`,`description`)
        VALUES
        ($now,1,'Новая',5,'green','Новая заявка'),
        ($now,1,'Проверка',10,'blue','Заявка находится на проверке у куратора'),
        ($now,1,'Возврат',10,'yellow','Заявка возвращена куратором для исправления'),
        ($now,1,'Оклонено',10,'red','Куратор отклонил заявку'),
        ($now,1,'Проверно',20,'blue','Куратор проверил заявку'),
        ($now,1,'Согласование',30,'blue','На согласовании у руководителя'),
        ($now,1,'Согласовано',40,'blue','Согласовано руководителем'),
        ($now,1,'Не согласовано',50,'red','Не согласовано руководителем'),
        ($now,1,'Согласование',70,'blue','Согласование жилищной коммиссией'),
        ($now,1,'Согласовано',80,'green','Согласовано жилищной коммиссией'),
        ($now,1,'Не согласовано',80,'red','Не согласовано жилищной коммиссией'),
        ($now,1,'Отложено',80,'yellow','Отложено жилищной коммисией на следующий год'),
        ($now,1,'Ожидание',90,'blue','Ожидание выплаты'),
        ($now,1,'Выполнено',100,'green','Заявка успешно завершена'),
        ($now,1,'Отменено',100,'red','Заявка отменен инициатором')";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order_stage}}');
    }
}