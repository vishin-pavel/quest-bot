<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_pointer`.
 */
class m170409_093819_create_task_pointer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('task_pointer', [
            'id' => $this->primaryKey(),
            'from' => $this->integer(11),
            'to' => $this->integer(11),
            'type' => $this->integer(2)
        ],$tableOptions);
        $this->addForeignKey('fk_task_pointer_to', 'task_pointer', 'to', 'task', 'id');
        $this->addForeignKey('fk_task_pointer_from', 'task_pointer', 'from', 'task', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_task_pointer_to', 'task_pointer');
        $this->dropForeignKey('fk_task_pointer_from', 'task_pointer');
        $this->dropTable('task_pointer');
    }
}
