<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hint`.
 */
class m170414_133142_create_hint_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('hint', [
            'id' => $this->primaryKey(),
            'hint_text' => $this->text(),
            'task_id' => $this->integer(11),
            'start_task_id' => $this->integer(11)
        ]);
        $this->addForeignKey('fk_hint_task', 'hint', 'task_id', 'task', 'id');
        $this->addForeignKey('fk_hint_start_task', 'hint', 'start_task_id', 'task', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_hint_start_task', 'hint');
        $this->dropForeignKey('fk_hint_task', 'hint');
        $this->dropTable('hint');
    }
}
