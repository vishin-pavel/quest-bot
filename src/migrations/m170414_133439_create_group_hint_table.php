<?php

use yii\db\Migration;

/**
 * Handles the creation of table `group_hint`.
 */
class m170414_133439_create_group_hint_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('group_hint', [
            'group_id' => $this->integer(11),
            'hint_id' => $this->integer(11),
            'current_game_task' => $this->integer(11),
            'PRIMARY KEY (`group_id`, `hint_id`)'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('group_hint');
    }
}
