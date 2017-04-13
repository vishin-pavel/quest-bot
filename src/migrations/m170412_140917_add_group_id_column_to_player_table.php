<?php

use yii\db\Migration;

/**
 * Handles adding group_id to table `player`.
 */
class m170412_140917_add_group_id_column_to_player_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('player', 'group_id', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('player', 'group_id');
    }
}
