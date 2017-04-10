<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m170219_132329_create_task_table extends Migration
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
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'description' => $this->text(),
            'start_text' => $this->text(),
            'final_text' => $this->text(),
            'pass_phrase' => $this->string(),
            'next_task' => $this->integer(11),
            'prev_task' => $this->integer(11),
            'game_id' => $this->integer(11),
//            'point' => 'point',
//            'SPATIAL KEY `point` (`point`)'
        ], $tableOptions );
        $this->addForeignKey('fk_task_game', 'task', 'game_id', 'game', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_task_game', 'task');
        $this->dropTable('task');
    }
}
