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
 *
 * @property Game $game
 * @property TelegramUser $telegramUser
 */
class Player extends \yii\db\ActiveRecord
{
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
            [['telegram_user_id', 'game_id', 'game_status', 'current_task'], 'integer'],
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
}
