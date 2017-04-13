<?php

use yii\db\Migration;

/**
 * Handles adding first_task to table `game`.
 */
class m170412_125331_add_first_task_column_to_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('game', 'first_task', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('game', 'first_task');
    }
}
