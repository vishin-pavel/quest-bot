<?php

use yii\db\Migration;

/**
 * Handles the creation of table `telegram_chat`.
 */
class m170219_131758_create_telegram_chat_table extends Migration
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
        $this->createTable('telegram_chat', [
            'id' => $this->bigInteger()->notNull()->comment('Unique identifier for this chat'),
            'type' => $this->string()->comment('Type of chat, can be either “private”, “group”, “supergroup” or “channel”'),
            'title' => $this->string()->comment('Optional. Title, for supergroups, channels and group chats'),
            'username' => $this->string()->comment('Optional. Username, for private chats, supergroups and channels if available'),
            'first_name' => $this->string()->comment('Optional. First name of the other party in a private chat'),
            'last_name' => $this->string()->comment('Optional. Last name of the other party in a private chat'),
            'all_members_are_administrators' => $this->boolean()->comment('Optional. True if a group has ‘All Members Are Admins’ enabled.'),
            'PRIMARY KEY(id)'
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('telegram_chat');
    }
}
