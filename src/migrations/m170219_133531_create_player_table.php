<?php

use yii\db\Migration;

/**
 * Handles the creation of table `player`.
 */
class m170219_133531_create_player_table extends Migration
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
        $this->createTable('player', [
            'telegram_user_id' => $this->integer()->notNull()->comment('Кто играет'),
            'game_id' => $this->integer(11)->notNull()->comment('Во что играет'),
            'game_status' => $this->integer(1)->comment('Статус пользователя в игре'),
            'current_task' => $this->integer()->comment('Текущее задание'),
            'PRIMARY KEY (`telegram_user_id`, `game_id`)'
        ], $tableOptions);
        $this->addForeignKey('fk_player_game', 'player', 'game_id', 'game', 'id');
        $this->addForeignKey('fk_player_telegram_user', 'player', 'telegram_user_id', 'telegram_user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_player_game', 'player');
        $this->dropForeignKey('fk_player_telegram_user', 'player');
        $this->dropTable('player');
    }
}
