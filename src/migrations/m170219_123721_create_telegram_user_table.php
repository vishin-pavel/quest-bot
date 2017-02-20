<?php

use yii\db\Migration;

/**
 * Handles the creation of table `telegram_user`.
 */
class m170219_123721_create_telegram_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('telegram_user', [
            'id' => $this->integer()->notNull()->comment('Unique identifier for this user or bot'),
            'first_name' => $this->string()->comment('User‘s or bot’s first name'),
            'last_name' => $this->string()->comment('Optional. User‘s or bot’s last name'),
            'username' => $this->string()->comment('Optional. User‘s or bot’s username'),
            'PRIMARY KEY(id)'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('telegram_user');
    }
}
