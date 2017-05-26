<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telegram_user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 *
 * @property Player[] $players
 * @property Game[] $games
 */
class TelegramUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telegram_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['first_name', 'last_name', 'username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function  getPlayers()
    {
        return $this->hasMany(Player::className(), ['telegram_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['id' => 'game_id'])->via('players');
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\TelegramUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TelegramUserQuery(get_called_class());
    }
}
