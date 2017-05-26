<?php

use yii\db\Migration;

/**
 * Handles the creation of table `answer_log`.
 */
class m170513_075213_create_answer_log_table extends Migration
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
        $this->createTable('answer_log', [
            'id' => $this->primaryKey(),
            'answer' => $this->text(),
            'telegram_user_id' => $this->integer(11),
            'game_id' => $this->integer(11),
            'task_id' => $this->integer(11),
            'answer_time' => $this->dateTime()
        ], $tableOptions);
        $this->addForeignKey('fk_answer_log_telegram_user', 'answer_log', 'telegram_user_id', 'telegram_user', 'id');
        $this->addForeignKey('fk_answer_log_game', 'answer_log', 'game_id', 'game', 'id');
        $this->addForeignKey('fk_answer_log_task', 'answer_log', 'task_id', 'task', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_answer_log_telegram_user', 'answer_log');
        $this->dropForeignKey('fk_answer_log_game', 'answer_log');
        $this->dropForeignKey('fk_answer_log_task', 'answer_log');
        $this->dropTable('answer_log');
    }
}
