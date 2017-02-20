<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game`.
 */
class m170219_132319_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('game');
    }
}
