<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $current_task
 * @property integer $game_id
 *
 * @property EntranceToken[] $entranceTokens
 * @property Game $game
 * @property UserGroup[] $userGroups
 * @property TelegramUser[] $telegramUsers
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'current_task', 'game_id'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'current_task' => 'Current Task',
            'game_id' => 'Game ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntranceTokens()
    {
        return $this->hasMany(EntranceToken::className(), ['group_id' => 'id']);
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
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['telegram_user_id' => 'telegram_user_id', 'game_id' => 'game_id'])->via('userGroups');
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\GroupQuery(get_called_class());
    }
}
