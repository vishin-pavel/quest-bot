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
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'description' => $this->text(),
            'start_text' => $this->text(),
            'final_text' => $this->text(),
            'pass_phrase' => $this->string(),
            'next_task' => $this->integer(11),
            'prev_task' => $this->integer(11),
            'game_id' => $this->integer(11),
            'point' => 'point NOT NULL',
            'SPATIAL KEY `point` (`point`)'
        ]);
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
