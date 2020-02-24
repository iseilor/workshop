<?php


use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation of table `{{%jk_order_status}}`.
 */
class m000001_000007_create_jk_order_status_table extends Migration
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
            '{{%jk_order_status}}',
            [
                'id' => $this->primaryKey(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'deleted_at' => $this->integer(),
                'deleted_by' => $this->integer(),
                'title' => $this->string()->notNull(),
                'progress' => $this->integer(),
                'color' => $this->string(),
                'description' => $this->text(),
            ],
            $tableOptions
        );
        $this->execute($this->addData());
    }

    // Добавление первоначальных данных
    public function addData()
    {
        $now = strtotime(date('d.m.Y H:i:s'));
        return "INSERT INTO {{%jk_order_status}} (`created_at`,`created_by`,`title`,`progress`,`color`,`description`)
        VALUES
        ($now,1,'Новая заявка',0,'green','Новая заявка'),
        ($now,1,'На проверке у куратора',10,'blue','Заявка находится на проверке у куратора'),
        ($now,1,'Возвращено куратором на исправление',10,'yellow','Заявка возвращена куратором для исправления'),
        ($now,1,'Повторная проверка куратором',10,'yellow','Заявка возвращена куратором для исправления'),
        ($now,1,'Куратор отклонил заявку',10,'red','Куратор отклонил заявку'),
        ($now,1,'Согласовано куратором',20,'blue','Согласовано куратором'),
        ($now,1,'На согласовании у руководителя',30,'blue','На согласовании у руководителя'),
        ($now,1,'Согласовано руководителем',40,'blue','Согласовано руководителем'),
        ($now,1,'Отклонено руководителем',50,'red','Отклонено руководителем'),
        ($now,1,'Согласование',70,'blue','Согласование жилищной коммиссией'),
        ($now,1,'Отклонено',70,'red','Отклонено жилищной коммиссией'),
        ($now,1,'Согласовано',80,'blue','Согласовано жилищной коммиссией'),
        ($now,1,'Отложено',80,'blue','Отложено ЖК на следующий год'),
        ($now,1,'Ожидание выплаты',90,'blue','Ожидание выплаты'),
        ($now,1,'Выполнено',100,'green','Заявка завершено, компенсация предоставлена')";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jk_order_status}}');
    }
}