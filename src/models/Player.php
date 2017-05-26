<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property integer $telegram_user_id
 * @property integer $game_id
 * @property integer $game_status
 * @property integer $current_task
 * @property integer $group_id
 * @property integer $before_additional_game_task
 *
 * @property Game $game
 * @property TelegramUser $telegramUser
 * @property Task $currentTask
 * @property Task $lastTask
 *
 */
class   Player extends \yii\db\ActiveRecord
{
    const GAME_STATUS_MAIN_QUEST_DONE = 1;
    const GAME_STATUS_ADDITIONAL_DONE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telegram_user_id', 'game_id'], 'required'],
            [['telegram_user_id', 'game_id', 'game_status', 'current_task', 'group_id', 'before_additional_game_task'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['telegram_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelegramUser::className(), 'targetAttribute' => ['telegram_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'telegram_user_id' => 'Telegram User ID',
            'game_id' => 'Game ID',
            'game_status' => 'Game Status',
            'current_task' => 'Current Task',
            'group_id' => 'Group ID',
            'before_additional_game_task' => 'Last task'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramUser()
    {
        return $this->hasOne(TelegramUser::className(), ['id' => 'telegram_user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\PlayerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\PlayerQuery(get_called_class());
    }

    public function getCurrentTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'current_task']);
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function lastTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'before_additional_game_task']);
    }
}
