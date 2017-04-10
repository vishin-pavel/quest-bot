<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_image`.
 */
class m170409_103423_create_task_image_table extends Migration
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
        $this->createTable('task_image', [
            'task_id' => $this->integer(11),
            'image_id' => $this->integer(11),
            'PRIMARY KEY (`task_id`, `image_id`)'
        ],$tableOptions);
        $this->addForeignKey('fk_task_image_task', 'task_image', 'task_id', 'task', 'id');
        $this->addForeignKey('fk_task_image_image', 'task_image', 'image_id', 'file', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_player_game', 'player');
        $this->dropForeignKey('fk_player_telegram_user', 'player');
        $this->dropTable('task_image');
    }
}
