<?php

use yii\db\Migration;

class m170409_230858_create_game_id_field extends Migration
{
    public function up()
    {
        $this->addColumn('entrance_token', 'game_id', $this->integer(11));
        $this->addForeignKey('fk_entrance_token_game', 'entrance_token', 'game_id', 'game', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_entrance_token_game', 'entrance_token');
        $this->dropColumn('entrance_token', 'game_id');
    }
}
