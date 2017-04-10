<?php

use yii\db\Migration;

/**
 * Handles the creation of table `group`.
 */
class m170409_095105_create_group_table extends Migration
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
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'status' => $this->integer(2),
            'current_task' => $this->integer(11),
            'game_id' => $this->integer(11)
        ],$tableOptions);

        $this->addForeignKey('fk_group_game', 'group', 'game_id', 'game', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_group_game', 'group');
        $this->dropTable('group');
    }
}
