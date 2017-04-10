<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_group`.
 */
class m170409_103424_create_user_group_table extends Migration
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
        $this->createTable('user_group', [
            'telegram_user_id' => $this->integer(11),
            'game_id' => $this->integer(11),
            'group_id' => $this->integer(11),
            'PRIMARY KEY (`telegram_user_id`, `group_id`, `game_id`)'
        ],$tableOptions);
        $this->addForeignKey('fk_user_group_group', 'user_group', 'group_id', 'group', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_group');
        $this->dropForeignKey('fk_user_group_group', 'user_group');
    }
}
