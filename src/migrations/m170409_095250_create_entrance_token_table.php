<?php

use yii\db\Migration;

/**
 * Handles the creation of table `entrance_token`.
 */
class m170409_095250_create_entrance_token_table extends Migration
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
        $this->createTable('entrance_token', [
            'id' => $this->primaryKey(),
            'token' => $this->string(32),
            'counter' => $this->integer(11),
            'group_id' => $this->integer(11)
        ],$tableOptions);
        $this->addForeignKey('fk_entrance_token_group', 'entrance_token', 'group_id', 'group', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_entrance_token_group', 'entrance_token');
        $this->dropTable('entrance_token');
    }
}
