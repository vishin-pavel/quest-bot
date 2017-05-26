<?php

use yii\db\Migration;

/**
 * Handles the creation of table `additional_game`.
 */
class m170511_104214_create_additional_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('additional_game', [
            'id' => $this->primaryKey(),
            'first_task_id' => $this->integer(11)->notNull(),
            'game_id' => $this->integer(11)->notNull()
        ]);
        $this->addForeignKey('fk_additional_game_game', 'additional_game', 'game_id', 'game', 'id');
        $this->addForeignKey('fk_additional_game_task', 'additional_game', 'first_task_id', 'task', 'id');
        $this->addColumn('player', 'before_additional_game_task', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('player', 'before_additional_game_task');
        $this->dropForeignKey('fk_additional_game_game', 'additional_game');
        $this->dropForeignKey('fk_additional_game_task', 'additional_game');
        $this->dropTable('additional_game');
    }
}
